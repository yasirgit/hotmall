<?php
		
class PremiumAdPosition 
{
	const POS_TOP = 1;
	const POS_BOTTOM = 2;
	const POS_SIDEBAR = 3;
  
	public static function findAll() {
		return array(
					array('id'=>PremiumAdPosition::POS_TOP,
						  'name'=>'Top'
						),
					array('id'=>PremiumAdPosition::POS_BOTTOM,
						  'name'=>'Bottom'
						),
					array('id'=>PremiumAdPosition::POS_SIDEBAR,
						  'name'=>'Sidebar'
						),
				);
	}

	public static function getType($type) {
		$arr = PremiumAdPosition::findAll();
		
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