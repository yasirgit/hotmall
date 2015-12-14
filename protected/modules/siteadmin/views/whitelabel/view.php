<?php
$this->breadcrumbs=array(
	'White Labels'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List WhiteLabel', 'url'=>array('index')),
	array('label'=>'Create WhiteLabel', 'url'=>array('create')),
	array('label'=>'Update WhiteLabel', 'url'=>array('update', 'id'=>$model->wlabel_id)),
	array('label'=>'Delete WhiteLabel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->wlabel_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WhiteLabel', 'url'=>array('admin')),
);
?>

<h1>View WhiteLabel #<?php echo $model->wlabel_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'wlabel_id',
		'name',
	),
)); ?>
