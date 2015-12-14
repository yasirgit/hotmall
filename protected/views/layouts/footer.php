
<!-- Main Content Ends -->
</section>

<section class="featured-business">
<!-- Featured business starts -->
	<div class="flexslider">
	    <ul class="slides">
		<?php $this->widget('PremiumAdsSlides', array('position'=>PremiumAdPosition::POS_BOTTOM)); ?>	    
	    </ul>
	</div>
<!-- Featured business ends -->
</section>

<section class="footer-menu">
<!-- Footer Menu Starts -->
<a href="<?php echo Yii::app()->createUrl(''); ?>">Home</a> |
<a href="<?php echo Yii::app()->createUrl('advertiser/info'); ?>">Advertise</a>  |
<a href="<?php echo Yii::app()->createUrl('advertiser/register'); ?>">My Account</a>  |
<a href="<?php echo Yii::app()->createUrl('siteadmin/default/login'); ?>">Advertiser Login</a>  |
<a href="<?php echo Yii::app()->createUrl('mediabroker/info'); ?>">Now Hiring</a>  |
<a href="privacy.php">Privacy</a>  |
<a href="terms.php">Terms</a>
 <!-- Footer Menu Ends -->
</section>

<footer>
<!-- Footer Starts -->
<a href="http://<?php echo Yii::app()->user->getWhiteLabel()->domain; ?>"><?php echo Yii::app()->user->getWhiteLabel()->name; ?></a> - Shop. Save. Live. <br />
Powered By: <a href="http://igomobilemarketing.com/">iGo Mobile Marketing</a> <br />
Copyright 2011 <?php echo Yii::app()->user->getWhiteLabel()->name; ?> All Rights Reserved
<!-- Footer Ends -->
<hr>
<span style="font-size: 11px; color: #888888;">
<?php 
	$location = Yii::app()->user->getLocation();
	echo "WhiteLabel account Id: [".Yii::app()->user->getWhiteLabelId()."], Location: [".($location != null ? $location->location_id : '')."] ".($location != null ? $location->name : '');
	echo "Listing Id: ".Yii::app()->user->getListingId();
?>
</span>
</footer>

<!-- Main Wrapper Ends -->
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/frontend/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/frontend/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/frontend/jquery.validate.pack.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/frontend/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/frontend/scripts.js"></script>

</body>
</html>