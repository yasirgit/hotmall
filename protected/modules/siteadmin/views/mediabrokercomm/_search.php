<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'mbcommission_id'); ?>
		<?php echo $form->textField($model,'mbcommission_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mbroker_id'); ?>
		<?php echo $form->textField($model,'mbroker_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pppayment_id'); ?>
		<?php echo $form->textField($model,'pppayment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_paid'); ?>
		<?php echo $form->textField($model,'date_paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paystatus'); ?>
		<?php echo $form->textField($model,'paystatus'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->