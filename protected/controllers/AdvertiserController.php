<?php

class AdvertiserController extends Controller
{

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
				'actions'=>array('info', 'register', 'regsuccessful'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionInfo()
	{
		$this->render('info');
	}
	
	public function actionRegsuccessful()
	{
		$this->render('registration_successful');
	}

	public function actionRegister()
	{
		$advertiser=new Advertiser;
		$user=new User;
		
	    if(isset($_POST['User']))
	    {
	        // populate input data to $a and $b
	    	$user->attributes=$_POST['User'];
	    	
			$advertiser->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->type = UserType::TYPE_ADVERTISER;
			$user->date_created = date("Y-m-d h:i:s");
			
			$user->status = $this->getStatusAccordingToWLModeration();
			
			$valid = true;
			
	        // validate BOTH $a and $b
	        $valid=$advertiser->validate() && $valid;
	        $valid=$user->validate() && $valid;

			if($user->password != '' && $user->password != $user->confirm_password) {
				$user->addError('password', 'You have to use the same password!');
				$valid = false;
			}
	        
	        if($valid)
	        {
	        	$user->save(false);
	        	$advertiser->user_id = $user->user_id;
	        	$advertiser->mbroker_id = Utils::getReferingMediabroker();
	        	$advertiser->save(false);
	        	
	        	$this->redirect(array('advertiser/regsuccessful'));
	        }
	    }
	    
		$this->render('register', array('user'=>$user));
	}	
	
	private function getStatusAccordingToWLModeration() {
		$wlAccount = WhiteLabel::model()->findByPk(Yii::app()->user->getWhiteLabelId());
		if(!$wlAccount) {
			throw new CHttpException(1234, "Account cannot be found!");
		}
		
		if($wlAccount->moderate_members == 1) {
			return UserStatus::STATUS_PENDING;
		} else {
			return UserStatus::STATUS_APPROVED;
		}
	}
}
