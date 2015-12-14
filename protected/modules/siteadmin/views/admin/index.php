<div class="portlet">
<div class="portlet-header">Create Admin</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
</div>

<div class="title title-spacing">
<h3>Manage SuperAdmins and White Label Admins</h3>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->with('p_whitelabel')->searchAdmins(),
	'filter'=>null,
	'columns'=>array(
		'user_id',
		array(
                'name'=>'wlabel_id',
                'filter'=>CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id','name'),
                'value'=>'$data->p_whitelabel->name',
        ),
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
		/*
		'date_created',
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

