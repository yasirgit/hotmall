<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'newsletter_id'); ?>
		<?php echo $form->textField($model,'newsletter_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recipients'); ?>
		<?php echo $form->textField($model,'recipients',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'scheduled_date'); ?>
		<?php echo $form->textField($model,'scheduled_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'attachment'); ?>
		<?php echo $form->textField($model,'attachment',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->