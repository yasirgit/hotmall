<?php 
	
$checkFor = PlanResourceType::RTYPE_LISTINGS_PER_ADVERTISER;
if(PlanRestriction::allowsNew($checkFor, Yii::app()->user->getAdvertiserId())) { ?>
		
<div class="portlet">
<div class="portlet-header">Create Listing</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model, 'coupons'=>$coupons)); ?>
</div>
</div>

<?php } else { ?>

	<?php echo $this->renderPartial('/restriction/restriction', 
							array(	'model'=>$model, 
									'resourceType'=>$checkFor, 
									'resTypeName'=>'listings'
							)); ?>

<?php } ?>

<div class="title title-spacing">
<h3>Manage Listings</h3>
</div>


<?php 

$columns = array();
if(Yii::app()->user->isSuperadmin()) { 	
	$columns[] = array(
			'name'=>'wlabel_id',
			'filter'=>CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id','name'),
			'value'=>'$data->p_whitelabel->name',
			);
}

$columns[] = 'name';
$columns[] = array(
	      'name'=>'type',
	      'value'=>'$data->getType($data->type)',
  );
$columns[] = array(
		'class'=>'CButtonColumn',
		'template'=>'{update}{delete}',
		'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
		);		
		
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'listing-grid',
	'dataProvider'=>$model->search(),
	'filter'=>null,
	'columns'=>$columns,
)); ?>
