<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pplan_id'); ?>
		<?php echo $form->textField($model,'pplan_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wlabel_id'); ?>
		<?php echo $form->textField($model,'wlabel_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plan_id'); ?>
		<?php echo $form->textField($model,'plan_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'advertiser_id'); ?>
		<?php echo $form->textField($model,'advertiser_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'method'); ?>
		<?php echo $form->textField($model,'method'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->