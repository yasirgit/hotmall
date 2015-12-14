
<div class="portlet">
<div class="portlet-header">Create Advertiser</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('user'=>$user,'advertiser'=>$advertiser,)); ?>
</div>
</div>


<div class="title title-spacing">
<h3>Manage Advertisers </h3>
</div>

<div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
<!-- Tabs Container Starts -->

<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
	<li class="ui-state-default ui-corner-top">
		<a href="#tabs-1">Active</a>
	</li>
	<li class="ui-corner-top ui-state-default">
		<a href="#tabs-2">Pending</a>
	</li>
</ul>
<div id="tabs-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
	<div class="hastable">
	<!-- Each Table Starts -->
	<?php echo $this->renderPartial('_listApproved', array('user'=>$user,'advertiser'=>$advertiser,)); ?>
	<!-- Each Table Ends -->
	</div>
	<?php echo $this->renderPartial('_pagination', array('pager_id'=>'approved')); ?>
	<?php echo $this->renderPartial('_selectStatus'); ?> 
</div>
<div id="tabs-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
	<div class="hastable">
		<!-- Each Table Starts -->
		<?php echo $this->renderPartial('_listPending', array('user'=>$user,'advertiser'=>$advertiser,)); ?>
		<!-- Each Table Ends -->
	</div>
	<?php echo $this->renderPartial('_pagination', array('pager_id'=>'pending')); ?>	
</div>

<!-- Tabs Container Ends -->
</div>