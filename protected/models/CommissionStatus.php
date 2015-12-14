<?php
		
class CommissionStatus
{
  const STATUS_PENDING = 0;
  const STATUS_APPROVED = 1;
  
	public static function getStatus($status) {
		if($status == CommissionStatus::STATUS_PENDING) {
			return "Pending";
		} else if($status == CommissionStatus::STATUS_APPROVED) {
			return "Approved";
		}
	}
	
	public static function findAll() {
		return array(
					array('id'=>CommissionStatus::STATUS_PENDING,
						  'name'=>'Pending'
						),
					array('id'=>CommissionStatus::STATUS_APPROVED,
						  'name'=>'Approved'
						),
				);
	}	
}

?>