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
		'value' => '$data->p_users->username',
		'header'=> 'Username',
		);		

$columns[] = array(
		'name' => 'date_created',
		'value' => '$data->p_users->date_created',
		'header'=> 'Date Created',
		);		

$columns[] = array(
		'name' => 'Clicks',
		'value' => '$data->clicks'
		);

$columns[] = array(
		'name' => 'Commissions Pending',
		'value' => '$data->comm_pending'
		);		

$columns[] = array(
		'name' => 'Commissions Approved',
		'value' => '$data->comm_approved'
		);		

$columns[] = array(
		'name' => 'Commissions Paid',
		'value' => '$data->comm_paid'
		);		

$columns[] = array(
        		'class'=>'CButtonColumn',
    			'template'=>'{update}{delete}',
    			'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
			);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'advertisera-grid',
	'dataProvider'=>$mediabroker->getApprovedMediabrokersWithStats(),
	'filter'=>null,
	'columns'=>$columns,
)); ?>
