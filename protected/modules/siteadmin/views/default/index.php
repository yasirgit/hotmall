<div class="page-title ui-widget-content ui-corner-all">
	<!-- Quick Stats Area Starts -->
	<h1>Network Quick Stats</h1>
	<span class="from-to">
	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'QuickStatsForm',
			'enableClientValidation'=>true,
		)); ?>

		From <?php echo $form->textField($qsForm,'dateFrom',array('maxlength'=>255, 'class'=>"datetimepicker")); ?>
		To <?php echo $form->textField($qsForm,'dateTo',array('maxlength'=>50, 'class'=>"datetimepicker")); ?>

		<?php echo CHtml::submitButton('Refresh'); ?>

	<?php $this->endWidget(); ?>
	</span>
	<div class="other">
		<div class="hastable">
			<!-- Quick Stats Table Starts -->
			
			<table class="quickstats">
				<thead>
					<tr>
						<th class="header" colspan="3">Quick Stats</th>
					</tr>
				</thead>
				<tbody>
					<tr class="even">
						<td>Total System Users: <?php echo $quickStats['total_system_users']; ?></td>
						<td>Total System Views: <?php echo $quickStats['total_system_views']; ?></td>
						<td>Total Listing Views: <?php echo $quickStats['total_listing_views']; ?></td>
					</tr>
					<tr class="odd">
						<td>Avg. Time On System: <?php echo $quickStats['ave_time_on_system']; ?> s.</td>
						<td>System Views/Visit: <?php echo $quickStats['system_views_per_visit']; ?></td>
						<td>Total Listing Views/Visit:: <?php echo $quickStats['total_listing_views_per_visit']; ?></td>
					</tr>
					<tr class="even">
						<td>Avg. Time On Categories: <?php echo $quickStats['ave_time_on_categories']; ?> s.</td>
						<td>Total Category Views: <?php echo $quickStats['total_category_views']; ?></td>
						<td>Total Promotion Views: <?php echo $quickStats['total_promotion_views']; ?></td>
					</tr>
					<tr class="odd">
						<td>Avg. Time On Sub-Categories: <?php echo $quickStats['ave_time_on_subcategories']; ?> s.</td>
						<td>Total Category Views/Visit: <?php echo $quickStats['total_category_views_per_visit']; ?></td>
						<td>Total Promotion Views/Visit: <?php echo $quickStats['total_promotion_views_per_visit']; ?></td>
					</tr>
					<tr class="even">
						<td>Avg. Time On Listings: <?php echo $quickStats['ave_time_on_listings']; ?> s.</td>
						<td>Total Sub-Category Views: <?php echo $quickStats['total_subcategory_views']; ?></td>
						<td>Total Promotions Redeemed: <?php echo $quickStats['total_promotions_redeemed']; ?></td>
					</tr>
					<tr class="odd">
						<td>Avg. Time On Promotions: <?php echo $quickStats['ave_time_on_promotions']; ?> s.</td>
						<td>Total Sub-Category Views: <?php echo $quickStats['total_subcategory_views']; ?></td>
						<td>Redemption Rate: <?php echo $quickStats['redemption_rate']; ?> %</td>
					</tr>
				</tbody>
			</table>
			
			<!-- Quick Stats Table Ends -->
		</div>
		<div class="clearfix"></div>
	</div>
	
	<!-- Quick Stats Area Ends -->
</div>




<div class="two-column">
<!-- Two Column Starts -->


<div class="column">
	<!-- Each Column Starts -->
	<div class="portlet form-bg">
		<div class="portlet-header">Send Message</div>

		<div class="portlet-content">
			<div id="tabs">
				<!-- Tabs Starts -->

				<ul>
					<li>
						<a href="#tabs-1">Contact Administrator</a>
					</li>
					<li>
						<a href="#tabs-2">Contact Advertiser</a>
					</li>
					<li>

						<a href="#tabs-3">Contact Customer</a>
					</li>
				</ul>
				<div id="tabs-1">
					<div class="clearfix"></div>
					<h3>Contact Administrator</h3>
					<!-- Contact Form Starts -->
					<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'ContactForm',
							'enableClientValidation'=>true,
						)); ?>
						<ul>
							<li>

								<label class="desc"> Name: </label>
								<div>
								<?php echo $form->textField($cForm,'name',array('class'=>"field text full")); ?>
								<?php echo $form->error($cForm,'name'); ?>
									<label>Please Enter Your Name</label>
								</div>
							</li>

							<li>
								<label class="desc"> Email: </label>
								<div>
								<?php echo $form->textField($cForm,'email',array('class'=>"field text full")); ?>
								<?php echo $form->error($cForm,'email'); ?>
									<label>Please Enter Your Email Address</label>
								</div>
							</li>

							<li>
								<label class="desc"> Message: </label>
								<div>
									<?php echo $form->textArea($cForm,'body',array('rows'=>5, 'cols'=>50, 'class'=>"field textarea full")); ?>
									<label>Please Enter Your Message Or Questions</label>
								</div>
							</li>

							<li class="buttons">
								<button type="submit" value="Submit" class="ui-state-default ui-corner-all" id="advertiser">Send</button>
							</li>
						</ul>
						<input type="hidden" name="SiteadminContactForm[forwhom]" value="administrator">
					<?php $this->endWidget(); ?>
				</div>
				<div id="tabs-2">
					<h3>Contact Advertiser</h3>					
					<form action="#" method="post" enctype="multipart/form-data" class="forms" name="form" >

						<ul>
							<li>
								<label class="desc"> Name: </label>
								<div>
									<input type="text" tabindex="1" maxlength="255" value="" class="field text full" name="" />
									<!-- <span class="red">Error message example ...</span> -->
									<label>Please Enter Your Name</label>

								</div>
							</li>
							<li>
								<label class="desc"> Email: </label>
								<div>
									<input type="text" tabindex="1" maxlength="255" value="" class="field text full" name="" />
									<label>Please Enter Your Email Address</label>

								</div>
							</li>
							<li>
								<label class="desc"> Message: </label>
								<div>
									<textarea tabindex="2" cols="50" rows="5" class="field textarea full" name="" ></textarea>
									<label>Please Enter Your Message Or Questions</label>

								</div>
							</li>
							<li class="buttons">
								<button type="submit" value="Submit" class="ui-state-default ui-corner-all" id="saveForm-2">Send</button>
							</li>
						</ul>
					</form>
				</div>

				<div id="tabs-3">
					<h3>Contact Customer</h3>					
					<form action="#" method="post" enctype="multipart/form-data" class="forms" name="form" >
						<ul>
							<li>
								<label class="desc"> Name: </label>
								<div>
									<input type="text" tabindex="1" maxlength="255" value="" class="field text full" name="" />

									<!-- <span class="red">Error message example ...</span> -->
									<label>Please Enter Your Name</label>
								</div>
							</li>
							<li>
								<label class="desc"> Email: </label>
								<div>

									<input type="text" tabindex="1" maxlength="255" value="" class="field text full" name="" />
									<label>Please Enter Your Email Address</label>
								</div>
							</li>
							<li>
								<label class="desc"> Message: </label>
								<div>

									<textarea tabindex="2" cols="50" rows="5" class="field textarea full" name="" ></textarea>
									<label>Please Enter Your Message Or Questions</label>
								</div>
							</li>
							<li class="buttons">
								<?php echo CHtml::submitButton('Send'); ?>
							</li>

						</ul>
					</form>
				</div>
				<!-- Tabs Ends -->
			</div>			
			<!-- <div class="linetop clearfix"></div> -->
			

		</div>
	<!-- Contact Form Ends -->
	</div>

	<!-- Each Column Ends -->
</div>

</div>