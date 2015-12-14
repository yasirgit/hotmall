<?php
$this->breadcrumbs=array(
	'Advertisers'=>array('index'),
	$model->advertiser_id,
);

$this->menu=array(
	array('label'=>'List Advertiser', 'url'=>array('index')),
	array('label'=>'Create Advertiser', 'url'=>array('create')),
	array('label'=>'Update Advertiser', 'url'=>array('update', 'id'=>$model->advertiser_id)),
	array('label'=>'Delete Advertiser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->advertiser_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Advertiser', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">View Advertiser #<?php echo $model->advertiser_id; ?></div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'advertiser_id',
		'wlabel_id',
		'username',
		'password',
		'first_name',
		'last_name',
		'email',
		'address',
		'city',
		'state',
		'zip',
		'country',
		'phone',
		'alt_phone',
		'fax',
		'status',
		'plan_id',
		'date_created',
	),
)); ?>

</div>
</div>
