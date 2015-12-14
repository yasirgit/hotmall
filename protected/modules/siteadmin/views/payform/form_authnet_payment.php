<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'authorizenet-payment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>100, 'class'=>"full")); ?>
		<?php echo $form->error($model,'firstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastName'); ?>
		<?php echo $form->textField($model,'lastName',array('size'=>60,'maxlength'=>100, 'class'=>"full")); ?>
		<?php echo $form->error($model,'lastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cardNumber'); ?>
		<?php echo $form->textField($model,'cardNumber',array('size'=>60,'maxlength'=>16, 'class'=>"full")); ?>
		<?php echo $form->error($model,'cardNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expirationDate'); ?>
		<?php echo $form->textField($model,'expirationDate',array('size'=>60,'maxlength'=>7, 'class'=>"full")); ?>
		<?php echo $form->error($model,'expirationDate'); ?>
		<p>in format YYYY-MM</p>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Process Payment', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->