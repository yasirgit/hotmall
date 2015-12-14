<?php 

$columns = array();
if(Yii::app()->user->isSuperadmin()) { 	
	$columns[] = array(
			'name'=>'wlabel_id',
			'header'=> 'White Label',
			'filter'=>CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id','name'),
			'value'=>'$data->p_whitelabel->name',
			);
}
$columns[] = array(
		'name' => 'mbroker_id',
		'header'=> 'ID',
		);	
$columns[] = array(
		'name' => 'first_name',
		'header'=> 'Name',
		'value' => '$data->p_users->first_name." ".$data->p_users->last_name'
		);		

$columns[] = array(
		'name' => 'username',
		'value' => '$data->p_users->username'
		);		

$columns[] = array(
		'name' => 'date_created',
		'value' => '$data->p_users->date_created'
		);		

$columns[] = array(
        		'class'=>'CButtonColumn',
    			'template'=>'{update}{delete}',
    			'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
			);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'advertiserp-grid',
	'dataProvider'=>$mediabroker->with('p_users')->search(UserStatus::STATUS_PENDING),
	'filter'=>null,
	'columns'=>$columns,
)); ?>
