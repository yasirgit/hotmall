<?php

class PayformController extends Controller
{
	public function actionIndex()
	{
		$this->layout = 'login';

		$wlabelId = (isset($_REQUEST['wid']) ? $_REQUEST['wid'] : '');
		if($wlabelId == '') throw new CHttpException(404,'Bad parameter wid');

		$planId = (isset($_REQUEST['pid']) ? $_REQUEST['pid'] : ''); 
		if($planId == '') throw new CHttpException(404,'Bad parameter pid');

		$advertiserId = (isset($_REQUEST['aid']) ? $_REQUEST['aid'] : '');
		if($advertiserId == '') throw new CHttpException(404,'Bad parameter aid');

		$returnUrl = (isset($_REQUEST['return']) ? $_REQUEST['return'] : '');
		if($returnUrl == '') throw new CHttpException(404,'Bad parameter return');

		$wl = WhiteLabel::model()->findByPk(Yii::app()->user->getWhiteLabelId());
		if($wl == null) {
			throw new Exception("Account doesn't exist");
		}
		
		$plan = Plan::model()->findByAttributes(array('plan_id'=>$planId, 'wlabel_id'=>$wlabelId));
		if($plan == null) {
			throw new CHttpException(404,'Cannot find plan!');
		}

		$advertiser = Advertiser::model()->findByAttributes(array('advertiser_id'=>$planId, 'wlabel_id'=>$advertiserId));
		if($plan == null) {
			throw new CHttpException(404,'Cannot find advertiser!');
		}

		$form = new AuthorizenetPaymentForm;

		if(isset($_POST['AuthorizenetPaymentForm']))
		{
			$form->attributes=$_POST['AuthorizenetPaymentForm'];

			$form->advertiser_id = $advertiserId;
			$form->wlabel_id = $wlabelId;
			$form->plan_id = $plan->plan_id;
			$form->refId = $plan->plan_id;
			$form->name = "Plan Subscription";
			$form->unit = "days";
			$form->totalOccurrences = 999;
			$form->trialOccurrences = 0;
			$form->trialAmount = 0;
			$form->startDate = date('Y-m-d');
			$form->length = $plan->duration;
			$form->amount = $plan->price;

			if($form->validate()) {
				if($form->sendCreateSubscription($wl, $plan)) {
					$this->redirect($returnUrl);
				}
			}
		}

		if(isset($_GET['AuthorizenetPaymentForm']))
			$form->attributes=$_GET['AuthorizenetPaymentForm'];

			$this->render('form_authnet_payment',array(
					'model'=>$form,
					));
	}
}