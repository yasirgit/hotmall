<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'newsletters-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'recipients'); ?>
		<?php echo $form->dropDownList($model, 'recipients', array('Advertisers'=>'Advertisers','Media Brokers'=>'Media Brokers')) ?>
		<?php echo $form->error($model,'recipients'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>100 ,'class'=>'field text full')); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50, 'class'=>'field textarea full markItUpEditor')); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'scheduled_date'); ?>
		<?php echo $form->textField($model,'scheduled_date', array('class'=>'field text full datetimepicker hasDatepicker')); ?>
		<?php echo $form->error($model,'scheduled_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'attachment'); ?>
		<?php echo $form->fileField($model,'attachment',array('size'=>60,'maxlength'=>200,'class'=>'medium')); ?>
		<?php echo $form->error($model,'attachment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'ui-state-default ui-corner-all form-submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->