<?php 
$advertisers = Advertiser::model()->getAdvertisers();

if(count($advertisers) > 0) {

?>
	<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchased-plan-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'advertiser_id'); ?>
		<?php echo $form->dropDownList(
				$model,'advertiser_id',
				$advertisers,
				array('' => '')
		); ?>		
		<?php echo $form->error($model,'advertiser_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'plan_id'); ?>
		<?php echo $form->radioButtonList(
			$model,'plan_id',	Plan::model()->findPlansWithText($planType),
			array('' => '')
		); ?>		
		<?php echo $form->error($model,'plan_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Add Plan to Advertiser', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
	</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->
<?php } else { ?>

You need to define some advertisers first!

<?php } ?>