<?php if(count($coupons) > 0) { ?>

<ul class="coupon-listings">
	<?php foreach($coupons as $coupon) { ?>
	
	<li>
		<a href="<?php echo Yii::app()->createUrl('listing/coupon', array('id'=>$coupon['coupon_id'])); ?>">
		<h4><?php echo $coupon['headline']; ?></h4>
		<p><?php echo $coupon['description']; ?></p>
		</a>
	</li>

	<?php } ?>

</ul>

<?php } ?>			
