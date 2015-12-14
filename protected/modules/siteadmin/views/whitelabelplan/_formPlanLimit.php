<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plan-limit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($modelPlanLimit); ?>

	<div class="row">
		<?php echo $form->labelEx($modelPlanLimit,'plan_id'); ?>
		<?php echo $form->dropDownList(
				$modelPlanLimit,'plan_id', CHtml::listData(Plan::model()->findAllByType(PlanType::WHITELABEL_PLAN), 'plan_id', 'name'), array('' => '')
				); ?>		
		<?php echo $form->error($modelPlanLimit,'plan_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($modelPlanLimit,'resource_type'); ?>
		<?php echo $form->dropDownList($modelPlanLimit, 'resource_type', CHtml::listData(PlanResourceType::findAllByType(PlanType::WHITELABEL_PLAN), 'id', 'name')); ?>
		<?php echo $form->error($modelPlanLimit,'resource_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelPlanLimit,'limit_amount'); ?>
		<?php echo $form->textField($modelPlanLimit,'limit_amount'); ?>
		<?php echo $form->error($modelPlanLimit,'limit_amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($modelPlanLimit->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->