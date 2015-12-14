<?php
$this->breadcrumbs=array(
	'Mediabroker Commissions'=>array('index'),
	$model->mbcommission_id=>array('view','id'=>$model->mbcommission_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MediabrokerCommission', 'url'=>array('index')),
	array('label'=>'Create MediabrokerCommission', 'url'=>array('create')),
	array('label'=>'View MediabrokerCommission', 'url'=>array('view', 'id'=>$model->mbcommission_id)),
	array('label'=>'Manage MediabrokerCommission', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">Update MediabrokerCommission <?php echo $model->mbcommission_id; ?></div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>