<?php
$this->breadcrumbs=array(
	'Purchased Plans'=>array('index'),
	$model->pplan_id=>array('view','id'=>$model->pplan_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PurchasedPlan', 'url'=>array('index')),
	array('label'=>'Create PurchasedPlan', 'url'=>array('create')),
	array('label'=>'View PurchasedPlan', 'url'=>array('view', 'id'=>$model->pplan_id)),
	array('label'=>'Manage PurchasedPlan', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">Update PurchasedPlan <?php echo $model->pplan_id; ?></div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>