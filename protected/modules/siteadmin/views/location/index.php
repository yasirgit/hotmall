<?php 
		
$checkFor = PlanResourceType::RTYPE_LOCATIONS_PER_ACCOUNT;
if(PlanRestriction::allowsNew($checkFor)) { ?>
		
<div class="portlet">
<div class="portlet-header">Create Location</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>

<?php } else { ?>

	<?php echo $this->renderPartial('/restriction/restriction', 
							array(	'model'=>$model, 
									'resourceType'=>$checkFor, 
									'resTypeName'=>'locations'
							)); ?>

<?php } ?>



<div class="title title-spacing">
<h3>Existing Locations</h3>
</div>

<?php 

if(Yii::app()->user->isSuperadmin()) { 	
	$columns = array(
				array(
	                'name'=>'wlabel_id',
	                'filter'=>CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id','name'),
	                'value'=>'$data->p_whitelabel->name',
				),
				'name',
				array(
				        'class'=>'CButtonColumn',
						'template'=>'{update}{delete}',
						'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
				),
				);
} else {
	$columns = array(
			'name',
			array(
			        'class'=>'CButtonColumn',
					'template'=>'{update}{delete}',
					'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
			),
			);
}


	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'location-grid',
		'dataProvider'=>$model->with('p_whitelabel')->search(),
		'filter'=>null,
		'columns'=>$columns,
	)); 

?>

