<?php
$this->breadcrumbs=array(
	'Media Brokers'=>array('index'),
	$model->mbroker_id,
);

$this->menu=array(
	array('label'=>'List MediaBroker', 'url'=>array('index')),
	array('label'=>'Create MediaBroker', 'url'=>array('create')),
	array('label'=>'Update MediaBroker', 'url'=>array('update', 'id'=>$model->mbroker_id)),
	array('label'=>'Delete MediaBroker', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mbroker_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MediaBroker', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">View MediaBroker #<?php echo $model->mbroker_id; ?></div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mbroker_id',
		'wlabel_id',
		'user_id',
		'ref',
		'status',
	),
)); ?>

</div>
</div>
