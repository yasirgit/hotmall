<div class="one-column">
	<!-- Form Fields Container Starts -->
	
	<div class="column" id="custom-reports">
		<div class="portlet">

			<div class="portlet-header">Custom Reports</div>
			<div class="portlet-content">
			
				<form action="#" method="post" enctype="multipart/form-data" class="forms" name="form">
					<ul>
						<li>
							<div class="select-menu">
								<label class="desc"> Search: </label>

								<div>
									<input type="text" tabindex="1" maxlength="255" value="" class="field text large" name="" />
									</select>
								</div>
							</div>
							<div class="select-menu" style="visibility:hidden;">
								<label class="desc"> White Label Admin: </label>
								<select tabindex="3" class="field select large report-select" name="" />

									<option value="ALL"> ALL </option>
									<option> Pizza Hut </option>
									<option> Applebees </option>
									<option> North Park Mall </option>
									<option> Rockwall Dentistry </option>

									<option> Pet Doctor </option>
								</select>
							</div>						
							<div class="select-menu">
								<label class="desc"> Start: </label>
								<div>
									<input type="text" tabindex="1" maxlength="255" class="field text large datetimepicker" name="promos-start-date" id="promos-start-date-1" />

								</div>
							</div>
							<div class="select-menu">
								<label class="desc"> End: </label>
								<div>
									<input type="text" tabindex="2" maxlength="255"  class=" field text large datetimepicker" name="promos-end-date" id="promos-end-date-2" />
								</div>
							</div>

						</li>
						<li>

							<div class="select-menu">
								<label class="desc"> Promocast Network: </label>
								<select tabindex="3" class="field select large report-select" name="" />
									<option value="ALL"> ALL </option>

									<option> Network 1 </option>
									<option> Network 2 </option>
									<option> Network 3 </option>
									<option> Network 4 </option>
									<option> Network 5 </option>

								</select>
							</div>
							<div class="select-menu">
								<label class="desc"> Location: </label>
								<select tabindex="3" class="field select large report-select" name="" />
									<option value="ALL"> ALL </option>
																			<option value="" disabled="disabled"  selected="selected">Select Location</option>								</select>

							</div>	
							<div class="select-menu">
								<label class="desc"> Device: </label>
								<select tabindex="3" class="field select large report-select" name="" />
									<option value="ALL"> ALL </option>
									<option> System 1 </option>

									<option> System 2 </option>
									<option> System 3 </option>
									<option> System 4 </option>
									<option> System 5 </option>
								</select>

							</div>
							<div class="select-menu ">
								<label class="desc"> Advertiser: </label>
								<select tabindex="3" class="field select large report-select" name="" />
									<option value="ALL"> ALL </option>
									<option> Pizza Hut </option>

									<option> Applebees </option>
								</select>
							</div>
						</li>
						<li class="buttons">
							<button class="ui-state-default ui-corner-all form-submit" type="submit">Search</button>
						</li>

					</ul>
				</form>
			</div>
		</div>
	</div>
	<!-- Form Fields Container Ends -->
</div>



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



<div class="title title-spacing">
<h3>Custom Reports</h3>
</div>
<div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all reports">
<!-- Tabs Container Starts -->

<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
<li class="ui-state-default ui-corner-top">
	<a href="#tabs-1">Usage</a>
</li>
<li class="ui-state-default ui-corner-top">

	<a href="#tabs-2">Promos</a>
</li>
<li class="ui-state-default ui-corner-top">
	<a href="#tabs-3">Loyalty</a>
</li>
</ul>

<?php echo $this->renderPartial('tabStats', array('report'=>$report)); ?>

<?php echo $this->renderPartial('tabPromos', array('promos'=>$promos, 'qsForm'=>$qsForm)); ?>

<?php echo $this->renderPartial('tabLoyalty', array('report'=>$report)); ?>






