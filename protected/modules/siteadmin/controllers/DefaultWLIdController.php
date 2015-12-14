<?php

class DefaultwlidController extends Controller
{
	public function actionIndex()
	{
    	if(isset($_POST['wlabel_id']) && $_POST['wlabel_id'] != '') {
    		Yii::app()->user->setDefaultWhiteLabelId($_POST['wlabel_id']);
    	}
    	
		$this->redirect(Yii::app()->createUrl("siteadmin"));
	}

	
}