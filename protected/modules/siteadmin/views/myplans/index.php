
<div class="portlet">
<div class="portlet-header">Purchase Plan</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_formPurchase', array('model'=>$model, 'planType'=>$planType)); ?>
</div>
</div>


<div class="title title-spacing">
<h3>Your Purchased Plans</h3>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchased-plan-grid',
	'dataProvider'=>$model->with('p_plans')->search($planType),
	'filter'=>null,
	'columns'=>array(
        array(
            'name'=>'plan',
            'value'=>'$data->p_plans->name',
        ),
		'date_created',
		/*
		'method',
		'price',
		*/
		array(
			'class'=>'CButtonColumn',
		    'template'=>'{view}',	
		),
	),
)); ?>
