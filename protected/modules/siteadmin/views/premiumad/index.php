<?php 

$checkFor = PlanResourceType::RTYPE_PREMIUMAD_PER_ADVERTISER;
if(!Yii::app()->user->isAdvertiser() || PlanRestriction::allowsNew($checkFor, Yii::app()->user->getAdvertiserId())) { ?>
		
<div class="portlet">
<div class="portlet-header">Create PremiumAd</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>

<?php } else { ?>

	<?php echo $this->renderPartial('/restriction/restriction', 
							array(	'model'=>$model, 
									'resourceType'=>$checkFor, 
									'resTypeName'=>'Premium Ads'
							)); ?>

<?php } ?>



<div class="title title-spacing">
<h3>Manage Premium Ads</h3>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'premium-ad-grid',
	'dataProvider'=>$model->search(),
	'filter'=>null,
	'columns'=>array(
		'headline',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
		),
	),
)); ?>
