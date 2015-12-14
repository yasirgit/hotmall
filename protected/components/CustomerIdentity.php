<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class CustomerIdentity extends CUserIdentity {
  private $_id;
  
  const ERROR_STATUS_PENDING = 4;
  
  public function getId() {
    return $this->_id;
  }
    
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$u = Customer::model()->findByAttributes( array('mobile'=>$this->username) );

		if (!$u) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else if( $u->password != $this->password ) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
//		} else if( $u->status == User::STATUS_PENDING) {
//			$this->errorCode = self::ERROR_STATUS_PENDING;
		} else {
			$this->_id = $u->customer_id;
			$this->errorCode = self::ERROR_NONE;
		}

		return !$this->errorCode;
	}
}