<?php
		
class PaymentType 
{
  const TYPE_PAYPAL = 1;
  const TYPE_AUTHORIZENET = 2;
  
	public static function getType($type) {
		if($type == PaymentType::TYPE_PAYPAL) {
			return "PayPal";
		} else if($type == PaymentType::TYPE_AUTHORIZENET) {
			return "Authorize.net";
		}
	}
	
	public static function findAll() {
		return array(
					array('id'=>PaymentType::TYPE_PAYPAL,
						  'name'=>'PayPal'
						),
						array('id'=>PaymentType::TYPE_AUTHORIZENET,
						  'name'=>'Authorize.net'
						),
				);
	}
}

?>