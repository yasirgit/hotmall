<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PurchasePlanForm extends CFormModel
{
	public $plan_id;
	public $advertiser_id;
	public $wlabel_id;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username is required
			array('plan_id', 'required'),
			array('plan_id', 'planExistsInAccount'),
			array('advertiser_id', 'safe', 'on'=>'search'),
			array('advertiser_id', 'numerical', 'integerOnly'=>true),
			array('wlabel_id', 'safe', 'on'=>'search'),
			array('wlabel_id', 'numerical', 'integerOnly'=>true),
			
		);
	}
	
	public function planExistsInAccount($attribute,$params) {
		if($this->plan_id == '') {
			// we don't need to check for empty username
			return;
		}
		
		$p = Plan::model()->findByAttributes( array('plan_id'=>$this->plan_id, 'wlabel_id'=>Yii::app()->user->getWhiteLabelId()) );
		
		if($p == null) {
			$this->addError($attribute, "Plan wasn't found!");	
		}
		
		return false;
	}

	public function purchasePlan($planType, $advertiserId = '') {
		$transaction = Yii::app()->db->beginTransaction();

		try {
			// load plan and its plan limits
			if($planType == PlanType::ADVERTISER_PLAN) {
				$plan = Plan::model()->findByAttributes( array('plan_id'=>$this->plan_id, 'wlabel_id'=>Yii::app()->user->getWhiteLabelId(), 'type'=>$planType) );
			} else {
				$plan = Plan::model()->findByAttributes( array('plan_id'=>$this->plan_id, 'type'=>$planType) );
			}
			if($plan == null) {
				 throw new Exception("Plan doesn't exist");
			}

			$planLimits = PlanLimit::model()->findAllByAttributes( array('plan_id'=>$plan->plan_id) );
			if($planLimits == null) {
//				 throw new Exception("Plan Limits don't exist");
			}
			
			// create new purchased_plans record
			$purchasedPlan = new PurchasedPlan;
			$purchasedPlan->plan_id = $plan->plan_id;
			if($planType == PlanType::ADVERTISER_PLAN) {
				$purchasedPlan->wlabel_id = $plan->wlabel_id;
			} else {
				$purchasedPlan->wlabel_id = $this->wlabel_id;
			}
			$purchasedPlan->type = $plan->type;
			if($planType == PlanType::ADVERTISER_PLAN) {
				if(Yii::app()->user->isAdvertiser()) {
					$purchasedPlan->advertiser_id = Yii::app()->user->getAdvertiserId();
				} else {
					$purchasedPlan->advertiser_id = $advertiserId;
				}
			} else {
				
			}
			
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
			$purchasedPlanPayment->date_expire = Date('y-m-d', strtotime("+$plan->duration day"));
			$purchasedPlanPayment->transaction_id = 'TEST_PAYMENT';

			if(!$purchasedPlanPayment->validate()) {
				throw new Exception("Plan payment cannot be saved: ".$this->putErrorsToString($purchasedPlanPayment->getErrors()));
			}

			$purchasedPlanPayment->save();
			
			
    	} catch (Exception $e) {
    		$transaction->rollBack();
    		throw new CHttpException(400,'DB Exception: '.$e->getMessage());
    	}

   		$transaction->commit();
		return false;
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
