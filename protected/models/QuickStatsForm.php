<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class QuickStatsForm extends CFormModel
{
	public $dateFrom;
	public $dateTo;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username is required
			array('dateFrom, dateTo', 'required'),
		);
	}
	
	public function recoverPassword() {
		$u = User::model()->findByAttributes( array('username'=>$this->username) );
		
		$newPassword = substr(md5(uniqid()), 0, 6);
		$u->password = $newPassword;
		$u->save();
		
		$body = "Hello ".$u->first_name.' '.$u->last_name.",\n\nYour login details are:\n\n";
		$body .= "Username: ".$u->username."\n";
		$body .= "Password: ".$newPassword."\n";
		$body .= "\n\nPromocast Team";
		
		$message = new YiiMailMessage();
		 
        $message->setTo(array($u->email=>$u->first_name.' '.$u->last_name));
        $message->setFrom(array('promocast1@gmail.com'=>'Promocast'));
        $message->setSubject('Your password');
        $message->setBody($body);

        $numsent = Yii::app()->mail->send($message);
        
		return true;
	}
	
	public function saveDatesToSession() {
		Yii::app()->user->setState('qsFrom', $this->dateFrom);
		Yii::app()->user->setState('qsTo', $this->dateTo);
	}

	public function loadDatesFromSession() {
		$this->dateFrom = ViewsStats::getDateFrom();
		$this->dateTo = ViewsStats::getDateTo();
	}
}
