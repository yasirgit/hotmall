<?php
$this->breadcrumbs=array(
	'Newsletters'=>array('index'),
	$model->newsletter_id,
);

$this->menu=array(
	array('label'=>'List Newsletters', 'url'=>array('index')),
	array('label'=>'Create Newsletters', 'url'=>array('create')),
	array('label'=>'Update Newsletters', 'url'=>array('update', 'id'=>$model->newsletter_id)),
	array('label'=>'Delete Newsletters', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->newsletter_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Newsletters', 'url'=>array('admin')),
);
?>

<h1>View Newsletters #<?php echo $model->newsletter_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'newsletter_id',
		'recipients',
		'subject',
		'message',
		'scheduled_date',
		'attachment',
	),
)); ?>
