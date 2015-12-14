<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">Create Admin</div>

<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
</div>