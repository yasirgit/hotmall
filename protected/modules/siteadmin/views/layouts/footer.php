	<div id="footer">
		<div id="menu">
			<a href="<?php echo Yii::app()->createUrl('siteadmin'); ?>" title="Home">Home</a>
			<a href="<?php echo Yii::app()->createUrl('siteadmin'); ?>" title="Administration">Administration</a>
			<a href="<?php echo Yii::app()->createUrl('siteadmin/settings'); ?>" title="Settings">Settings</a>
			<a href="<?php echo Yii::app()->createUrl('siteadmin/contactus'); ?>" title="Contact">Contact</a>
		</div>
		Copyright &copy; 2011 - LocalBargains Admin Panel (<a href="http://Localbargains.mobi">Localbargains.mobi</a>)
	</div>
		<?php 
				$location = Yii::app()->user->getLocation();
				echo "WhiteLabel account Id: [".Yii::app()->user->getWhiteLabelId()."]"; //, Location: [".$location->location_id."] ";
				echo "Listing Id: ".Yii::app()->user->getListingId();
			?>