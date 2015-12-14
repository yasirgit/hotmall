<div class="portlet">
<div class="portlet-header">Create Newsletter</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>
<div class="title title-spacing">
	<h3>Scheduled Newsletters</h3>
</div>
<div class="buttons-wrap reports tabs-1">
							<a href="javascript:window.print();" class="btn ui-state-default ui-corner-all">Print </a>
							<a href="CSV/reports-sample.csv" class="btn ui-state-default ui-corner-all export-csv-1">Export To CSV</a>
							<input type="text" placeholder="Search">
						</div>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'subject',          // display the 'title' attribute
        'message',  // display the 'name' attribute of the 'category' relation
        array(            // display 'create_time' using an expression
            'name'=>'scheduled_date',
            'value'=>'$data->scheduled_date',
        ),
        
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
        ),
    ),
));
?>