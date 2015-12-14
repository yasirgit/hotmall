<?php

class MyplansController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
						'actions'=>array('index','view', 'payreturn', 'payform'),
						'roles'=>array(UserType::TYPE_WHITELABELADMIN, UserType::TYPE_ADVERTISER),
					),
				array('deny',  // deny all users
						'users'=>array('*'),
					),
		);
	}

	public function actionPayreturn()
	{
		$this->render('payreturn',array(
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=PurchasedPlan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$modelPayments=PurchasedPlanPayment::model()->findByAttributes(array('pplan_id'=>$id));
		if($modelPayments===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$modelLimits=PlanLimit::model()->findByAttributes(array('plan_id'=>$model->plan_id));

		$this->render('view',array(
			'model'=>$model,
			'modelPayments'=>$modelPayments,
			'modelLimits'=>$modelLimits,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new PurchasedPlan;
		$form = new PurchasePlanForm;
		
		if(isset($_POST['PurchasedPlan']))
		{
			$form->attributes=$_POST['PurchasedPlan'];

			if($form->validate()) {
				if($_POST['PurchasedPlan']['realPayment'] == 0) {
					//$form->purchasePlan($this->getPlanType());
				
					$this->redirect(array('index'));
				} else {
					$wl = WhiteLabel::model()->findByPk(Yii::app()->user->getWhiteLabelId());
					if($wl == null) {
						throw new Exception("Account doesn't exist");
					}

					$plan = Plan::model()->findByAttributes( array('plan_id'=>$form->plan_id, 'wlabel_id'=>Yii::app()->user->getWhiteLabelId(), 'type'=>$this->getPlanType()) );
					if($plan == null) {
						 throw new Exception("Plan doesn't exist");
					}
					
					if($wl->payment_type == PaymentType::TYPE_PAYPAL) {
						$this->processPayPalPayment($wl, $plan);
					} else if($wl->payment_type == PaymentType::TYPE_AUTHORIZENET) {
						$this->processAuthnetPayment($wl, $plan);
					}

					exit;
				}
			}
		}
		
		if(isset($_GET['PurchasedPlan']))
			$model->attributes=$_GET['PurchasedPlan'];

		$this->render('index',array(
			'model'=>$model,
			'planType'=>$this->getPlanType(),
		));
	}
	
	private function processAuthnetPayment($wlAccount, $plan) {
		$advertiserId = '';
		if(Yii::app()->user->isAdvertiser()) {
			$advertiserId = Yii::app()->user->getAdvertiserId();		
		}
		
		$url = "https://authorizedcheckout.com/siteadmin/payform";
		
		$url .=	"&wid=".$wlAccount->wlabel_id.
				"&pid=".$plan->plan_id.
				"&aid=".$advertiserId.
				"&return=".Yii::app()->createUrl('siteadmin/myplans/payreturn');
			
//		echo ($url);
		$this->redirect($url);
		
		exit;
	}

	private function processPayPalPayment($wlAccount, $plan) {
		$advertiserId = '';
		if(Yii::app()->user->isAdvertiser()) {
			$advertiserId = Yii::app()->user->getAdvertiserId();		
		}
		
		if(Yii::app()->params['paymentsTestMode']) {		
			$url = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_xclick-subscriptions";
		} else {
			$url = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick-subscriptions";
		}
		
		$url .=	"&business=".$wlAccount->paypal_email.
				"&item_name=Plan%20Subscription&item_number=".$plan->plan_id.'_'.$advertiserId.
				"&a3=".$plan->price.
				"&p3=".$plan->duration."&t3=D".
				"&currency_code=USD&src=1".
				"&notify_url=http://proximitymarketingservices.net/paypalipn".
				"&return=http://proximitymarketingservices.net/siteadmin/myplans/payreturn";
			
//		echo ($url);
		$this->redirect($url);
		
		exit;
	}

	private function getPlanType() {
		if(Yii::app()->user->isAdvertiser()) {
			return PlanType::ADVERTISER_PLAN;
		} else {
			return PlanType::WHITELABEL_PLAN;
		}
	}
	
}
