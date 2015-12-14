
<div class="portlet">
<div class="portlet-header">Create White Label Plan</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>


<div class="title title-spacing">
<h3>Manage White Label Plans</h3>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'plan-grid',
	'dataProvider'=>$model->search(PlanType::WHITELABEL_PLAN),
	'filter'=>null,
	'columns'=>array(
		'name',
		'duration',
		'price',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
		),
	),
)); ?>

<hr>

<div class="portlet">
<div class="portlet-header">Limit White Label Plans</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_formPlanLimit', array('modelPlanLimit'=>$modelPlanLimit)); ?>
</div>
</div>


<div class="title title-spacing">
<h3>Manage White Label Plan Limits</h3>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'plan-limit-grid',
		'dataProvider'=>$modelPlanLimit->search(PlanType::WHITELABEL_PLAN),
		'filter'=>null,
		'columns'=>array(
				array(
		                'name'=>'plan_id',
		                'filter'=>CHtml::listData(Plan::model()->findAllByType(PlanType::ADVERTISER_PLAN), 'plan_id','name'),
		                'value'=>'$data->p_plans->name',
		        ),
				array(
					      'name'=>'resource_type',
					      'filter'=>CHtml::listData(PlanResourceType::findAllByType(PlanType::ADVERTISER_PLAN), 'id','name'),
					      'value'=>'$data->getType($data->resource_type)',
				    ),
				'limit_amount',
			array(
				'class'=>'CButtonColumn',
				'template'=>'{update}{delete}',
	            'buttons'=>array(
	            		'update' => array(
	            				'label'=>'Update',
	            				'url'=>'Yii::app()->createUrl("siteadmin/whitelabelplan/updateLimit", array("id"=>$data->plimit_id))',
	            		),
	            		'delete' => array(
	            				'label'=>'Delete',
	            				'url'=>'Yii::app()->createUrl("siteadmin/whitelabelplan/deleteLimit", array("id"=>$data->plimit_id))',
	            		),
	            ),			
			),
		),
	)); ?>

