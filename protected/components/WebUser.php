<?php

class WebUser extends CWebUser {

	public $sitePart;
	public $allowAutoLogin = true;
	private $categoryId = 0;
	private $lastCouponId = null;
	private $listingId = null;
	
	/**
	 * HANDLING THE WHITE LABEL ACCOUNTS
	 */	
	public function getWhiteLabel() {
		return WhiteLabel::model()->findByPk($this->getWhiteLabelId());
	}
	
	public function getWhiteLabelId() {
		$host = $this->getHost();
		$wlId = Yii::app()->cache->get("WL_".$host);
		if($wlId != false) {
			//echo "IN CACHE";
			return $wlId;
		}

		return $this->recognizeWLFromHost($host);
	}

	private function getHost() {
		//return 'www.proximitymarketingservices.net';
		return $_SERVER['HTTP_HOST'];
	}
	
	private function recognizeWLFromHost($host) {
		$accounts = WhiteLabel::model()->findRealAccountsAsRecords();
		
		foreach($accounts as $account) {
			if(strripos($host, $account->domain) !== false) {
				//echo "BY DOMAIN";
				Yii::app()->cache->set("WL_".$host, $account->wlabel_id);
				//Yii::app()->cache->set("WL_DOMAIN_".$host, $account->domain);
				$this->setState('location', null);
				return $account->wlabel_id;
			}
		}

		// WhiteLabel account not found by the domain!?!
		foreach($accounts as $account) {
			//echo "FIRST";
			$this->setState('location', null);
			return $account->wlabel_id;
		}
		
		return null;
	}

	/**
	 * HANDLING THE LOCATIONS
	 */
	public function getLocationId() {
		$location = $this->getLocation();
		if($location != null) {
			return $location->location_id;
		}
	}
	
	public function getLocation() {
		$location = $this->getLocationFromHost();
		if($location != null && $location != false) {
			return $location;
		}
		
		//echo "LOC_FIRST";
		$location = $this->getDefaultLocation();
			
		return $location;
	}
	
	private function getLocationFromHost() {
		$host = $this->getHost();
		$locId = Yii::app()->cache->get("WL_LOC_".$host);
		if($locId != false) {
			//echo "LOC_IN_CACHE";
			return Location::model()->findByPk($locId);
		}

		return $this->recognizeLocationFromHost($host);
	}
	
	private function recognizeLocationFromHost($host) {
		$locations = Location::model()->getApprovedTopLocations();
		
		foreach($locations as $id => $location) {
			if($location->domain == '') {
				continue;
			}
			
			// it is a subdomain of whitelist domain
			$locDomainString = $location->domain.'.';
			
			if(strripos($host, $locDomainString) !== false) {
				//echo "LOC BY DOMAIN";
				Yii::app()->cache->set("WL_LOC_".$host, $location->location_id);
				return $location;
			}
		}

		return null;
	}

	public function getDefaultLocation() {
		// get first available approved location id in the current account
		$locations = Location::model()->getApprovedTopLocations();

		$defaultLocation = null;
		foreach($locations as $id => $row) {
			$defaultLocation = $row;
			break;
		}

		if($defaultLocation == null) {
			return null;
		}

		return $row;
	}	

	/*
	 * HANDLING CATEGORY
	 */
	
	public function setCategoryId($categoryId) {
		$this->categoryId = $categoryId;
	}

	public function getCategoryId() {
		return $this->categoryId;
	}
	
	public function getFullPathToImages($imagesDirectory) {
		$webPath = str_replace(DIRECTORY_SEPARATOR."protected", '', Yii::app()->basePath);
		
		return $webPath.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$imagesDirectory.DIRECTORY_SEPARATOR;
	}	
	
	public function isLoggedIn() {
		return ($this->getId() != '' ? true : false);
	}
	
	public function setLastCouponId($couponId) {
		if($couponId != null) {
			$this->setState('last_coupon_id', $couponId);
		}
	}	
	
	public function getLastCouponId() {
		return $this->getState('last_coupon_id', null);
	}	
	
	public function setListingId($listingId) {
		$this->listingId = $listingId;
	}	
	
	public function getListingId() {
		return $this->listingId;
	}			
}