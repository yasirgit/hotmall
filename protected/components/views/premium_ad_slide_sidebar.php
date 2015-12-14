<?php	foreach($premiumAds as $premiumAd) { ?>

			<li>

				<span class="business-img">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo Yii::app()->params['premiumAdImage']; ?>/<?php echo $premiumAd['image'];?>&amp;w=211&amp;h=157&amp;q=30&amp;a=tc" alt="Featured Business Image" />
				</span>
    
				<article>
					<h2><?php echo $premiumAd['headline'];?></h2>
					<p><?php echo $premiumAd['description'];?></p>
					<a href="<?php echo $premiumAd['link_url'];?>"><?php echo $premiumAd['link_text'];?></a>
					<br class="clear" />
				</article>
				<br class="clear" />
			</li>

<?php  	} ?>