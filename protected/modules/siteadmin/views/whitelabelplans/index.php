
<div class="portlet">
<div class="portlet-header">Purchase a New Plan</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model, 'planType'=>$planType)); ?>
</div>
</div>


<div class="title title-spacing">
<h3>Plans Purchased By White Labels</h3>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchased-plan-grid',
	'dataProvider'=>$model->with('p_plans')->search($planType),
	'filter'=>null,
	'columns'=>array(
        array(
                'name'=>'wlabel_id',
                'value'=>'$data->p_whitelabel->name',
            ),
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
