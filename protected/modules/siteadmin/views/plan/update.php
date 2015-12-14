<?php
$this->breadcrumbs=array(
	'Plans'=>array('index'),
	$model->name=>array('view','id'=>$model->plan_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Plan', 'url'=>array('index')),
	array('label'=>'Create Plan', 'url'=>array('create')),
	array('label'=>'View Plan', 'url'=>array('view', 'id'=>$model->plan_id)),
	array('label'=>'Manage Plan', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">Update Plan <?php echo $model->plan_id; ?></div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>