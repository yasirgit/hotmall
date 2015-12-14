<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'autoresponder-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

<?php foreach($autoresponders->items as $id=>$aModel) { ?> 
	<div class="row">
		<?php echo $form->labelEx($aModel,'subject', array('label'=> 'Message Subject '.$id)); ?>
		<?php echo $form->textField($aModel,"[$id]subject",array('size'=>60,'maxlength'=>250, 'class'=>"full")); ?>
		<?php echo $form->error($aModel,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($aModel,'message', array('label'=> 'Message '.$id)); ?>
		<?php echo $form->textArea($aModel,"[$id]message",array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
		<?php echo $form->error($aModel,'message'); ?>
	</div>

	<input type="hidden" name="<?php echo "[$id]"; ?>type" value="<?php echo $aModel->type; ?>">
	<hr/>
<?php } ?>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Save', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->