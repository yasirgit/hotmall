
<div class="title title-spacing">
<h3>Media Broker Commissions</h3>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mediabroker-commission-grid',
	'dataProvider'=>$model->search(),
	'filter'=>null,
	'columns'=>array(
		array(
				'name' => 'pppayment_id',
				'value' => '$data->p_purchased_plans_payments->p_purchased_plans->p_plans->name'
		),
		'date_created',
		'amount',
		array(
			      'name'=>'status',
			      'value'=>'$data->getStatus($data->status)',
		  ),
		array(
			      'name'=>'paystatus',
			      'header'=> 'Pay Status',
			      'value'=>'$data->getPayStatus($data->paystatus)',
		  ),
		'date_paid',
	),
)); ?>
