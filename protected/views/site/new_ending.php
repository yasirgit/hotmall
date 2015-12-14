<section id="main-content" class="with-heading new">
<!-- Main Content Starts -->
	<section id="coupon-wrapper" itemscope="itemscope" itemtype="http://schema.org/LocalBusiness">
	<!-- Coupon Wrapper Starts -->
		<div class="heading-title">
			<a href="javascript:window.history.back()"></a><!-- Back -->
<?php
		if($couponsType == CouponType::TYPE_NEW) {
			echo "<h2>Newest Offers</h2>";
		} else if($couponsType == CouponType::TYPE_ENDING) {
			echo "<h2>Offers Ending Soon</h2>";
		} else if($couponsType == CouponType::TYPE_ENDING) {
			echo "<h2>My Favorites</h2>";
		}
?>
		</div>
		<article class="coupon-container">
		<!-- Content Area Starts -->
<?php if(count($coupons['featured']) > 0) { ?>
		<h2>Featured Advertisers</h2>

		<ul class="coupon-listings" itemprop="itemOffered" itemscope="itemscope" itemtype="http://schema.org/Offer">
		
		<?php echo $this->renderPartial('coupons_list', array('coupons' => $coupons['featured'])); ?>

		</ul>
<?php } ?>

<?php if(count($coupons['standard']) > 0) { ?>

		<h2>Advertisers</h2>
		<ul class="coupon-listings" itemprop="itemOffered" itemscope="itemscope" itemtype="http://schema.org/Offer">
		
		<?php echo $this->renderPartial('coupons_list', array('coupons' => $coupons['standard'])); ?>

		</ul>

<?php } ?>
		
		<!-- Content Area Ends -->
		</article>
	<!-- Content Wrapper Ends -->
	</section>
	<br class="clear" /><!-- Automatically increase height with content -->
<!-- Main Content Ends -->
</section>

