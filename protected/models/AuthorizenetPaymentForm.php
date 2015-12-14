<?php

class AuthorizenetPaymentForm extends CFormModel
{
	public $plan_id;
	public $advertiser_id;
	public $wlabel_id;
	public $refId;
	public $name;
	public $length;
	public $unit;
	public $startDate;
	public $totalOccurrences;
	public $trialOccurrences;
	public $amount;
	public $trialAmount;
	public $cardNumber;
	public $expirationDate;
	public $firstName;
	public $lastName;
	
	public function rules()
	{
		return array(
			// username is required
			array('plan_id, wlabel_id, advertiser_id, name, length, startDate, totalOccurrences, amount, cardNumber, expirationDate, firstName, lastName', 'required'),
			array('plan_id', 'planExistsInAccount'),
			array('totalOccurrences', 'dummyCheck'),
			array('advertiser_id', 'safe', 'on'=>'search'),
			array('advertiser_id, wlabel_id, plan_id', 'numerical', 'integerOnly'=>true),
			
		);
	}
	
	/**
	 * this check is there only because if thep_categories, p_locations & p_listings aren't in rules, they won't be loaded from POST parameter
	 */
	public function dummyCheck($attribute,$params) {
		return true;
	}
	
	public function planExistsInAccount($attribute,$params) {
		if($this->plan_id == '') {
			// we don't need to check for empty username
			return;
		}
		
		$p = Plan::model()->findByAttributes( array('plan_id'=>$this->plan_id, 'wlabel_id'=>$this->wlabel_id) );
		
		if($p == null) {
			$this->addError($attribute, "Plan wasn't found!");	
		}
		
		return false;
	}

	public function sendCreateSubscription($wlAccount, $plan) {
		if(Yii::app()->params['paymentsTestMode']) {
			$host = "apitest.authorize.net";
		} else {
			$host = "api.authorize.net";
		}
		$path = "/xml/v1/request.api";
		
		$content =
		        "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
		        "<ARBCreateSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
		        "<merchantAuthentication>".
		        "<name>" . $wlAccount->auth_api_id . "</name>".
		        "<transactionKey>" . $wlAccount->auth_trans_key . "</transactionKey>".
		        "</merchantAuthentication>".
				"<refId>" . $this->refId . "</refId>".
		        "<subscription>".
		        "<name>" . $this->name . "</name>".
		        "<paymentSchedule>".
		        "<interval>".
		        "<length>". $this->length ."</length>".
		        "<unit>". $this->unit ."</unit>".
		        "</interval>".
		        "<startDate>" . $this->startDate . "</startDate>".
		        "<totalOccurrences>". $this->totalOccurrences . "</totalOccurrences>".
		        "<trialOccurrences>". $this->trialOccurrences . "</trialOccurrences>".
		        "</paymentSchedule>".
		        "<amount>". $this->amount ."</amount>".
		        "<trialAmount>" . $this->trialAmount . "</trialAmount>".
		        "<payment>".
		        "<creditCard>".
		        "<cardNumber>" . $this->cardNumber . "</cardNumber>".
		        "<expirationDate>" . $this->expirationDate . "</expirationDate>".
		        "</creditCard>".
		        "</payment>".
		        "<billTo>".
		        "<firstName>". $this->firstName . "</firstName>".
		        "<lastName>" . $this->lastName . "</lastName>".
		        "</billTo>".
		        "</subscription>".
		        "</ARBCreateSubscriptionRequest>";


		$response = Utils::send_request_via_fsockopen($host,$path,$content);
		
		if ($response) {
			Utils::logToPaymentFile('authnet', $response); 
					
			$responseValues = Utils::parse_return($response);
			if($responseValues['resultCode'] != 'Ok') {
				$this->addError('', "ERROR: ".$responseValues['text']);
				return false;
			} else {
				return $this->purchasePlan($responseValues['subscriptionId']);
			}
			
			return false;
		}
	}
	
	public function purchasePlan($subscriptionId, $advertiserId = '') {
		$transaction = Yii::app()->db->beginTransaction();

		try {
			// load plan and its plan limits
			$plan = Plan::model()->findByAttributes( array('plan_id'=>$this->plan_id, 'wlabel_id'=>$this->wlabel_id) );
			if($plan == null) {
				 throw new Exception("Plan doesn't exist");
			}

			// create new purchased_plans record
			$purchasedPlan = new PurchasedPlan;
			$purchasedPlan->plan_id = $plan->plan_id;
			$purchasedPlan->wlabel_id = $plan->wlabel_id;
			$purchasedPlan->type = $plan->type;
			$purchasedPlan->duration = $plan->duration;
			$purchasedPlan->method = PaymentType::TYPE_AUTHORIZENET;
			$purchasedPlan->subscription_id = $subscriptionId;
			$purchasedPlan->advertiser_id = $this->advertiser_id;
			
			$purchasedPlan->method = 0;
			$purchasedPlan->price = $plan->price;

			$purchasedPlan->date_created = date("Y-m-d h:i:s");
			
			if(!$purchasedPlan->validate()) {
				throw new Exception("Plan purchase cannot be saved: ".$this->putErrorsToString($purchasedPlan->getErrors()));
			}
			$purchasedPlan->save();
					
			// create new purchased_plans payments record
			$purchasedPlanPayment = new PurchasedPlanPayment;

			$purchasedPlanPayment->pplan_id = $purchasedPlan->pplan_id;
			$purchasedPlanPayment->date_paid = $purchasedPlan->date_created;
			$purchasedPlanPayment->date_expire = Date('Y-m-d', strtotime("+$plan->duration day"));
			$purchasedPlanPayment->transaction_id = 'AUTHNET_INIT_PAYMENT';

			if(!$purchasedPlanPayment->validate()) {
				throw new Exception("Plan payment cannot be saved: ".$this->putErrorsToString($purchasedPlanPayment->getErrors()));
			}

			$purchasedPlanPayment->save();
			
			
    	} catch (Exception $e) {
    		$transaction->rollBack();
    		throw new CHttpException(400,'DB Exception: '.$e->getMessage());
    	}

   		$transaction->commit();
		return true;
	}
	
	private function putErrorsToString($errors) {
		$str = '';
		foreach($errors as $attribute=>$attrErrors) {
			$str .= ($str != '' ? ', ' : '').$attribute;
			foreach($attrErrors as $error) {
				$str .= ' - '.$error; 
			}
		}
		
		return $str;
	}
}
