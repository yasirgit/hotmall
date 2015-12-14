<div class="portlet">
<div class="portlet-header">View Purchased Plan #<?php echo $model->pplan_id; ?></div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
			'p_advertisers.p_users.first_name',
			'p_advertisers.p_users.last_name',
			'p_plans.name',
    		'date_created',
    		'p_plans.duration',
    		'method',
    		'price',
	),
)); ?>

<br/><br/>
<div class="title title-spacing">
<h3>Plan Limitations</h3>
</div>

<?php 
	if($modelLimits != null) { 
		
		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'purchased-plan-limit-grid',
		'dataProvider'=>$modelLimits->getLimits($model->plan_id),
		'filter'=>null,
		'enableSorting'=>false,
		'columns'=>array(
			array(
			      'name'=>'resource_type',
			      'filter'=>CHtml::listData(PlanResourceType::findAllByType(PlanType::ADVERTISER_PLAN), 'id','name'),
				  'value'=>'$data->getType($data->resource_type)',
			   ),
			'limit_amount',
			array(
				'class'=>'CButtonColumn',
			    'template'=>'',	
			),
		),
	)); 
		
	} else {
		echo "No limitations defined!";
	}
?>


<br/><br/>
<div class="title title-spacing">
<h3>Plan Payments</h3>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'purchased-plan-limit-grid',
		'dataProvider'=>$modelPayments->search($model->pplan_id),
		'filter'=>null,
		'enableSorting'=>false,
		'columns'=>array(
			'date_paid',
			'date_expire',
			'transaction_id',
			array(
				'class'=>'CButtonColumn',
			    'template'=>'',	
			),
		),
	)); ?>


</div>
</div>
