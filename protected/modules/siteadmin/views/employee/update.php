<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->name=>array('view','id'=>$model->employee_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Employee', 'url'=>array('index')),
	array('label'=>'Create Employee', 'url'=>array('create')),
	array('label'=>'View Employee', 'url'=>array('view', 'id'=>$model->employee_id)),
	array('label'=>'Manage Employee', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">Update Employee <?php echo $model->employee_id; ?></div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>