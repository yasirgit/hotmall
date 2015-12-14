<?php
$this->breadcrumbs=array(
	'Newsletters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Newsletters', 'url'=>array('index')),
	array('label'=>'Manage Newsletters', 'url'=>array('admin')),
);
?>

<h1>Create Newsletters</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>