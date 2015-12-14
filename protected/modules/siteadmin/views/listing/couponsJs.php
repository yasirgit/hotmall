<script type="text/javascript">
// initializiation of counters for new elements
var lastCoupon = <?php echo $coupons->lastNew?>; 
 
// the subviews rendered with placeholders
var trCoupon=new String(<?php echo CJSON::encode($this->renderPartial('_formCoupons', array('id'=>'idRep', 'model'=>new Coupon, 'form'=>$form), true));?>);
 
 
function addCoupon(button)
{
	lastCoupon++;
    button.parents('table').children('tbody').append(trCoupon.replace(/idRep/g,'n'+lastCoupon));
}
 
 
function deleteCoupon(button)
{
    button.parents('tr').detach();
}
 
</script>