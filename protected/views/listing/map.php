<section id="coupon-wrapper">
<!-- Coupon Wrapper Starts -->

<div class="heading-title">
	<a href="<?php echo Yii::app()->createUrl('listing', array('id'=>$listingId)); ?>"></a><!-- Back -->
	<h2><?php echo $listing->name; ?></h2>
</div>

<?php

?>
<article class="coupon-container">

	<section class="coupon map">
	<!-- A Map Starts -->
		<object data="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $listing->addressForMap; ?>&amp;output=embed" type="text/html" id="map">
		</object>
	<!-- A Map Ends -->	
	</section>

</article>

<span class="page-detail">
	<h1>Location Listings</h1>    
	<ul class="list-text">
		<li>List of Address one</li>
		<li>List of Address two</li>
		<li>List of Address three</li>
		<li>List of Address four</li>
	</ul>
</span>

<!-- Coupon Wrapper Ends -->
</section>


<br class="clear" /><!-- Just to increase height automatically -->