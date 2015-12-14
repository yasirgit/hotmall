<?php
		
class PlanResourceType 
{
	const RTYPE_CATEGORIES_PER_LISTING = 1;
	const RTYPE_LOCATIONS_PER_LISTING = 2;

	const RTYPE_PREMIUMAD_PER_ADVERTISER = 3;

	const RTYPE_IMAGES_PER_ADVERTISER = 4;
	const RTYPE_IMAGES_PER_LISTING = 5;
	const RTYPE_IMAGES_ALLOWED = 6;

	const RTYPE_VIDEOS_PER_ADVERTISER = 7;
	const RTYPE_VIDEOS_PER_LISTING = 8;
	const RTYPE_VIDEOS_ALLOWED = 9;

	const RTYPE_LISTINGS_PER_ADVERTISER = 10;
	const RTYPE_FEATURED_LISTINGS_PER_ADVERTISER = 11;

	const RTYPE_PROMOTIONS_PER_ADVERTISER = 12;
	const RTYPE_PROMOTIONS_PER_LISTING = 13;

	const RTYPE_FORMS_PER_ADVERTISER = 14;


	const RTYPE_LISTINGS_PER_ACCOUNT = 101;
	const RTYPE_LOCATIONS_PER_ACCOUNT = 102;
	const RTYPE_IMAGES_PER_ACCOUNT = 103;
	const RTYPE_VIDEOS_PER_ACCOUNT = 104;
	const RTYPE_FEATURED_LISTINGS_PER_ACCOUNT = 105;
	const RTYPE_PREMIUMADS_PER_ACCOUNT = 106;
	const RTYPE_PROMOTIONS_PER_ACCOUNT = 107;
	const RTYPE_CATEGORIES_PER_ACCOUNT = 108;

	  
  	public static function getAllTypes() {
  		$types = array();
  		$types[PlanType::ADVERTISER_PLAN] = array();
  		$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_CATEGORIES_PER_LISTING=>'Categories per listing'); 
  		$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_LOCATIONS_PER_LISTING=>'Locations per listing'); 
  		
  		$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_PREMIUMAD_PER_ADVERTISER=>'Premium Ad per advertiser'); 
  		
  		//$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_IMAGES_PER_ADVERTISER=>'Images Per Advertiser'); 
  		//$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_IMAGES_PER_LISTING=>'Images Per Listing'); 
  		//$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_IMAGES_ALLOWED=>'Images Allowed'); 
  		
  		//$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_VIDEOS_PER_ADVERTISER=>'Videos Per Advertiser'); 
  		//$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_VIDEOS_PER_LISTING=>'Videos Per Listing'); 
  		//$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_VIDEOS_ALLOWED=>'Videos Allowed'); 
  		
  		$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_LISTINGS_PER_ADVERTISER=>'Listings per advertiser'); 
  		$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_FEATURED_LISTINGS_PER_ADVERTISER=>'Featured Listings per advertiser'); 
  		
  		//$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_PROMOTIONS_PER_ADVERTISER=>'Promotions per advertiser'); 
  		$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_PROMOTIONS_PER_LISTING=>'Promotions per listing'); 
  		
  		//$types[PlanType::ADVERTISER_PLAN][] = array(PlanResourceType::RTYPE_FORMS_PER_ADVERTISER=>'Forms per advertiser'); 

  		$types[PlanType::WHITELABEL_PLAN] = array();
//  		$types[PlanType::WHITELABEL_PLAN][] = array(PlanResourceType::RTYPE_LISTINGS_PER_ACCOUNT=>'Listings per account'); 
  		
  		$types[PlanType::WHITELABEL_PLAN][] = array(PlanResourceType::RTYPE_LOCATIONS_PER_ACCOUNT=>'Locations per account');
/*  		
  		$types[PlanType::WHITELABEL_PLAN][] = array(PlanResourceType::RTYPE_IMAGES_PER_ACCOUNT=>'Images per account'); 
  		$types[PlanType::WHITELABEL_PLAN][] = array(PlanResourceType::RTYPE_VIDEOS_PER_ACCOUNT=>'Videos per account'); 
  		$types[PlanType::WHITELABEL_PLAN][] = array(PlanResourceType::RTYPE_FEATURED_LISTINGS_PER_ACCOUNT=>'Featured Listing per account'); 
  		$types[PlanType::WHITELABEL_PLAN][] = array(PlanResourceType::RTYPE_PREMIUMADS_PER_ACCOUNT=>'Premium Ads per account'); 
  		$types[PlanType::WHITELABEL_PLAN][] = array(PlanResourceType::RTYPE_PROMOTIONS_PER_ACCOUNT=>'Promotions per account'); 
  		$types[PlanType::WHITELABEL_PLAN][] = array(PlanResourceType::RTYPE_CATEGORIES_PER_ACCOUNT=>'Categories per account'); 
*/
  		return $types;
  	}
  	
	public static function getType($type) {
		$types = PlanResourceType::getAllTypes();
		
		foreach($types[PlanType::ADVERTISER_PLAN] as $resourceType) {
			foreach($resourceType as $id=>$name) {
				if($type == $id) {
					return $name;
				}
			}
		}
		
		foreach($types[PlanType::WHITELABEL_PLAN] as $resourceType) {
			foreach($resourceType as $id=>$name) {
				if($type == $id) {
					return $name;
				}
			}
		}

		return 'Unknown type';
	}
	
	public static function findAllByType($planType) {
		$types = PlanResourceType::getAllTypes();
		
		$retArray = array();
		foreach($types[$planType] as $resourceType) {
			foreach($resourceType as $id=>$name) {
				$retArray[] = array('id'=>$id, 'name'=>$name);
			}
		}
		
		return $retArray;
	}
	
	public static function getPlanType($type) {
		$types = PlanResourceType::getAllTypes();
		
		foreach($types[PlanType::ADVERTISER_PLAN] as $resourceType) {
			foreach($resourceType as $id=>$name) {
				if($type == $id) {
					return PlanType::ADVERTISER_PLAN;
				}
			}
		}
		
		foreach($types[PlanType::WHITELABEL_PLAN] as $resourceType) {
			foreach($resourceType as $id=>$name) {
				if($type == $id) {
					return PlanType::WHITELABEL_PLAN;
				}
			}
		}

		return null;
	}
	
}

?>