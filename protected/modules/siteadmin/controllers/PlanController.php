<?php

class PlanController extends GeneralPlanController
{
	public $layout='//layouts/column2';
	protected $planType = PlanType::ADVERTISER_PLAN;
	
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
						'roles'=>array(UserType::TYPE_SUPERADMIN, UserType::TYPE_WHITELABELADMIN),
					),
				array('deny',  // deny all users
						'users'=>array('*'),
					),
		);
	}
	
	public function actionDelete($id)
	{
		parent::actionDelete($id);
	}
}
