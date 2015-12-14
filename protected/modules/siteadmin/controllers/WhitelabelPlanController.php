<?php

class WhitelabelPlanController extends GeneralPlanController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	protected $planType = PlanType::WHITELABEL_PLAN;
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index','view', 'create','update', 'delete', 'updateLimit', 'deleteLimit'),
						'roles'=>array(UserType::TYPE_SUPERADMIN),
					),
				array('deny',  // deny all users
						'users'=>array('*'),
					),
		);
	}
}
