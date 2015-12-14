<?php
		
class GeneralStatus 
{
	const STATUS_DEACTIVE = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_DISABLED = 2;
	  
	public static function getStatus($type) {
		if($type == GeneralStatus::STATUS_DEACTIVE) {
			return "Deactive";
		} else if($type == GeneralStatus::STATUS_ACTIVE) {
			return "Active";
		} else if($type == GeneralStatus::STATUS_DISABLED) {
			return "Disabled";
		}
	}
	
	public static function findAll() {
		return array(
					array('id'=>GeneralStatus::STATUS_DEACTIVE,
						  'name'=>'Deactive'
						),
					array('id'=>GeneralStatus::STATUS_ACTIVE,
						  'name'=>'Active'
						),
					array('id'=>GeneralStatus::STATUS_DISABLED,
						  'name'=>'Disabled'
						),
				);
	}
}

?>