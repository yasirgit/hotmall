<?php
		
class UserStatus 
{
	const STATUS_PENDING = 0;
	const STATUS_APPROVED = 1;
	  
	public static function getStatus($type) {
		if($type == UserStatus::STATUS_PENDING) {
			return "Pending";
		} else if($type == UserStatus::STATUS_APPROVED) {
			return "Approved";
		}
	}
	
	public static function findAll() {
		return array(
					array('id'=>0,
						  'name'=>'Pending'
						),
					array('id'=>1,
						  'name'=>'Approved'
						),
				);
	}
}

?>