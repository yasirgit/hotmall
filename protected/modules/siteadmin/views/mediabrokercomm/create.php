<?php
$this->breadcrumbs=array(
	'Mediabroker Commissions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MediabrokerCommission', 'url'=>array('index')),
	array('label'=>'Manage MediabrokerCommission', 'url'=>array('admin')),
);
?>

<h1>Create MediabrokerCommission</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>