<?php
$this->breadcrumbs=array(
	'Listings'=>array('index'),
	$model->listing_id,
);

$this->menu=array(
	array('label'=>'List Listing', 'url'=>array('index')),
	array('label'=>'Create Listing', 'url'=>array('create')),
	array('label'=>'Update Listing', 'url'=>array('update', 'id'=>$model->listing_id)),
	array('label'=>'Delete Listing', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->listing_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Listing', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">View Listing #<?php echo $model->listing_id; ?></div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'listing_id',
		'wlabel_id',
		'advertiser_id',
		'url_domain',
		'business_name',
		'street_address',
		'city',
		'state',
		'zip',
		'phone',
		'description',
		'logo',
		'type',
		'date_created',
	),
)); ?>

</div>
</div>
