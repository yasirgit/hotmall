<?php

class ViewsStats {
	
	public static function getQuickStats($fromDate, $toDate) {
		if(Yii::app()->user->isAdvertiser()) {
			return $statsData = ViewsStats::getAdvertiserQuickStats($fromDate, $toDate);
		} else {
			return $statsData = ViewsStats::getWlOrSuperadminQuickStats($fromDate, $toDate);
		}
	}
	
	private static function getWlOrSuperadminQuickStats($fromDate, $toDate) {
		$statsData = array();

		$condition = " WHERE date_created>='$fromDate' AND date_created<='$toDate'";
		if(Yii::app()->user->isWhiteLabelAdmin()) {
			$condition .= " AND wlabel_id=".Yii::app()->user->getWhiteLabelId();
		}

		$categStats = ViewsStats::getSummaryStats('p_view_categories', $condition);
		$subcategStats = ViewsStats::getSummaryStats('p_view_subcategories', $condition);
		$couponStats = ViewsStats::getSummaryStats('p_view_coupons', $condition);
		$listingStats = ViewsStats::getSummaryStats('p_view_listings', $condition);
		
		$statsData['total_system_users'] = $categStats['unique_users'] + $subcategStats['unique_users'] + $couponStats['unique_users'] + $listingStats['unique_users']; 
		$statsData['total_system_views'] = $categStats['views'] + $subcategStats['views'] + $couponStats['views'] + $listingStats['views']; 
		$statsData['total_listing_views'] = $listingStats['views']; 
		$statsData['total_category_views'] = $categStats['views']; 
		$statsData['total_subcategory_views'] = $subcategStats['views']; 
		$statsData['total_promotion_views'] = $couponStats['views']; 
		
		$statsData['ave_time_on_system'] = ViewsStats::safeDivide($categStats['time_on_page'] + $subcategStats['time_on_page'] + $couponStats['time_on_page'] + $listingStats['time_on_page'], $categStats['views'] + $subcategStats['views'] + $couponStats['views'] + $listingStats['views']);
		$statsData['ave_time_on_categories'] = ViewsStats::safeDivide($categStats['time_on_page'], $categStats['views']);
		$statsData['ave_time_on_subcategories'] = ViewsStats::safeDivide($subcategStats['time_on_page'], $subcategStats['views']);
		$statsData['ave_time_on_promotions'] = ViewsStats::safeDivide($couponStats['time_on_page'], $couponStats['views']);
		$statsData['ave_time_on_listings'] = ViewsStats::safeDivide($listingStats['time_on_page'], $listingStats['views']);
		
		$totalVisits = $categStats['visits'] + $subcategStats['visits'] + $couponStats['visits'] + $listingStats['visits'];
		
		$statsData['system_views_per_visit'] = ViewsStats::safeDivide($statsData['total_system_views'], $totalVisits);
		$statsData['total_listing_views_per_visit'] = ViewsStats::safeDivide($statsData['total_listing_views'], $totalVisits);
		$statsData['total_category_views_per_visit'] = ViewsStats::safeDivide($statsData['total_category_views'], $totalVisits);
		$statsData['total_subcategory_views_per_visit'] = ViewsStats::safeDivide($statsData['total_subcategory_views'], $totalVisits);
		$statsData['total_promotion_views_per_visit'] = ViewsStats::safeDivide($statsData['total_promotion_views'], $totalVisits);
		
		$statsData['total_promotions_redeemed'] = ViewsStats::getTotalCouponsRedeemed($fromDate, $toDate);
				
		$statsData['redemption_rate'] = 100*ViewsStats::safeDivide($statsData['total_promotions_redeemed'], $statsData['total_promotion_views']);
		
		foreach($statsData as $k=>$v) {
			if($v == '') {
				$statsData[$k] = 0;
			}
		}
		
		return $statsData;
	}
	
	public static function getSummaryStats($tableName, $condition, $categoryIds = array()) {
		$sql = "SELECT sum(views) as views, sum(unique_users) as unique_users, sum(time_on_page) as time_on_page, sum(visits) as visits FROM $tableName". 
				$condition;
		
		if(count($categoryIds)>0) {
			$sql .= " AND category_id in (".implode(',', $categoryIds).")";
		}
		
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();
		
		//print_r($results);
		return $results[0];
	}
	
	public static function safeDivide($one, $two) {
		if($two == 0) {
			return 0;
		}
		
		return round($one / $two, 2);
	}
	
	private static function getTotalCouponsRedeemed($fromDate, $toDate) {
		$sql = "SELECT count(credemption_id) as redemptions FROM p_coupons_redemptions". 
				" WHERE date_created>='$fromDate' AND date_created<='$toDate'";
		
		if(Yii::app()->user->isWhiteLabelAdmin()) {
			$sql .= " AND coupon_id in(select coupon_id from p_coupons where wlabel_id=".Yii::app()->user->getWhiteLabelId().")";
		}		
		if(Yii::app()->user->isAdvertiser()) {
			//$sql .= " AND coupon_id in(select coupon_id from p_coupons where aaa=".Yii::app()->user->getWhiteLabelId().")";
		}		
		
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();
		
		//print_r($results);
		return $results[0]['redemptions'];		
		
	}
	
	
	private static function getAdvertiserQuickStats($fromDate, $toDate) {
		$categoryIds = ViewsStats::addAdvertiserIds();
		
		$statsData = array();
		
		$condition = " WHERE date_created>='$fromDate' AND date_created<='$toDate'".
						" AND advertiser_id=".Yii::app()->user->getAdvertiserId();

		
		$categStats = ViewsStats::getSummaryStats('p_view_categories', $condition, $categoryIds);
		$subcategStats = ViewsStats::getSummaryStats('p_view_subcategories', $condition, $categoryIds);
		$couponStats = ViewsStats::getSummaryStats('p_view_coupons', $condition);
		$listingStats = ViewsStats::getSummaryStats('p_view_listings', $condition);
		
		$statsData['total_system_users'] = $categStats['unique_users'] + $subcategStats['unique_users'] + $couponStats['unique_users'] + $listingStats['unique_users']; 
		$statsData['total_system_views'] = $categStats['views'] + $subcategStats['views'] + $couponStats['views'] + $listingStats['views']; 
		$statsData['total_listing_views'] = $listingStats['views']; 
		$statsData['total_category_views'] = $categStats['views']; 
		$statsData['total_subcategory_views'] = $subcategStats['views']; 
		$statsData['total_promotion_views'] = $couponStats['views']; 
		
		$statsData['ave_time_on_system'] = ViewsStats::safeDivide($categStats['time_on_page'] + $subcategStats['time_on_page'] + $couponStats['time_on_page'] + $listingStats['time_on_page'], $categStats['views'] + $subcategStats['views'] + $couponStats['views'] + $listingStats['views']);
		$statsData['ave_time_on_categories'] = ViewsStats::safeDivide($categStats['time_on_page'], $categStats['views']);
		$statsData['ave_time_on_subcategories'] = ViewsStats::safeDivide($subcategStats['time_on_page'], $subcategStats['views']);
		$statsData['ave_time_on_promotions'] = ViewsStats::safeDivide($couponStats['time_on_page'], $couponStats['views']);
		$statsData['ave_time_on_listings'] = ViewsStats::safeDivide($listingStats['time_on_page'], $listingStats['views']);
		
		$totalVisits = $categStats['visits'] + $subcategStats['visits'] + $couponStats['visits'] + $listingStats['visits'];
		
		$statsData['system_views_per_visit'] = ViewsStats::safeDivide($statsData['total_system_views'], $totalVisits);
		$statsData['total_listing_views_per_visit'] = ViewsStats::safeDivide($statsData['total_listing_views'], $totalVisits);
		$statsData['total_category_views_per_visit'] = ViewsStats::safeDivide($statsData['total_category_views'], $totalVisits);
		$statsData['total_promotion_views_per_visit'] = ViewsStats::safeDivide($statsData['total_promotion_views'], $totalVisits);
		
		$statsData['total_promotions_redeemed'] = ViewsStats::getTotalCouponsRedeemed($fromDate, $toDate);
				
		$statsData['redemption_rate'] = ViewsStats::safeDivide($statsData['total_promotions_redeemed'], $statsData['total_promotion_views']);
		
		return $statsData;
	}
	
	private static function addAdvertiserIds() {
		$listingIds = ViewsStats::getListingsForAdvertiser();
		
		if(count($listingIds)>0) {
			$sql = "update p_view_listings set advertiser_id=".Yii::app()->user->getAdvertiserId().
					" WHERE listing_id in (".implode(',', $listingIds).")";
		
			$dbCommand = Yii::app()->db->createCommand($sql);
			//$results = $dbCommand->execute();

			$sql = "update p_view_coupons set advertiser_id=".Yii::app()->user->getAdvertiserId().
					" WHERE coupon_id in (select coupon_id from p_coupons where listing_id in (".implode(',', $listingIds)."))";
		
			$dbCommand = Yii::app()->db->createCommand($sql);
			//$results = $dbCommand->execute();
		}
		
		return ViewsStats::getCategoriesForListings($listingIds);
	}
	
	private static function getListingsForAdvertiser() {
		$sql = "SELECT listing_id FROM p_listings". 
				" WHERE advertiser_id=".Yii::app()->user->getAdvertiserId();
		
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();

		$ids = array();
		foreach($results as $result) {
			$ids[] = $result['listing_id'];
		}
		
		return $ids;			
	}

	private static function getCategoriesForListings($listingIds) {
		if(count($listingIds) <= 0) {
			return array();
		}
		
		$sql = "SELECT category_id, parent_category_id FROM p_categories". 
				" WHERE category_id in (select category_id from p_listings_categories where listing_id in (".implode(',', $listingIds)."))";
		
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();

		$ids = array();
		foreach($results as $result) {
			$ids[] = $result['category_id'];
			if($result['parent_category_id'] != 0 && $result['parent_category_id'] != '' && !in_array($result['parent_category_id'], $ids)) {
				$ids[] = $result['parent_category_id'];
			}
		}
		
		return $ids;			
	}
	
	public static function getPromosStats() {
		return array();
	}
	
	public static function getDateFrom() {
		return Yii::app()->user->getState('qsFrom', '2011-01-01 00:00:00');
	}

	public static function getDateTo() {
		return Yii::app()->user->getState('qsTo', '2011-12-31 00:00:00');
	}
}