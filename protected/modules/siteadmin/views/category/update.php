<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->category_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'View Category', 'url'=>array('view', 'id'=>$model->category_id)),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">Update Category <?php echo $model->category_id; ?></div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>