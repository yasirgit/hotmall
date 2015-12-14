<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">View Admin #<?php echo $model->user_id; ?></div>

<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'wlabel_id',
		'username',
		'password',
		'type',
		'status',
		'date_created',
		'date_lastlogin',
		'first_name',
		'last_name',
		'address',
		'city',
		'state',
		'zipcode',
		'country',
		'phone',
		'alt_phone',
		'fax',
		'email',
	),
)); ?>

</div>
</div>
