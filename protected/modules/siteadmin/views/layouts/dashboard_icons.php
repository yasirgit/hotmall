<div class="page-title ui-widget-content ui-corner-all">
					<h1>Administration Categories</h1>
					<div class="other">
					
<?php if(!Yii::app()->user->isAdvertiser() && !Yii::app()->user->isMediabroker()) { ?>
						<ul id="dashboard-buttons">
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin'); ?>" class="dashboard tooltip" title="Dashboard">
									Dashboard
								</a>
							</li>			
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/reports'); ?>" class="reports-icon tooltip" title="Reports"> 
									Reports 
								</a>
								</li>
							
<?php if(!Yii::app()->user->isSuperadmin()) { ?>								
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/settings'); ?>" class="settings tooltip" title="Site Settings">
									Settings
								</a>
							</li>
<?php } ?>							
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/plan'); ?>" class="Plans tooltip" title="Plans">
									Manage Plans
								</a>
							</li>
<!--							
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/newsletter'); ?>" class="newsletter tooltip" title="Newsletter">
									Newsletter
								</a>
							</li>
						
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/myaccount'); ?>" class="EditInfo tooltip" title="My Account">
									My Account
								</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/csvimport'); ?>" class="csv_import_panel tooltip" title="CSV Import">
									CSV Import
								</a>
							</li>
-->
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/advertiser'); ?>" class="users tooltip" title="Advertisers">
								Manage Advertisers
								</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/listing'); ?>" class="listings tooltip" title="Listings">
								Manage Listings
								</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/category'); ?>" class="category tooltip" title="Categories">
								Manage Categories
								</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/location'); ?>" class="location tooltip" title="Locations">
								Manage Locations
								</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/autoresponder'); ?>" class="settings-autoresponder tooltip" title="Autoresponders">
									Autoresponders
								</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/premiumad'); ?>" class="premium-ads tooltip" title="Premium Ad">
									Premium Ad
								</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/mediabroker'); ?>" class="affiliate tooltip" title="Media Brokers">
									Media Brokers
								</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/mediabrokercomm'); ?>" class="affiliate tooltip" title="Media Brokers Commissions">
									Media Brokers Commissions
								</a>
							</li>
<?php if(!Yii::app()->user->isSuperadmin()) { ?>
							
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/myplans'); ?>" class="My Plans tooltip" title="My Plans">
									My Plans
								</a>
							</li>
<?php } ?>							
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/advertiserplans'); ?>" class="Advertiser Plans tooltip" title="Adversiser Purchased Plans">
								Advertiser Purchased Plans
								</a>
							</li>
							
                            <!-- Unsed Icons 
							<li>
								<a href="#" class="Globe tooltip" title="Globe">
									Globe
								</a>
							</li>
							<li>
								<a href="#" class="Books tooltip" title="Books">
									Books
								</a>
							</li>
							<li>
								<a href="#" class="Clipboard_3 tooltip" title="Clipboard_3">
									Clipboard_3
								</a>
							</li>
							<li>
								<a href="#" class="Chart_4 tooltip" title="Chart_4 tooltip">
									Chart_4 tooltip
								</a>
							</li>
							<li>
								<a href="#" class="Briefcase_files tooltip" title="Briefcase_files ">
									Briefcase_files 
								</a>
							</li>
							<li>
								<a href="#" class="Box_recycle tooltip" title="Box Recyle">
									Box Recyle
								</a>
							</li>
							<li>
								<a href="#" class="Book_phones tooltip" title="Book phones">
									Book phones
								</a>
							</li>
							<li>
								<a href="#" class="Books tooltip" title="Books">
									Books
								</a>

							</li>
							<li>
								<a href="#" class="Box_content tooltip" title="Box content">
									Box content
								</a>
							</li>
							<li>
								<a href="#" class="Chart_5 tooltip" title="Chart 5">
									Chart
								</a>
							</li>
							<li>
								<a href="#" class="Glass tooltip" title="Glass">
									Glass
								</a>

							</li>
							<li>
								<a href="#" class="Mail_open tooltip" title="Mail open">
									Mail open
								</a>
							</li>
							<li>
								<a href="#" class="Monitor tooltip" title="Monitor">
									Monitor
								</a>

							</li>
							<li>
								<a href="#" class="Star tooltip" title="Star">
									Star
								</a>
								<div class="clearfix"></div>
							</li> Unused Icons -->
						</ul>

<?php } else if(Yii::app()->user->isAdvertiser()) { // it is advertiser
?>						

						<ul id="dashboard-buttons">
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/myaccount'); ?>" class="EditInfo tooltip" title="My Account">
								My Account
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/listing'); ?>" class="listings tooltip" title="Listings">
								Listings
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/premiumad'); ?>" class="premium-ads tooltip" title="Premium Ad">
								Premium Ad
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/myplans'); ?>" class="My Plans tooltip" title="My Plans">
								My Plans
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/employee'); ?>" class="Employees tooltip" title="Employees">
							Employees
							</a>
						</li>

					</ul>

<?php } else if(Yii::app()->user->isMediabroker()) { // it is media broker
						?>						

					<ul id="dashboard-buttons">
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin'); ?>" class="dashboard tooltip" title="Dashboard">
							Dashboard
							</a>
						</li>			
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/myaccount'); ?>" class="EditInfo tooltip" title="My Account">
							My Account
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/mbcommission'); ?>" class="EditInfo tooltip" title="My Commissions">
							My Commissions
							</a>
						</li>
					</li>
					</ul>
<?php } ?>					
						<div class="clearfix"></div>
					</div>
					
				</div>