<?php
$this->breadcrumbs=array(
	'Newsletters'=>array('index'),
	$model->newsletter_id=>array('view','id'=>$model->newsletter_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Newsletters', 'url'=>array('index')),
	array('label'=>'Create Newsletters', 'url'=>array('create')),
	array('label'=>'View Newsletters', 'url'=>array('view', 'id'=>$model->newsletter_id)),
	array('label'=>'Manage Newsletters', 'url'=>array('admin')),
);
?>

<h1>Update Newsletters <?php echo $model->newsletter_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>