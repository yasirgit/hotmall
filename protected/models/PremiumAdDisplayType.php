<?php
		
class PremiumAdDisplayType
{
	const TYPE_BGIMG_WITH_TEST = 1;
	const TYPE_IMG_ONLY = 2;
	const TYPE_STANDARD_OFFER = 3;

	public static function findAll() {
		return array(
				array('id'=>PremiumAdDisplayType::TYPE_BGIMG_WITH_TEST,
					  'name'=>'Background Image With Offer text'
					),
				array('id'=>PremiumAdDisplayType::TYPE_IMG_ONLY,
					  'name'=>'Image Only, No Text'
					),
				array('id'=>PremiumAdDisplayType::TYPE_STANDARD_OFFER,
					  'name'=>'Standard Offer With Text And Logo'
					),
			);
	}

	public static function getType($type) {
		$arr = PremiumAdDisplayType::findAll();

		foreach($ass as $value) {
			foreach($value as $id=>$name) {
				if($id == $type){
					return $name;
				}
			}
		}

		return 'Unknown';
	}
}

?>