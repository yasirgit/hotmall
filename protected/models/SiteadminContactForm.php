<?php

class SiteadminContactForm extends CFormModel
{
	public $name;
	public $email;
	public $subject;
	public $body;
	public $forwhom;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, body, forwhom', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
		);
	}
	
	public function sendMessage() {
	}
}