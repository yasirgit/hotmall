<?php if(1==2) { ?>

	<section class="reviews">
		<!-- Reviews section Start -->		
			<?php $this->widget('Review', array('review_id'=>123)); ?>
			<?php $this->widget('Review', array('review_id'=>456)); ?>
			<?php $this->widget('Review', array('review_id'=>789)); ?>
			
			<aside class="review-write text-box">
			<!-- review-write Text Box Start -->
				<ul class="content-menu index-page reviews">
					<li>
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/icon-reviews.png&amp;w=48" title="Tell us your opinion, Add a review." />
						<a href="reviews.php#review-add">Write A Review</a>
					</li>
					<li>
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/icon-reviews.png&amp;w=48" title="See more reviews." />
						<a href="reviews.php">See More Reviews (8)</a>
					</li>
				</ul>
			<!-- review-write Text Box End -->
			</aside>
		<!-- Reviews section End -->	
		</section>			
<?php } ?>			
