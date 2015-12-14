<div id="tabs-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
<!-- Each Tab Starts -->
	<form action="" method="get">

		<!-- A Form Starts -->
		<div class="hastable">
		<div class="buttons-wrap reports tabs-1">
			<a href="javascript:window.print();" class="btn ui-state-default ui-corner-all">Print </a>
			<a href="CSV/reports-sample.csv" class="btn ui-state-default ui-corner-all export-csv">Export To CSV</a>
			<input type="text" placeholder="Search" />
		</div>
		<br />

		<table width="346" class="sorttable">
				<thead>
					<tr>
						<th width="30%" class="header">Total System Users</th>
						<th width="30%" class="header">Total System Views</th>
						<th width="30%" class="header">Total Listing Views</th>
						</thead>

				<tbody>
				<tr class="even">
					    <td><?php echo $report['total_system_users']; ?></td>
						<td><?php echo $report['total_system_views']; ?></td>
						<td><?php echo $report['total_listing_views']; ?></td>
				</tr>
				</tbody>

			</table>
			<br />
			<table width="346" class="sorttable">
         		<thead>
					<tr>
						<th width="30%" class="header">Avg. Time On System</th>
						<th width="30%" class="header">System Views/Visit</th>
						<th width="30%" class="header">Total Listing Views/Visit</th>

						</thead>
				<tbody>
				<tr class="even">
					    <td><?php echo $report['ave_time_on_system']; ?> s.</td>
						<td><?php echo $report['system_views_per_visit']; ?></td>
						<td><?php echo $report['total_listing_views_per_visit']; ?></td>
				</tr>

				</tbody>
			</table>
			<br />
			<table width="346" class="sorttable">
         		<thead>
					<tr>
						<th width="30%" class="header">Avg. Time On Categories</th>
						<th width="30%" class="header">Total Category Views</th>
						<th width="30%" class="header">Total Promotion Views</th>
						</thead>
				<tbody>
				<tr class="even">
					    <td><?php echo $report['ave_time_on_categories']; ?></td>
						<td><?php echo $report['total_category_views']; ?></td>
						<td><?php echo $report['total_promotion_views']; ?></td>

				</tr>
				</tbody>
			</table>
			<br />
			<table width="346" class="sorttable">
         		<thead>
					<tr>
						<th width="30%" class="header">Avg. Time On Sub-Categories</th>
						<th width="30%" class="header">Total Category Views/Visit</th>
						<th width="30%" class="header">Total Promotion Views/Visit</th>
						</thead>
				<tbody>
				<tr class="even">
					    <td><?php echo $report['ave_time_on_subcategories']; ?></td>
						<td><?php echo $report['total_category_views_per_visit']; ?></td>
						<td><?php echo $report['total_promotion_views_per_visit']; ?></td>
				</tr>
				</tbody>
			</table>
			<br />
			<table width="346" class="sorttable">
         		<thead>
					<tr>

						<th width="30%" class="header">Avg. Time On Listings</th>
						<th width="30%" class="header">Total Sub-Category Views</th>
						<th width="30%" class="header">Total Promotions Redeemed</th>
						</thead>
				<tbody>
				<tr class="even">
					    <td><?php echo $report['ave_time_on_listings']; ?></td>
						<td><?php echo $report['total_subcategory_views']; ?></td>
						<td><?php echo $report['total_promotions_redeemed']; ?></td>
				</tr>
				</tbody>
			</table>
			<br />
			<table width="346" class="sorttable">
         		<thead>
					<tr>

						<th width="30%" class="header">Avg. Time On Promotions</th>
						<th width="30%" class="header">Total Sub-Category Views</th>
						<th width="30%" class="header">Redemption Rate</th>
						</thead>
				<tbody>
				<tr class="even">
					    <td><?php echo $report['ave_time_on_promotions']; ?></td>
						<td><?php echo $report['total_subcategory_views']; ?></td>
						<td><?php echo $report['redemption_rate']; ?> %</td>
				</tr>
				</tbody>
			</table>
<?php
	// views per visit
	$viewsPerData = $report['system_views_per_visit'].','.$report['total_category_views_per_visit'].','.$report['total_subcategory_views_per_visit'].','.$report['total_listing_views_per_visit'].','.$report['total_promotion_views_per_visit'];		
	$viewsPerDataMax = max($report['system_views_per_visit'],$report['total_category_views_per_visit'],$report['total_subcategory_views_per_visit'],$report['total_listing_views_per_visit'],$report['total_promotion_views_per_visit']);
	$viewsPerDataMax = round($viewsPerDataMax*1.3)
?>
			
			<img src="http://chart.apis.google.com/chart?chxl=1:|Targeted|Specific|General|2:|Promotions|Listings|Sub+Categories|Categories|Views&chxp=1,10,50.83,90&chxr=0,0,<?php echo $viewsPerDataMax; ?>&chxt=x,r,y&chbh=23,3&chs=480x240&cht=bhg&chco=76A4FB&chds=-10,100&chd=t:<?php echo $viewsPerData; ?>&chg=20,50&chtt=Per+Visit&chts=FF0000,18" width="480" height="240" alt="Per Visit" />

<?php
	// views
	$viewsData = $report['total_system_views'].','.$report['total_category_views'].','.$report['total_subcategory_views'].','.$report['total_listing_views'].','.$report['total_promotion_views'];		
	$viewsDataMax = max($report['total_system_views'],$report['total_category_views'],$report['total_subcategory_views_per_visit'],$report['total_listing_views'],$report['total_promotion_views']);
	$viewsDataMax = round($viewsDataMax*1.3)
?>
			
			<img src="http://chart.apis.google.com/chart?chxl=1:|Targeted|Specific|General|2:|Promotions|Listings|Sub+Categories|Categories|Views&chxp=1,10,50.83,90&chxr=0,0,1500|1,0,95|2,0,110&chxt=x,r,y&chbh=23,3&chs=500x240&cht=bhg&chco=76A4FB&chds=-10,1285&chd=t:<?php echo $viewsData; ?>&chg=20,50&chtt=Views&chts=FF0000,18" width="500" height="240" alt="Views" />

<?php
	// redemption rate
	$rrData = $report['redemption_rate'];
?>

		<img src="http://chart.apis.google.com/chart?chxl=0:|Need+Help|Good|Great|Super&chxt=y&chs=480x240&cht=gm&chds=10,100&chd=t:<?php echo $rrData; ?>&chl=<?php echo $rrData; ?>%25&chtt=Redemption+Rate&chts=FF0000,18" alt="Redemption Rate" />

			<img src="http://chart.apis.google.com/chart?chxl=0:|System+Downloads|Unique+Users&chxr=0,-5,100|1,-5,100&chxt=y,x&chs=480x120&cht=bhg&chco=76A4FB&chds=0,95&chd=t:50,30&chg=20,45&chma=0,0,49&chtt=Users+and+Downloads&chts=FF0000,18" alt="Users and Downloads" />

		</div>
		<!-- A Form Ends -->
	</form>

	<!-- Each Tab Ends -->
</div>