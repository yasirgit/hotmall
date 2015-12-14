<?php
		
class ListingType 
{
  const TYPE_STANDARD = 0;
  const TYPE_FEATURED = 1;
  
	public static function getType($type) {
		if($type == ListingType::TYPE_STANDARD) {
			return "Standard";
		} else if($type == ListingType::TYPE_FEATURED) {
			return "Featured";
		}
	}
	
	public static function findAll() {
		return array(
					array('id'=>ListingType::TYPE_STANDARD,
						  'name'=>'Standard'
						),
					array('id'=>ListingType::TYPE_FEATURED,
						  'name'=>'Featured'
						),
				);
	}
}

?>