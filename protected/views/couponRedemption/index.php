
<div class="portlet">
<div class="portlet-header">Create CouponRedemption</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>


<div class="title title-spacing">
<h3>Manage Coupon Redemptions</h3>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'coupon-redemption-grid',
	'dataProvider'=>$model->search(),
	'filter'=>null,
	'columns'=>array(
		'credemption_id',
		'coupon_id',
		'employee_id',
		'customer_id',
		'phone',
		'date_created',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
