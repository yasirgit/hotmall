<?php

class SiteadminModule extends CWebModule
{
	public function init()
	{
		parent::init();
	
		Yii::app()->setComponents(array(
			'errorHandler'=>array(
				'class'=>'CErrorHandler',
				'errorAction'=>'siteadmin/default/error',
			),
			'user'=>array(
				'class'=>'BackendUser',
				'stateKeyPrefix'=>'siteadmin2',
				'loginUrl'=>Yii::app()->createUrl('siteadmin/default/login'),
				'allowAutoLogin'=>true,
				'sitePart'=>'siteadmin',
			),
		), false);
		
		Yii::app()->user->setReturnUrl(Yii::app()->createUrl('siteadmin'));
		Yii::app()->user->allowAutoLogin = true;
	}
	
	public function beforeControllerAction($controller, $action)
	{
		$controller->layout = 'admin_column2';

		if(parent::beforeControllerAction($controller, $action))
		{
			$route=$controller->id.'/'.$action->id;

			$publicPages=array(
				'default/login',
				'default/error',
				'user/forgotpwd',
				'user/forgotpwd2',
			);
			if(Yii::app()->user->isGuest && !in_array($route,$publicPages)) {
				Yii::app()->user->loginRequired();
			} else {
				return true;
			}
		}
		return false;
	}
}
