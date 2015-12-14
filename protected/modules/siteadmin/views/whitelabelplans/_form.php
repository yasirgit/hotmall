<?php 
$wlabels = WhiteLabel::model()->findRealAccounts();

if(count($wlabels) > 0) {

?>
	<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchased-plan-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'wlabel_id'); ?>
		<?php echo $form->dropDownList(
				$model,'wlabel_id',
				$wlabels,
				array('' => '')
		); ?>		
		<?php echo $form->error($model,'wlabel_id'); ?>
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
		<?php echo CHtml::submitButton('Add Plan to White Label', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
	</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->
<?php } else { ?>

You need to define some White Label accounts first!

<?php } ?>