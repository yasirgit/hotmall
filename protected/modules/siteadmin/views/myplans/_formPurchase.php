<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchased-plan-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'plan_id'); ?>
		<?php echo $form->radioButtonList(
			$model,'plan_id',	Plan::model()->findPlansWithText($planType),
			array('' => '')
		); ?>		
		<?php echo $form->error($model,'plan_id'); ?>
	</div>

	<input type="hidden" name="PurchasedPlan[realPayment]" value="1">

	<div class="row buttons">
		<?php echo CHtml::submitButton('Purchase', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

