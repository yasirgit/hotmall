	<section id="coupon-wrapper">
	<!-- Coupon Wrapper Starts -->

		<div class="heading-title">
			<a href="#"></a><!-- Back -->
			<a href="<?php echo Yii::app()->createUrl('listing/map', array('id'=>$listingId)); ?>"></a><!-- Map -->
			<h2><?php echo $listing->name; ?></h2>
		</div>

		<article class="coupon-container">
			<section class="coupon">
			<!-- Business listing Starts -->
				<h3><?php echo $listing->name; ?></h3>
				<aside>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo Yii::app()->params['listingLogo']; ?>/<?php echo $listing->logo; ?>&amp;w=211&amp;h=157&amp;q=30&amp;a=tc" title="The Coupon Image"/>
				
					<div class="rate-us">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/five-star.png&amp;w=163&amp;h=24&amp;q=30&amp;a=tc" title="Rating Stars"/>
					</div>				
					<div class="share">
						<a href="<?php echo Yii::app()->createUrl('listing/tellafriend', array('id'=>$listingId)); ?>">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=/images/frontend/email-icon.png&amp;w=24&amp;q=30&amp;a=tc" title="Email It" />
						</a>
						<a href="<?php echo Yii::app()->createUrl('listing/tellafriend', array('id'=>$listingId, 'type'=>'sms')); ?>">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=/images/frontend/textit-icon.png&amp;w=24&amp;q=30&amp;a=tc" title="Text It"/>
						</a>
						<a href="http://www.facebook.com/sharer.php?u=<?php $listing->url; ?>" rel="external">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=/images/frontend/facebook-icon.png&amp;w=24&amp;q=30&amp;a=tc" title="Facebook"/>
						</a>
						<a href="https://twitter.com/intent/tweet?url=<?php $listing->url; ?>&via=webstandardcss&related=webstandardcss:Web Standard Design&text=Check out this local bargain I just seen for business_name at <?php $listing->url; ?>" rel="external">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=/images/frontend/twitter-icon.png&amp;w=24&amp;q=30&amp;a=tc" title="Facebook"/>
						</a>
					</div>
				</aside>			
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
						<a href="#" itemprop="contactPoints" class="share-link">Share</a>
					</li>
					<li>
						<a href="<?php echo $listing->url; ?>">Website</a>
					</li>
					<li>
						<a href="http://places.google.com/rate">Rate us</a>
					</li>
				</ul>
				<br class="clear" /><!-- Just to increase height automatically -->
			<!-- Business Listing Ends -->	
			</section>
			
			<?php echo $this->renderPartial('coupons_list', array('listing' => $listing, 'listingId'=>$listing->listing_id, 'coupons'=>$coupons)); ?>
			
			<?php echo $this->renderPartial('reviews', array('listing' => $listing, 'listingId'=>$listing->listing_id, 'coupons'=>$coupons)); ?>

	</article>

		<!--<span class="page-detail">
			<h1>Page Details</h1>    
			<ul class="list-text">
				<li>Listing ID: 72</li>
				<li>Listing ID: 72</li>
				<li>Listing ID: 72</li>
			</ul>
		</span>-->
	<!-- Coupon Wrapper Ends -->
	</section>
	<br class="clear" /><!-- Just to increase height automatically -->