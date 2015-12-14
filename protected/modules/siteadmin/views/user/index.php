<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

?>

<h1>Manage Users</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'user_id',
		'wlabel_id',
		'username',
		array(
      'name'=>'type',
      'filter'=>CHtml::listData(UserType::findAll(), 'id','name'),
      'value'=>'$data->getType($data->type)',
    ),
		array(
      'name'=>'status',
      'filter'=>CHtml::listData(UserStatus::findAll(), 'id','name'),
      'value'=>'$data->getStatus($data->status)',
    ),
		'date_created',
		/*
		'date_lastlogin',
		'first_name',
		'last_name',
		'address',
		'city',
		'state',
		'zipcode',
		'country',
		'phone',
		'alt_phone',
		'fax',
		'email',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
		),
	),
)); ?>
