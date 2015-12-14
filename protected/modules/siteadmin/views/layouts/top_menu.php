		<ul id="navigation" class="sf-navbar">
			<li>
				<a href="<?php echo Yii::app()->createUrl('siteadmin'); ?>">Dashboard</a>
                	<ul>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('siteadmin/default/logout'); ?>">Logout</a>
                        </li>
                    </ul>
			</li>
<?php if(Yii::app()->user->isSuperadmin()) { ?>						

			<li>
				<a href="#">SuperAdmin Categories</a>
				<ul>
                	<li>
						<a href="#">Add/Edit</a>
						<ul>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/whitelabel'); ?>">Manage White Label Accounts</a>
							</li>
                        	<li>
                    			<a href="<?php echo Yii::app()->createUrl('siteadmin/whitelabelplan'); ?>">Manage White Label Plans</a>
                    		</li>
                        	<li>
                        		<a href="<?php echo Yii::app()->createUrl('siteadmin/admin'); ?>">Manage Administrators</a>
                        	</li>
                        	<li>
                    			<a href="<?php echo Yii::app()->createUrl('siteadmin/whitelabelplans'); ?>">White Label Purchased Plans</a>
                    		</li>
						</ul>
					</li>
				</ul>
			</li>
<?php } ?> 

<?php if(Yii::app()->user->isSuperadmin() || Yii::app()->user->isWhiteLabelAdmin()) { ?>				
			
			<li>
				<a href="#">Admin Categories</a>
				<ul>
                	<li>
						<a href="#">Add/Edit</a>
						<ul>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/customer'); ?>">Customers</a>
							</li>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl('siteadmin/advertiser'); ?>">Advertisers</a>
                            </li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/listing'); ?>">Listings</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/category'); ?>">Categories</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/autoresponder'); ?>">Autoresponders</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('siteadmin/location'); ?>">Locations</a>
							</li>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl('siteadmin/premiumad'); ?>">Premium Ad</a>
                            </li>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl('siteadmin/mediabroker'); ?>">Media Brokers</a>
                            </li>
						</ul>
					</li>
					<li>
						<a href="<?php echo Yii::app()->createUrl('siteadmin/settings'); ?>">Settings</a>
                        <ul>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl('siteadmin/plan'); ?>">Plans</a>
                            </li>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl('siteadmin/myaccount'); ?>">My Account</a>
                            </li>
                        </ul>
					</li>
				</ul>
			</li>
<?php } ?>

<?php if(Yii::app()->user->isAdvertiser()) { ?>				

			<li>
				<a href="#">Advertiser Categories</a>
				<ul>
					<li>
					<a href="#">Add/Edit</a>
					<ul>
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/listing'); ?>">Listings</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/premiumad'); ?>">Premium Ad</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/myplans'); ?>">My Plans</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/employee'); ?>">Employees</a>
						</li>
            
					</ul>
					</li>
					<li>
					<a href="<?php echo Yii::app()->createUrl('siteadmin/settings'); ?>">Settings</a>
					<ul>
						<li>
							<a href="<?php echo Yii::app()->createUrl('siteadmin/myaccount'); ?>">My Account</a>
						</li>
					</ul>
					</li>
				</ul>
			</li>
<?php } ?>

<?php if(!Yii::app()->user->isAdvertiser()) { ?>				
            <li>
                    <a href="#">Tools</a>
                    	<ul>
                            <li>
                                <a href="#">Newsletter</a>
                            </li>
                            <li>
                                <a href="#">CSV Import</a>
                            </li>
                        </ul>
                    </li>
<?php } ?>                    
		</ul>