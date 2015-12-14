<?php
$this->breadcrumbs=array(
	'Premium Ads'=>array('index'),
	$model->premiumad_id,
);

$this->menu=array(
	array('label'=>'List PremiumAd', 'url'=>array('index')),
	array('label'=>'Create PremiumAd', 'url'=>array('create')),
	array('label'=>'Update PremiumAd', 'url'=>array('update', 'id'=>$model->premiumad_id)),
	array('label'=>'Delete PremiumAd', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->premiumad_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PremiumAd', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">View PremiumAd #<?php echo $model->premiumad_id; ?></div>
<div class="portlet-content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'premiumad_id',
		'wlabel_id',
		'headline',
		'description',
		'image',
		'link_text',
		'link_url',
		'position',
		'display_type',
		'show_on_static',
	),
)); ?>

</div>
</div>
