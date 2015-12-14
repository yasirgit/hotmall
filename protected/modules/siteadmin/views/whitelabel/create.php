<?php
$this->breadcrumbs=array(
	'White Labels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WhiteLabel', 'url'=>array('index')),
	array('label'=>'Manage WhiteLabel', 'url'=>array('admin')),
);
?>

<h1>Create WhiteLabel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>