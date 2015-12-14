<?php
$this->breadcrumbs=array(
	'Listings'=>array('index'),
	$model->listing_id=>array('view','id'=>$model->listing_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Listing', 'url'=>array('index')),
	array('label'=>'Create Listing', 'url'=>array('create')),
	array('label'=>'View Listing', 'url'=>array('view', 'id'=>$model->listing_id)),
	array('label'=>'Manage Listing', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">Update Listing <?php echo $model->listing_id; ?></div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model, 'coupons'=>$coupons)); ?>
</div>
</div>