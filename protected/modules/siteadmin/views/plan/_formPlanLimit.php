<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plan-limit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($modelPlanLimit); ?>

	<div class="row">
		<?php echo $form->labelEx($modelPlanLimit,'limit_amount'); ?>
		<?php echo $form->textField($modelPlanLimit,'limit_amount',array('class'=>"full")); ?>
		<?php echo $form->error($modelPlanLimit,'limit_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelPlanLimit,'resource_type'); ?>
		<?php echo $form->dropDownList($modelPlanLimit, 'resource_type', CHtml::listData(PlanResourceType::findAllByType(PlanType::ADVERTISER_PLAN), 'id', 'name')); ?>
		<?php echo $form->error($modelPlanLimit,'resource_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelPlanLimit,'plan_id'); ?>
		<?php echo $form->dropDownList($modelPlanLimit,'plan_id', CHtml::listData(Plan::model()->findAllByType(PlanType::ADVERTISER_PLAN), 'plan_id', 'name')); ?>		
		<?php echo $form->error($modelPlanLimit,'plan_id'); ?>
	</div>
	


	<div class="row buttons">
		<?php echo CHtml::submitButton($modelPlanLimit->isNewRecord ? 'Add Limit' : 'Save Limit', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->