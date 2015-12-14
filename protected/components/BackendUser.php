<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class BackendUser extends WebUser {

	protected $_model = null;
	public $sitePart;
	public $allowAutoLogin = true;
	private $categoryId = 0;
	
	public function getModel()
	{
		if (!$this->_model)
		{
			if ($this->id) $this->_model = User::model()->findByPk($this->id);
			else $this->_model = User::model();
		}

		return $this->_model;
	}

	public function checkAccess($operation, $params = array(), $allowCaching = true)
	{
		//print_r("WL: ".$this->model->p_whitelabel->wlabel_id);
		return ($this->model->type == $operation);
	}
	
	public function isSuperadmin() {
		return ($this->model->type == UserType::TYPE_SUPERADMIN);
	}

	public function isWhiteLabelAdmin() {
		return ($this->model->type == UserType::TYPE_WHITELABELADMIN);
	}

	public function isAdvertiser() {
		return ($this->model->type == UserType::TYPE_ADVERTISER);
	}

	public function isMediabroker() {
		return ($this->model->type == UserType::TYPE_MEDIABROKER);
	}

	public function isFrontend() {
		return ($this->sitePart == 'frontend');
	}

	public function getUserTypeAsText() {
		if($this->isSuperadmin()) return "Superadmin";
		if($this->isWhiteLabelAdmin()) return "Account Admin";
		if($this->isAdvertiser()) return "Advertiser";
		if($this->isMediabroker()) return "Media Broker";
		
		return "";
	}
	
	/**
	 * HANDLING THE WHITE LABEL ACCOUNTS
	 */	
	public function getWhiteLabelId() {
		if($this->isLoggedIn()) {
			// called from siteadmin
			if($this->isSuperadmin()) {
				// for superadmin get default White Label Id
				return $this->getDefaultWhiteLabelId();
			} else {
				// get account of the logged user
				return $this->model->wlabel_id;
			}
		} else {
			return parent::getWhiteLabelId();
		}
	}

	public function setDefaultWhiteLabelId($wlabelId) {
		if($wlabelId != '') {
			$accounts = WhiteLabel::model()->findRealAccounts();
			foreach($accounts as $id => $name) {
				if($wlabelId == $id) {
					$this->setState('wlabel_id', $wlabelId);
					$this->setState('location', null);
					break;
				}
			}
		}
	}
	
	public function getDefaultWhiteLabelId() {
		$defId = $this->getState('wlabel_id', '');
		if($defId == '') {
			// get first available whitelabel account id
			$accounts = WhiteLabel::model()->findRealAccounts();
			
			$defaultAccountId = null;
			foreach($accounts as $id => $name) {
				$defaultAccountId = $id;
				break;
			}
			
			if($defaultAccountId == null) {
				return '';
			}
			
			// save it to session
			$this->setDefaultWhiteLabelId($defaultAccountId);
			
			$defId = $defaultAccountId;
		}
		
		return $defId;
	}
	
	public function setAdvertiserId($id) {
		return $this->setState('_advertiserId', $id);
	}
	
	public function setMediabrokerId($id) {
		return $this->setState('_mediabrokerId', $id);
	}		

	public function getAdvertiserId() {
		return $this->getState('_advertiserId', null);
	}
	
	public function getMediabrokerId() {
		return $this->getState('_mediabrokerId', null);
	}		
}