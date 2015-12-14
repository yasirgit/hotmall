		<div id="sidebar">
			<div class="side-col ui-sortable">
            <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					<div class="portlet-header ui-widget-header">Navigation Menu</div>
					<div class="portlet-content">
						<div id="accordion">
							<div>
								<h3><a href="#">Admin Categories</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="<?php echo Yii::app()->createUrl('siteadmin/settings'); ?>" title="Settings">Settings</a></li>
										<li><a href="<?php echo Yii::app()->createUrl('siteadmin/plan'); ?>" title="Plans">Plans</a></li>
										<!--<li><a href="<?php echo Yii::app()->createUrl('siteadmin/newsletter'); ?>" title="Newsletter">Newsletter</a></li>-->
										<li><a href="<?php echo Yii::app()->createUrl('siteadmin/myaccount'); ?>" title="My Account">My Account</a></li>
										<!--<li><a href="<?php echo Yii::app()->createUrl('siteadmin/csvimport'); ?>" title="CSV Import">CSV Import</a></li>-->
										<li><a href="<?php echo Yii::app()->createUrl('siteadmin/default/logout'); ?>" title="Logout">Logout</a></li>
									</ul>
								</div>
							</div>   
                            <div>
								<h3><a href="#">Add/Edit</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="<?php echo Yii::app()->createUrl('siteadmin/advertiser'); ?>" title="Advertisers">Advertisers</a></li>
										<li><a href="<?php echo Yii::app()->createUrl('siteadmin/listing'); ?>" title="Listings">Listings</a></li>
										<li><a href="<?php echo Yii::app()->createUrl('siteadmin/category'); ?>" title="Categories">Categories</a></li>
										<li><a href="<?php echo Yii::app()->createUrl('siteadmin/location'); ?>" title="Locations">Locations</a></li>
										<li><a href="<?php echo Yii::app()->createUrl('siteadmin/autoresponder'); ?>" title="Autoresponder">Autoresponder</a></li>
										<li><a href="<?php echo Yii::app()->createUrl('siteadmin/premiumad'); ?>" title="Premium Ad">Premium Ad</a></li>
										<li><a href="<?php echo Yii::app()->createUrl('siteadmin/mediabroker'); ?>" title="Media Brokers">Media Brokers</a></li>
									</ul>
								</div>
							</div>                     
							<div>
								<h3><a href="#">Dashboard</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="index.php" title="Administration">Administration</a></li>
										<li><a href="forms.php" title="Forms">Forms Example</a></li>
										<li><a href="tables.php" title="Tables">Tables example</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					<div class="portlet-header ui-widget-header">Theme Switcher</div>
					<div class="portlet-content">
						<ul class="side-menu">
							<li>
								<a class="set_theme" id="default" href="javascript:void(0);" title="Default Theme"><strong>Light Grey Theme</strong></a>
							</li>
							<li>
								<a class="set_theme" id="light_blue" href="javascript:void(0);" title="Light Blue Theme">Light Blue Theme</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					<div class="portlet-header ui-widget-header">Layout Options</div>
					<div class="portlet-content">
						<ul class="side-menu">
							<li>
								Here, you can set the page width, either fixed or fluid. You decide!<br /><br />
							</li>
							<li id="fluid_layout">
								<a href="javascript:void(0);" title="Fluid Layout">Switch to <strong>Fluid Layout</strong></a>
							</li>
							<li id="fixed_layout">
								<a href="javascript:void(0);" title="Fixed Layout">Switch to <strong>Fixed Layout</strong></a>
							</li>
						</ul>
					</div>
				</div>
				
				<div class="other-box yellow-box ui-corner-all">
					<div class="cont tooltip ui-corner-all" title="Tooltips, tooltips, tooltips !">
						<h3>Tooltip !</h3>
						<p>This is a sample tooltip !</p>
					</div>
				</div>
				<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					<div class="portlet-header ui-widget-header">Accordion</div>
					<div class="portlet-content">
						<div id="datepicker"></div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>