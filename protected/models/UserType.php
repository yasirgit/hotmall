<?php
		
class UserType 
{
  const TYPE_SUPERADMIN = 1;
  const TYPE_WHITELABELADMIN = 2;
  const TYPE_ADVERTISER = 3;
  const TYPE_CUSTOMER = 4;
  const TYPE_MEDIABROKER = 5;
  
	public static function getType($type) {
		if($type == UserType::TYPE_SUPERADMIN) {
			return "Superadmin";
		} else if($type == UserType::TYPE_WHITELABELADMIN) {
			return "Whitelabel Admin";
		} else if($type == UserType::TYPE_ADVERTISER) {
			return "Advertiser";
		} else if($type == UserType::TYPE_CUSTOMER) {
			return "Customer";
		} else if($type == UserType::TYPE_MEDIABROKER) {
			return "Media Broker";
		}
	}
	
	public static function findAll() {
		return array(
					array('id'=>UserType::TYPE_SUPERADMIN,
						  'name'=>'Superadmin'
						),
					array('id'=>UserType::TYPE_WHITELABELADMIN,
						  'name'=>'Whitelabel Admin'
						),
					array('id'=>UserType::TYPE_ADVERTISER,
						  'name'=>'Advertiser'
						),
					array('id'=>UserType::TYPE_MEDIABROKER,
						  'name'=>'Media Broker'
						),
				);
	}
}

?>