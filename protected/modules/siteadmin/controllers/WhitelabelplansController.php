<?php

class WhitelabelplansController extends Controller
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
						'actions'=>array('index','view'),
						'roles'=>array(UserType::TYPE_SUPERADMIN),
					),
				array('deny',  // deny all users
						'users'=>array('*'),
					),
		);
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

			//echo "AP: ".$form->advertiser_id."|";
			///print_r($_POST['PurchasedPlan']);
			//exit;
			if($form->validate()) {
				//echo "AP: ".$form->advertiser_id."|";
				$form->purchasePlan($this->getPlanType());
				
				$this->redirect(array('index'));
			}
		}
		
		if(isset($_GET['PurchasedPlan']))
			$model->attributes=$_GET['PurchasedPlan'];

		$this->render('index',array(
			'model'=>$model,
			'planType'=>$this->getPlanType(),
		));
	}
	
	private function getPlanType() {
		return PlanType::WHITELABEL_PLAN;
	}
}
