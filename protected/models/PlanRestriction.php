<?php

class PlanRestriction extends CComponent
{
	static public function allowsNew($resourceType, $advertiserId = '')
	{
		if($resourceType == '') {
			return false;
		}
		
		$currentAmount = PlanRestriction::getCurrentResourceAmount($resourceType, $advertiserId);
		if($currentAmount === null) {
			throw new CHttpException(1234, "Plan Restriction: getCurrentResourceAmount() for type $resourceType is not defined!");
		}

		$limitAmount = PlanRestriction::getPlanLimitsForResource($resourceType, $advertiserId);
		if($limitAmount == -1) {
			// this means this restriction is not defined in the plan
			return true;
		}
		if($limitAmount > 0 && $limitAmount >$currentAmount) {
			return true;
		}
		
		return false;
	}

	static public function getPlanLimitsForResource($resourceType, $advertiserId) {
		if($resourceType == '') {
			return array();
		}

		$planType = PlanResourceType::getPlanType($resourceType);
		
		if($planType == PlanType::ADVERTISER_PLAN) {
			if($advertiserId == '') {
				$advertiserId = Yii::app()->user->getAdvertiserId();
			}
		}
		
		// get some payment plan
		$sql = "SELECT plan_id, type, duration, expired FROM p_purchased_plans".
				" WHERE wlabel_id=".Yii::app()->user->getWhiteLabelId().
				" AND expired=0";
				
		if($planType == PlanType::ADVERTISER_PLAN && $advertiserId != '') {
			$sql .= " AND advertiser_id=".$advertiserId;
		}
				
				
		$sql .= " AND pplan_id in (".
				"   SELECT pplan_id from p_purchased_plans_payments".
				"     WHERE date_expire>='".date("Y-m-d 00:00:00")."'".
				"   )";
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();
		
		if($results == null) {
			// it is still possible that the plan is paid by authorize.net and lastpayment expired, check its status
			$results = PlanRestriction::checkAuthorizeNetPlans($planType, $advertiserId);
		}

		if($results == null) {
			return 0;
		}

		$planIds = array();
		foreach($results as $result) {
			$planIds[] = $result['plan_id'];
		}
		
		// now check for planlimits with this resource type 
		$criteria = new CDbCriteria;
		$criteria->compare('t.plan_id',$planIds);
		$criteria->compare('t.resource_type',$resourceType);
		
		
		$result = PlanLimit::model()->find($criteria);		
		if($result == false) {
			return -1;
		}
		return $result->limit_amount;
	}
	
	public function getAllowedCount($resourceType, $advertiserId)
	{
		return PlanRestriction::getPlanLimitsForResource($resourceType, $advertiserId);
	}

	/**
	 * function returns current number of resources (listings, etc.) per given type and advertiser 
	 */
	public function getCurrentResourceAmount($resourceType, $advertiserId) {
		$criteria = new CDbCriteria;
		if($resourceType == PlanResourceType::RTYPE_LISTINGS_PER_ADVERTISER) {
			if($advertiserId == '') {
				return 0;
			}
			$criteria->compare('t.advertiser_id', $advertiserId);
			return Listing::model()->count($criteria);

		} else if($resourceType == PlanResourceType::RTYPE_FEATURED_LISTINGS_PER_ADVERTISER) {
			if($advertiserId == '') {
				return 0;
			}
			$criteria->compare('t.advertiser_id', $advertiserId);
			$criteria->compare('t.type', ListingType::TYPE_FEATURED);

			return Listing::model()->count($criteria);
			
		} else if($resourceType == PlanResourceType::RTYPE_PREMIUMAD_PER_ADVERTISER) {
			if($advertiserId == '') {
				return 0;
			}
			$criteria->compare('t.advertiser_id', $advertiserId);

			return PremiumAd::model()->count($criteria);

		} else if($resourceType == PlanResourceType::RTYPE_LOCATIONS_PER_ACCOUNT) {
			$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());

			return Location::model()->count($criteria);
		}
		
		return null;
	}
	
	public static function checkAuthorizeNetPlans($planType, $advertiserId) {
		$sql = "SELECT plan_id, pplan_id, subscription_id, type, duration, expired FROM p_purchased_plans".
				" WHERE wlabel_id=".Yii::app()->user->getWhiteLabelId().
				" AND expired=0".
				" AND method=".PaymentType::TYPE_AUTHORIZENET;
			
		if($planType == PlanType::ADVERTISER_PLAN && $advertiserId != '') {
			$sql .= " AND advertiser_id=".$advertiserId;
		}
			
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();
	
		if($results == null) {
			return null;
		}
		
		foreach($results as $row) {

			// now check the plan subscription status through Authorize.net
			$status = PlanRestriction::checkSubscriptionStatus($row['subscription_id']);
			if($status == 'active') {
				// insert new purchased plan payment
				PlanRestriction::insertNewPurchasedPlanPayment($row['pplan_id'], $row['duration']);
				
				return array('plan_id' => $row['plan_id']);
				
			} else {
				// set plan to expired
				$purchasedPlan = PurchasedPlan::model()->findByPk($row['pplan_id']); 
				$purchasedPlan->expired = 1;
				$purchasedPlan->save();
			}
		}
		
		return null;
		
	}
	
	public static function checkSubscriptionStatus($subscriptionId) {
		if(Yii::app()->params['paymentsTestMode']) {
			$host = "apitest.authorize.net";
		} else {
			$host = "api.authorize.net";
		}

		$path = "/xml/v1/request.api";
		
		$wlAccount = WhiteLabel::model()->findByPk(Yii::app()->user->getWhiteLabelId());
		if($wlAccount == null) {
			throw new Exception("Account doesn't exist");
		}
		
		$content =
		        "<?xml version=\"1.0\" encoding=\"utf-8\"?>".
		        "<ARBGetSubscriptionStatusRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">".
		        "<merchantAuthentication>".
		        "<name>" . $wlAccount->auth_api_id . "</name>".
		        "<transactionKey>" . $wlAccount->auth_trans_key . "</transactionKey>".
		        "</merchantAuthentication>" .
		        "<subscriptionId>" . $subscriptionId . "</subscriptionId>".
		        "</ARBGetSubscriptionStatusRequest>";


		$response = Utils::send_request_via_fsockopen($host,$path,$content);
		
		if ($response) {
			Utils::logToPaymentFile('authnet', $response); 
			
			$responseValues = Utils::parse_return($response);
			return $responseValues['status'];
		}
		
		return 'error';
	}
	
	public static function insertNewPurchasedPlanPayment($pplanId, $duration) {
		$sql = "SELECT MAX(date_expire) as date_expire FROM p_purchased_plans_payments".
				" WHERE pplan_id=".$pplanId;
			
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();
		if($results) {
			$dateLast = $results[0]['date_expire'];
		} else {
			$dateLast = Date('y-m-d');
		}

		// create new purchased_plans payments record
		$purchasedPlanPayment = new PurchasedPlanPayment;

		$purchasedPlanPayment->pplan_id = $pplanId;
		$purchasedPlanPayment->date_paid = date("Y-m-d h:i:s");;
		$purchasedPlanPayment->date_expire = Date('Y-m-d', strtotime($dateLast."+$duration day"));
		$purchasedPlanPayment->transaction_id = 'AUTHNET_PAYMENT';

		if(!$purchasedPlanPayment->validate()) {
			throw new Exception("Plan payment cannot be saved: ".$this->putErrorsToString($purchasedPlanPayment->getErrors()));
		}

		$purchasedPlanPayment->save();		
	}
}
