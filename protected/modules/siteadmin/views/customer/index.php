
<div class="portlet">
<div class="portlet-header">Create Customer</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>


<div class="title title-spacing">
<h3>Manage Customers</h3>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>null,
	'columns'=>array(
		'first_name',
		'last_name',
		'email',
		'mobile',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
		),
	),
)); ?>
