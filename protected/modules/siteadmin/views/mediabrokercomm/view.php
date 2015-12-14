<?php
$this->breadcrumbs=array(
	'Mediabroker Commissions'=>array('index'),
	$model->mbcommission_id,
);

$this->menu=array(
	array('label'=>'List MediabrokerCommission', 'url'=>array('index')),
	array('label'=>'Create MediabrokerCommission', 'url'=>array('create')),
	array('label'=>'Update MediabrokerCommission', 'url'=>array('update', 'id'=>$model->mbcommission_id)),
	array('label'=>'Delete MediabrokerCommission', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mbcommission_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MediabrokerCommission', 'url'=>array('admin')),
);
?>

<h1>View MediabrokerCommission #<?php echo $model->mbcommission_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mbcommission_id',
		'mbroker_id',
		'pppayment_id',
		'date_created',
		'amount',
		'date_paid',
		'status',
		'paystatus',
	),
)); ?>
