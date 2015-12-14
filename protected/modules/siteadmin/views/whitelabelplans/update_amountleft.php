<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plan-limit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'limit_amount'); ?>
		<?php echo $form->textField($model,'limit_amount',array('class'=>"full")); ?>
		<?php echo $form->error($model,'limit_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount_left'); ?>
		<?php echo $form->textField($model,'amount_left',array('class'=>"full")); ?>
		<?php echo $form->error($model,'amount_left'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Update Amount Left', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->