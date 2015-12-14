<?php
		
class CommissionPayStatus
{
  const STATUS_UNPAID = 0;
  const STATUS_PAID = 1;
  
	public static function getStatus($status) {
		if($status == CommissionPayStatus::STATUS_UNPAID) {
			return "Unpaid";
		} else if($status == CommissionPayStatus::STATUS_PAID) {
			return "Paid";
		}
	}
	
	public static function findAll() {
		return array(
					array('id'=>CommissionPayStatus::STATUS_UNPAID,
						  'name'=>'Unpaid'
						),
					array('id'=>CommissionPayStatus::STATUS_PAID,
						  'name'=>'Paid'
						),
				);
	}		
}

?>