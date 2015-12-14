<section id="coupon-wrapper">
<!-- Coupon Wrapper Starts -->

<div class="heading-title">
	<a href="<?php echo Yii::app()->createUrl('listing', array('id'=>$listingId)); ?>"></a><!-- Back -->
	<a href="<?php echo Yii::app()->createUrl('listing/map', array('id'=>$listingId)); ?>"></a><!-- Map -->
	<h2><?php echo $listing->name; ?></h2>
</div>

<article class="coupon-container">
	<div class="coupon-outer">
	<!-- coupon-outer Starts -->
		<div class="coupon-padding">
		<!-- Coupon Box Padding Div Start -->
			<section class="coupon info">
			<!-- Coupon Starts -->
				<h3><?php echo $coupon->headline; ?></h3>
				<aside>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo Yii::app()->params['listingLogo']; ?>/<?php echo $listing->logo; ?>&amp;w=211&amp;h=157&amp;q=30&amp;a=tc" title="The Coupon Image"/>
				
					<div class="rate-us">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/five-star.png&amp;w=163&amp;h=24&amp;q=30&amp;a=tc" title="Rating Stars"/>
					</div>				
					<div class="share">
						<a href="#">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/email-icon.png&amp;w=24&amp;q=30&amp;a=tc" title="Email It"/>
						</a>
						<a href="#">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/textit-icon.png&amp;w=24&amp;q=30&amp;a=tc" title="Text It"/>
						</a>
						<a href="#">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/facebook-icon.png&amp;w=24&amp;q=30&amp;a=tc" title="Facebook"/>
						</a>
						<a href="#">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/twitter-icon.png&amp;w=24&amp;q=30&amp;a=tc" title="Twitter"/>
						</a>
					</div>
				</aside>		
				<span class="coupon-description"><?php echo $coupon->description; ?></span>
				<div class="disclaimer-code">
					<div class="coupon-expiration"><?php echo $coupon->expiration; ?></div>
					<div class="restrictions"><?php echo $coupon->disclaimer; ?></div>		
					<div class="coupon-code">
					<hgroup>
						<h1>Thank You For Redeeming This Promotion:</h1>
						<div class="code"><?php echo $coupon->code; ?></div>
					</hgroup>
					</div>
				<!--					
					<div class="coupon-code">
						<a href="<?php echo Yii::app()->createUrl('listing/coupon_redeem', array('id'=>$coupon->coupon_id)); ?>" class="coupon-redeem">Store Use Only - Click To Redeem</a>
						<div class="code"><?php echo $coupon->code; ?></div>
					</div>
-->					
				</div>
				<br class="clear" /><!-- Just to increase height automatically -->
			<!-- Coupon Ends -->	
			</section>
		<!-- Coupon Box Padding Div End -->	
		</div>
	<!-- coupon-outer Ends -->
	</div>	
	
	<section class="coupon">
	<!-- Business listing Starts -->
	<h3><?php echo $listing->name; ?></h3>
	<address><?php echo $listing->street_address; ?><br/><?php echo $listing->city; ?> <?php echo $listing->state; ?> <?php echo $listing->zip; ?></address>
	<p class="phone"><a href="#"><?php echo $listing->phone; ?></a></p>		
		
		<ul class="content-menu coupon-page">
			<li class="hours">
				<a href="#">Hours</a>
					<table>
						<tr>
							<th>Days</th>
							<th>Open</th>
							<th>Close</th>
						</tr>
						<tr>
							<td>Monday</td>
							<td>9:00am</td>
							<td>5:00pm</td>
						</tr>
						<tr>
							<td>Tuesday</td>
							<td>9:00am</td>
							<td>5:00pm</td>
						</tr>
						<tr>
							<td>Wednesday</td>
							<td>9:00am</td>
							<td>5:00pm</td>
						</tr>
						<tr>
							<td>Thursday</td>
							<td>9:00am</td>
							<td>5:00pm</td>
						</tr>
						<tr>
							<td>Friday</td>
							<td>9:00am</td>
							<td>5:00pm</td>
						</tr>
						<tr>
							<td>Saturday</td>
							<td>9:00am</td>
							<td>5:00pm</td>
						</tr>
						<tr>
							<td>Sunday</td>
							<td>Closed</td>
							<td>Closed</td>
						</tr>
					</table>
			</li>		
			<li>
				<a href="tell-friend.php">Share</a>
			</li>
			<li>
				<a href="http://www.google.com">Website</a>
			</li>
			<li>
				<a href="http://places.google.com/rate">Rate us</a>
			</li>
		</ul>
		
		<br class="clear" /><!-- Just to increase height automatically -->
	<!-- Business Listing Ends -->	
	</section>

	<?php echo $this->renderPartial('reviews', array('listing' => $listing, 'listingId'=>$listing->listing_id)); ?>

</article>	

<!-- Coupon Wrapper Ends -->
</section>


<br class="clear" /><!-- Just to increase height automatically -->