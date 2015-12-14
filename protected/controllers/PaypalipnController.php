<?php

class PaypalipnController extends Controller
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('info', 'register', 'regsuccessful'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		//error_reporting(E_ALL ^ E_NOTICE); 

		// Read the post from PayPal and add 'cmd' 
		$req = 'cmd=_notify-validate'; 
		if(function_exists('get_magic_quotes_gpc')) 
		{  
			$get_magic_quotes_exists = true; 
		} 

		$txt = '';
		
		foreach ($_REQUEST as $key => $value) { 
			$txt .= $key . " = " .$value ."\r\n";
		}

		Utils::logToPaymentFile('paypal_ipn', $txt);
		
		// save also to DB
		$pLog = new PaymentLog;
		$pLog->date_created = date("Y-m-d h:i:s");
		$pLog->log = $txt;
		$pLog->save();



		foreach ($_REQUEST as $key => $value) 
		// Handle escape characters, which depends on setting of magic quotes 
		{  
			if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1){  
				$value = urlencode(stripslashes($value)); 
			} else { 
				$value = urlencode($value); 
			} 
			$req .= "&$key=$value"; 
		} 

		// Post back to PayPal to validate 
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n"; 
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n"; 
		if(Yii::app()->params['paymentsTestMode']) {
			$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
		} else {
			$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
		}


		// Process validation from PayPal 
		// TODO: This sample does not test the HTTP response code. All 
		// HTTP response codes must be handles or you should use an HTTP 
		// library, such as cUrl 

		if (!$fp) { // HTTP ERROR 
			Utils::logToPaymentFile('paypal_ipn', $_REQUEST['subscr_id']." - HTTP ERROR!");
			
		} else { 
			// NO HTTP ERROR 
			fputs ($fp, $header . $req); 
			while (!feof($fp)) { 
				$res = fgets ($fp, 1024); 
				
				if (strcmp ($res, "VERIFIED") == 0) { 
					Utils::logToPaymentFile('paypal_ipn', $_REQUEST['subscr_id']." - RESULT: $res\n");

					// TODO: 
					// Check the payment_status is Completed 
					// Check that txn_id has not been previously processed 
					// Check that receiver_email is your Primary PayPal email 
					// Check that payment_amount/payment_currency are correct 
					// Process payment 
					// If 'VERIFIED', send an email of IPN variables and values to the 
					// specified email address 
					try {
						Utils::logToPaymentFile('paypal_ipn', $_REQUEST['subscr_id'].' - Processing Payment');
						$this->processPayment();
						Utils::logToPaymentFile('paypal_ipn', $_REQUEST['subscr_id'].' - Processed OK');
			    	} catch (Exception $e) {
			    		Utils::logToPaymentFile('paypal_ipn', $_REQUEST['subscr_id'].' - Processing Exception: '.$e->getMessage());
			    	}						
				} else if (strcmp ($res, "INVALID") == 0) {
					Utils::logToPaymentFile('paypal_ipn', $_REQUEST['subscr_id']." - RESULT: $res\n");
				} 
			} 
			fclose ($fp); 
		}

		exit;
	}
	
	private function processPayment() {
		if(!isset($_REQUEST['txn_type'])) {
			throw new Exception("Txn type doesn't exist");
		}
		if(isset($_REQUEST['txn_type']) && $_REQUEST['txn_type'] != 'subscr_payment') {
			throw new Exception("Txn type is not payment: ".$_REQUEST['txn_type']) ;
		}

		if(!isset($_REQUEST['payment_status'])) {
			throw new Exception("Payment status doesn't exist");
		}
		if(isset($_REQUEST['payment_status']) && $_REQUEST['payment_status'] != 'Completed') {
			throw new Exception("Payment not completed");
		}
		
		$ids = explode('_', $_REQUEST['item_number']);

		$planId = $ids[0];
		if(isset($ids[1])) {
			$advertiserId = $ids[1];
		} else {
			$advertiserId = '';
		}
		
		$plan = Plan::model()->findByPk($planId);
		if($plan == null) {
			throw new Exception("Plan not found, ID: $planId");
		}
		
		if($plan->type == PlanType::ADVERTISER_PLAN) {
			if($advertiserId == '') {
				throw new Exception("Advertiser not found in item_number");
			}
			
			$advertiser = Advertiser::model()->findByPk($advertiserId);
			if($advertiser == null) {
				throw new Exception("Advertiser not found, ID: $advertiserId");
			}
			
			if($advertiser->wlabel_id != $plan->wlabel_id) {
				throw new Exception("Advertiser and Plan belong to a different accounts: ".$advertiser->wlabel_id." <> ".$plan->wlabel_id);
			}
		}
		
		$purchasedPlan = PurchasedPlan::model()->findByAttributes( array('subscription_id'=>$_REQUEST['subscr_id'], 'wlabel_id'=>$plan->wlabel_id) );
		if($purchasedPlan == null) {
			if(intval($plan->price) != intval($_REQUEST['mc_gross'])) {
				throw new Exception("Advertiser and Plan have different prices, possible fraud? ".intval($plan->price)." <> ".intval($_REQUEST['amount3']));
			}

			// insert new purchased plan
			$purchasedPlan = new PurchasedPlan;
			$purchasedPlan->plan_id = $plan->plan_id;
			$purchasedPlan->wlabel_id = $plan->wlabel_id;
			$purchasedPlan->type = $plan->type;
			if($advertiserId != '') {
				$purchasedPlan->advertiser_id = $advertiserId;
			}
			$purchasedPlan->method = PaymentType::TYPE_PAYPAL;
			$purchasedPlan->price = $plan->price;
			$purchasedPlan->subscription_id = $_REQUEST['subscr_id'];

			$purchasedPlan->date_created = date("Y-m-d h:i:s");
			
			if(!$purchasedPlan->validate()) {
				throw new Exception("Plan purchase cannot be saved: ".$this->putErrorsToString($purchasedPlan->getErrors()));
			}
			
			$purchasedPlan->save();
		}
		
		// create new purchased_plans payments record
		$purchasedPlanPayment = PurchasedPlanPayment::model()->findByAttributes( array('transaction_id'=>$_REQUEST['txn_id']) );
		if($purchasedPlanPayment != null) {
			throw new Exception("There already exists payment with this transaction ID: ".$_REQUEST['txn_id']);
		}
		$purchasedPlanPayment = new PurchasedPlanPayment;

		$purchasedPlanPayment->pplan_id = $purchasedPlan->pplan_id;
		$purchasedPlanPayment->date_paid = $purchasedPlan->date_created;
		$purchasedPlanPayment->date_expire = Date('y-m-d', strtotime("+$plan->duration day"));
		$purchasedPlanPayment->transaction_id = $_REQUEST['txn_id'];

		if(!$purchasedPlanPayment->validate()) {
			throw new Exception("Plan payment cannot be saved: ".$this->putErrorsToString($purchasedPlanPayment->getErrors()));
		}

		$purchasedPlanPayment->save();
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
