<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		if(Yii::app()->user->isMediabroker()) {
			$mediaBroker = Mediabroker::model()->findByPk(Yii::app()->user->getMediabrokerId());
			$wlAccount = WhiteLabel::model()->findByPk(Yii::app()->user->getWhitelabelId());
			$model=new MediabrokerClick;
			$data = Mediabroker::model()->getStatsData(Yii::app()->user->getMediabrokerId());
			
			$this->render('mediabroker_index',
					array(
							'wlAccount'=>$wlAccount,
							'model'=>$model,
							'data'=>$data,
							'mbrokerId'=>Yii::app()->user->getMediabrokerId(),
							'mediaBroker'=>$mediaBroker,
					));
		} else {
			$qsForm = new QuickStatsForm;

			$quickStats = $this->getQuickStats($qsForm);
			
			$cForm = new SiteadminContactForm;
			if(isset($_POST['SiteadminContactForm'])) {
				$cForm->attributes=$_POST['SiteadminContactForm'];
				
				$valid = $cForm->validate();
				if($valid) {
					$cForm->sendMessage();
				}
			}
			
			$this->render('index',
					array(
							'quickStats'=>$quickStats,
							'cForm'=>$cForm,
							'qsForm'=>$qsForm,
					));
		}
	}

	private function getQuickStats($qsForm) {
		if(isset($_POST['QuickStatsForm'])) {
			$qsForm->attributes=$_POST['QuickStatsForm'];
			$qsForm->saveDatesToSession();
		} else {
			$qsForm->loadDatesFromSession();
		}
		
		return ViewsStats::getQuickStats($qsForm->dateFrom, $qsForm->dateTo);
	}	
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = 'login';
		
		$model = new AdminLoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['AdminLoginForm']))
		{
			$model->attributes=$_POST['AdminLoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}	
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}	
	
	
	/**
	 * Displays the login page
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout(true);

		$this->redirect(Yii::app()->user->loginUrl);
	}		
}