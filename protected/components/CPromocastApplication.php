<?php

class CPromocastApplication extends CWebApplication {

	public function beforeControllerAction($controller, $action) {
		$this->processAffiliateLink();
		
		//print_r($_COOKIE);
		
		return parent::beforeControllerAction($controller, $action);
	}
	
	private function processAffiliateLink() {
		if(!isset($_GET['pc']) || $_GET['pc'] == '') {
			return;
		}
		
		$promocode = $_GET['pc'];
		$mediaBroker = Mediabroker::model()->findByPromocode($promocode);
		if($mediaBroker == null) {
			return;
		}
		
		$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$referer = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
		$wlAccount = WhiteLabel::model()->findByPk($mediaBroker->wlabel_id);
		if($wlAccount == null) {
			return;
		}

		// save cookie
		$correctDomain = '.'.$wlAccount->domain;
		//$correctDomain = '127.0.0.1';
		
		$success = setcookie("p_ref", $mediaBroker->mbroker_id, time()+60*60*24*30, "/", $correctDomain); // 30 days expiration
		
		$click = new MediabrokerClick;
		$click->mbroker_id = $mediaBroker->mbroker_id;
		$click->date_created = date("Y-m-d h:i:s");
		$click->url = $url;
		$click->referer = $referer;
		$click->save();
	}
}