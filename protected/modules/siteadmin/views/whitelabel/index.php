<div class="portlet">
<div class="portlet-header">Create Whitelabel Account</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
</div>


<div class="title title-spacing">
<h3>Manage White Label Accounts</h3>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'white-label-grid',
	'dataProvider'=>$model->search(),
	'filter'=>null,
	'columns'=>array(
		'wlabel_id',
		'name',
		'domain',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
		),
	),
)); ?>

