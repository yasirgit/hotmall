<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class FrontendUser extends WebUser {

	protected $_model = null;
	
	public function getModel()
	{
		if (!$this->_model)
		{
			if ($this->id) $this->_model = Customer::model()->findByPk($this->id);
			else $this->_model = Customer::model();
		}

		return $this->_model;
	}
	
	//AAA
	public function getWhiteLabelId() {
		if(ViewsTrack::isDev()) {
			return 3;
		}
		
		return parent::getWhiteLabelId();
	}
}