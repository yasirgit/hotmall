<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertiser-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($user)); ?>

	<div class="row">
		<?php echo $form->labelEx($user,'username'); ?>
		<?php echo $form->textField($user,'username',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'password'); ?>
		<?php echo $form->passwordField($user,'password',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'confirm_password'); ?>
		<?php echo $form->passwordField($user,'confirm_password',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'confirm_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'first_name'); ?>
		<?php echo $form->textField($user,'first_name',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'last_name'); ?>
		<?php echo $form->textField($user,'last_name',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'email'); ?>
		<?php echo $form->textField($user,'email',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'address'); ?>
		<?php echo $form->textField($user,'address',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($user,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'city'); ?>
		<?php echo $form->textField($user,'city',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($user,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'state'); ?>
		<?php echo $form->textField($user,'state',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'zipcode'); ?>
		<?php echo $form->textField($user,'zipcode',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'zipcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'country'); ?>
		<?php echo $form->textField($user,'country',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'phone'); ?>
		<?php echo $form->textField($user,'phone',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'alt_phone'); ?>
		<?php echo $form->textField($user,'alt_phone',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'alt_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'fax'); ?>
		<?php echo $form->textField($user,'fax',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($user,'fax'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Create'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->