<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminIdentity extends CUserIdentity {
	private $_id;
	private $_advertiserId;
	private $_mediabrokerId;

	const ERROR_STATUS_PENDING = 4;
	const ERROR_ADVERTISER_NOT_FOUND = 5;

	public function getId() {
		return $this->_id;
	}
    
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$u = User::model()->findByAttributes( array('username'=>$this->username) );

		if (!$u) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else if( !$u->matchesPassword($this->password) ) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else if( $u->status == UserStatus::STATUS_PENDING) {
			$this->errorCode = self::ERROR_STATUS_PENDING;
		} else {
			$this->_id = $u->user_id;
		
			if($u->type == UserType::TYPE_ADVERTISER) {
				$this->_advertiserId = $this->getAdvertiserIdForUser($u->user_id);
				if($this->_advertiserId == null) {
					$this->errorCode = self::ERROR_ADVERTISER_NOT_FOUND;
					return !$this->errorCode;
				}
			} else if($u->type == UserType::TYPE_MEDIABROKER) {
				$this->_mediabrokerId = $this->getMediabrokerIdForUser($u->user_id);
				if($this->_mediabrokerId == null) {
					$this->errorCode = self::ERROR_MEDIABROKER_NOT_FOUND;
					return !$this->errorCode;
				}
			}
			
			$this->errorCode = self::ERROR_NONE;
		}

		return !$this->errorCode;
	}
	
	private function getAdvertiserIdForUser($userId) {
		$a = Advertiser::model()->findByAttributes( array('user_id'=>$userId) );
		if($a != null) {
			return $a->advertiser_id;
		}
		
		return null;
	}

	private function getMediabrokerIdForUser($userId) {
		$mb = Mediabroker::model()->findByAttributes( array('user_id'=>$userId) );
		if($mb != null) {
			return $mb->mbroker_id;
		}
		
		return null;
	}

	public function getAdvertiserId() {
		return $this->_advertiserId;
	}
	
	public function getMediabrokerId() {
		return $this->_mediabrokerId;
	}	
	
}