<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('mediabroker-commission-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="title title-spacing">
<h3>Media Broker Commissions</h3>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mediabroker-commission-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
				'name' => 'mbroker_id',
				'filter'=>CHtml::listData(Mediabroker::model()->findAll(), 'mbroker_id','p_users.username'),
				'value' => '$data->p_mediabrokers->p_users->first_name.\' \'.$data->p_mediabrokers->p_users->last_name'
		),

		array(
				'name' => 'pppayment_id',
				'filter'=>null,
				'value' => '$data->p_purchased_plans_payments->p_purchased_plans->p_plans->name'
		),
		array(
				'name' => 'date_created',
				'filter'=>null,
		),
		'amount',
		array(
			      'name'=>'status',
			      'filter'=>CHtml::listData(CommissionStatus::findAll(), 'id','name'),
			      'value'=>'$data->getStatus($data->status)',
		  ),
		array(
			      'name'=>'paystatus',
			      'header'=> 'Pay Status',
			      'filter'=>CHtml::listData(CommissionPayStatus::findAll(), 'id','name'),
			      'value'=>'$data->getPayStatus($data->paystatus)',
		  ),
		'date_paid',
		array(
        		'class'=>'CButtonColumn',
    			'template'=>'{update}{delete}',
    			'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
			),
	),
)); ?>

