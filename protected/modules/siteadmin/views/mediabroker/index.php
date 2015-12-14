
<div class="portlet">
<div class="portlet-header">Create MediaBroker</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('user'=>$user,'mediabroker'=>$mediabroker,)); ?>
</div>
</div>


<div class="title title-spacing">
<h3>Manage Media Brokers</h3>
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
	<?php echo $this->renderPartial('_listApproved', array('user'=>$user,'mediabroker'=>$mediabroker,)); ?>
	<!-- Each Table Ends -->
	</div>
</div>
<div id="tabs-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
	<div class="hastable">
		<!-- Each Table Starts -->
		<?php echo $this->renderPartial('_listPending', array('user'=>$user,'mediabroker'=>$mediabroker,)); ?>
		<!-- Each Table Ends -->
	</div>
</div>
</div>
