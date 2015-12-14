<?php

class ViewsTrack {
	  
	public static function isDev() {
		return (Yii::app()->db->username == 'supportc' ? true : false);
	}
	
	public static function addCategoryView($categoryId) {
		ViewsTrack::registerView('p_view_categories', 'category_id', $categoryId);
	}

	public static function addSubCategoryView($categoryId) {
		ViewsTrack::registerView('p_view_subcategories', 'category_id', $categoryId);
	}

	public static function addListingView($listingId) {
		ViewsTrack::registerView('p_view_listings', 'listing_id', $listingId);
	}
	
	public static function addCouponView($couponId) {
		ViewsTrack::registerView('p_view_coupons', 'coupon_id', $couponId);
	}
	
	public static function registerView($tableName, $columnName, $id) {
		$dateTime = ViewsTrack::getDateTime();
		
		if($id == '') {
			$id = 0;
		}
		
		$views = 1;
		$visits = ViewsTrack::getVisitsCount();
		$uniqueUsers = ViewsTrack::getUniqueUserCount();
		$avgTimeOnPage = ViewsTrack::getAvgTimeOnPage();

		$locationId = Yii::app()->user->getLocationId();
		if($locationId == '') {
			$locationId = 0;
		}
		
		$sql = "INSERT DELAYED INTO $tableName(wlabel_id, advertiser_id, date_created, $columnName, location_id, views, unique_users, time_on_page, visits)". 
				" VALUES (".Yii::app()->user->getWhitelabelId().", 0, '".$dateTime."', $id, $locationId, $views, $uniqueUsers, $avgTimeOnPage, $visits)".
				" ON DUPLICATE KEY UPDATE views=views+$views, unique_users=unique_users+$uniqueUsers, time_on_page=time_on_page+$avgTimeOnPage, visits=visits+$visits";

	    $dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->execute();
	}
	
	
	
	public static function getDateTime() {
		return date("Y-m-d H:00:00");
	}
	
	public static function getUniqueUserCount() {
		if(isset($_COOKIE['p_uniq']) && $_COOKIE['p_uniq'] != '') {
			// there is cookie, so it is not unique user
			return 0;
		}		

		// save new cookie
		$cookieDomain = ViewsTrack::getCookieDomain();
		
		$success = setcookie("p_uniq", "1", time()+60*60*24*30, "/", $cookieDomain); // 30 days expiration
		
		if(ViewsTrack::isDev()) {
			// I cannot use cookie domain on localhost, simuate without domain
			$success = false;
		}
		
		if(!$success) {
			// try it again without cookie domain
			$success = setcookie("p_uniq", "1", time()+60*60*24*30, "/"); // 30 days expiration
		}

		return 1;
	}

	public static function getVisitsCount() {
		if(isset($_COOKIE['p_visit']) && $_COOKIE['p_visit'] != '') {
			// there is cookie, so it is not a new visit
			return 0;
		}		

		// save new cookie
		$cookieDomain = ViewsTrack::getCookieDomain();
		
		$success = setcookie("p_visit", "1", 0, "/", $cookieDomain); // expires when browser closes
		
		if(ViewsTrack::isDev()) {
			// I cannot use cookie domain on localhost, simuate without domain
			$success = false;
		}
		
		if(!$success) {
			// try it again without cookie domain
			$success = setcookie("p_visit", "1", 0, "/"); // expires when browser closes
		}

		return 1;
	}

	public static function getCookieDomain() {
		$wlId = Yii::app()->user->getWhitelabelId();
		
		$domain = Yii::app()->cache->get("WL_DOMAIN_".$wlId);
		if($domain != false) {
			return $domain;
		}

		
		$wlAccount = WhiteLabel::model()->findByPk($wlId);
		if($wlAccount == null) {
			return null;
		}

		// save cookie
		$correctDomain = '.'.$wlAccount->domain;

		Yii::app()->cache->set("WL_DOMAIN_".$wlId, $correctDomain);
	}
	
	public static function getAvgTimeOnPage() {
		$timeOnPage = 1;
		$currentTime = time();
		
		if(isset($_COOKIE['p_time']) && $_COOKIE['p_time'] != '') {
			$lastTime = $_COOKIE['p_time'];
			
			$timeOnPage = $currentTime - $lastTime;
		}		

		// save new time to cookie
		$cookieDomain = ViewsTrack::getCookieDomain();
		
		$success = setcookie("p_time", $currentTime, time()+60*30, "/", $cookieDomain); // 30 minutes expiration
		
		if(ViewsTrack::isDev()) {
			// I cannot use cookie domain on localhost, simuate without domain
			$success = false;
		}
		
		if(!$success) {
			// try it again without cookie domain
			$success = setcookie("p_time", $currentTime, time()+60*30, "/"); // 30 minutes expiration
		}

		return $timeOnPage;
	}
	
}