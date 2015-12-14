<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ForgotPwdForm extends CFormModel
{
	public $username;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username is required
			array('username', 'required'),
			array('username', 'usernameExistsInAccount'),
			
		);
	}
	
	public function usernameExistsInAccount($attribute,$params) {
		if($this->username == '') {
			// we don't need to check for empty username
			return;
		}
		
		$u = User::model()->findByAttributes( array('username'=>$this->username) );
		
		if($u == null) {
			$this->addError($attribute, "User with this username wasn't found!");	
		}
		
		return false;
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
}
