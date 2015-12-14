<?php 

$columns = array();

$columns[] = array(
		'name' => '',
		'value' =>'CHtml::checkBox("cid[]",null,array("value"=>$data->p_users->user_id,"id"=>"cid_".$data->p_users->user_id))',
		'type' =>'raw'
		);	
		
if(Yii::app()->user->isSuperadmin()) { 	
	$columns[] = array(
			'name'=>'wlabel_id',
			'filter'=>CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id','name'),
			'value'=>'$data->p_whitelabel->name',
			);
}

$columns[] = array(
		'name' => 'first_name',
		'header'=> 'First Name',
		'value' => '$data->p_users->first_name'
		);	
$columns[] = array(
		'name' => 'last_name',
		'header'=> 'Last Name',
		'value' => '$data->p_users->last_name'
		);	

$columns[] = array(
		'name' => 'username',
		'value' => '$data->p_users->username'
		);	
		
$columns[] = array(
		'name' => 'phone_number',
		'value' => '$data->p_users->phone'
		);
		
$columns[] = array(
		'name' => 'active',
		'value' => '($data->p_users->status==1)?"Yes":"No"'
		);
		
$columns[] = array(
		'name' => 'promotions_redeemed',
		'value' => ''
		);
$columns[] = array(
		'name' => 'redemption_rate',
		'value' => ''
		);

$columns[] = array(
        		'class'=>'CButtonColumn',
    			'template'=>'{update}{delete}',
    			'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
			);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'advertisera-grid',
	'dataProvider'=>$advertiser->with('p_users')->search(UserStatus::STATUS_APPROVED),
	'filter'=>null,
	'columns'=>$columns,
)); ?>
