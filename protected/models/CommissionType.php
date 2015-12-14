<?php
		
class CommissionType 
{
  const TYPE_FIXED = 1;
  const TYPE_PERCENTAGE = 2;
  
	public static function getType($type) {
		if($type == CommissionType::TYPE_FIXED) {
			return "Fixed ($)";
		} else if($type == CommissionType::TYPE_PERCENTAGE) {
			return "Percentage (%)";
		}
	}
	
	public static function findAll() {
		return array(
					array('id'=>CommissionType::TYPE_FIXED,
						  'name'=>'Fixed ($)'
						),
					array('id'=>CommissionType::TYPE_PERCENTAGE,
						  'name'=>'Percentage (%)'
						),
				);
	}
}

?>