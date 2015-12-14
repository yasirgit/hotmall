<?php

class MediabrokerController extends Controller
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
		$mediabroker=new Mediabroker;
		$user=new User;

		if(isset($_POST['User']))
	    {
	        // populate input data to $a and $b
	    	$user->attributes=$_POST['User'];
	    	
	    	$mediabroker->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->type = UserType::TYPE_MEDIABROKER;
			$user->date_created = date("Y-m-d h:i:s");
			
			$user->status = $this->getStatusAccordingToWLModeration();
			
			//print_r("STATE: ".$user->status);
			$valid = true;
			
			$mediabroker->promocode = $this->generateUniquePromocode($user->first_name, $user->last_name);
			//print_r("PROMOCODE: ".$mediabroker->promocode);

			// validate BOTH $a and $b
	        $valid=$mediabroker->validate() && $valid;
 	        $valid=$user->validate() && $valid;

	    	if($user->password != '' && $user->password != $user->confirm_password) {
				$user->addError('password', 'You have to use the same password!');
				$valid = false;
			}
	        
	        if($valid)
	        {
	        	$user->save(false);
	        	$mediabroker->user_id = $user->user_id;
	        	
	        	$mediabroker->save(false);
	        	
	        	$this->redirect(array('mediabroker/regsuccessful'));
	        }
	    }
	    
		$this->render('register', array('user'=>$user));
	}	
	
	private function generateUniquePromocode($firstName, $lastName) {
		$prefix = substr($this->cleanText($firstName), 0, 4).substr($this->cleanText($lastName), 0, 4);
		
		while(true) {
			$promocode = $prefix.substr(md5(uniqid()), 0, 3);
			$existing = Mediabroker::model()->findByAttributes(array('promocode' => $promocode));
			
			if($existing == null) {
				return $promocode;
			}
		}
	}
	
	private function cleanText($text) 
	{ 
		$text=strtolower($text); 
		$code_entities_match = array('\'',' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','='); 
		$code_entities_replace = array('', '-','-','','','','','','','','','','','','','','','','','','','','','','','',''); 
		$text = str_replace($code_entities_match, $code_entities_replace, $text); 
		return $text; 
	}
	
	private function getStatusAccordingToWLModeration() {
		$wlAccount = WhiteLabel::model()->findByPk(Yii::app()->user->getWhiteLabelId());
		if(!$wlAccount) {
			throw new CHttpException(1234, "Account cannot be found!");
		}
		
		if($wlAccount->moderate_mediabrokers == 1) {
			return UserStatus::STATUS_PENDING;
		} else {
			return UserStatus::STATUS_APPROVED;
		}
	}
}
