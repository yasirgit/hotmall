<?php
$affLink = 'http://'.$wlAccount->domain.'?pc='.$mediaBroker->promocode;
?>
<div class="page-title ui-widget-content ui-corner-all">
	<!-- Quick Stats Area Starts -->
	<h1>Your promotional link</h1>
	<div class="other">

		<h1><a style="text-decoration: underline; color: blue;" href="<?php echo $affLink; ?>" target="_blank"><?php echo $affLink; ?></a></h1>
		<div class="clearfix"></div>
	</div>
	
	<!-- Quick Stats Area Ends -->
</div>

<div class="page-title ui-widget-content ui-corner-all">
<!-- Quick Stats Area Starts -->
<h1>Quick Stats</h1>
<div class="other">
  <table class="statsgrid" border="1" width="100%">
  <tr>
    <td>Clicks This Month</td>
    <td>Commissions Pending Approval</td>
    <td>Approved Commissions</td>
    <td>Total Paid Commissions</td>
  </tr>
  <tr>
    <td><?php echo $data[$mbrokerId]['clicks']; ?></td>
    <td>$ <?php echo $data[$mbrokerId]['comm_pending']; ?></td>
    <td>$ <?php echo $data[$mbrokerId]['comm_approved']; ?></td>
    <td>$ <?php echo $data[$mbrokerId]['comm_paid']; ?></td>
  </tr>
  </table>
  <div class="clearfix"></div>
</div>

<!-- Quick Stats Area Ends -->
</div>

<div class="page-title ui-widget-content ui-corner-all">
<div class="title title-spacing">
<h3>Latest Clicks</h3>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mediabroker-click-grid',
	'dataProvider'=>$model->search(),
	'filter'=>null,
	'columns'=>array(
		'date_created',
		'url',
		'referer',
	),
)); ?>
</div>
