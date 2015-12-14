<?php
$this->breadcrumbs=array(
	'Premium Ads'=>array('index'),
	$model->premiumad_id=>array('view','id'=>$model->premiumad_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PremiumAd', 'url'=>array('index')),
	array('label'=>'Create PremiumAd', 'url'=>array('create')),
	array('label'=>'View PremiumAd', 'url'=>array('view', 'id'=>$model->premiumad_id)),
	array('label'=>'Manage PremiumAd', 'url'=>array('admin')),
);
?>

<div class="portlet">
<div class="portlet-header">Update PremiumAd <?php echo $model->premiumad_id; ?></div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>