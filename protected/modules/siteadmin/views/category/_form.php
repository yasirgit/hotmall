<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_category_id'); ?>
		<?php echo $form->dropDownList(
					$model,'parent_category_id',
					Category::model()->findTopCategories(),
					array('' => '')
		); ?>	
		<?php echo $form->error($model,'parent_category_id'); ?>
	</div>

<?php if(Yii::app()->user->isSuperadmin()) { ?>		
	<div class="row">
		<?php echo $form->labelEx($model,'wlabel_id'); ?>
		<?php echo $form->dropDownList(
				$model,'wlabel_id',
				WhiteLabel::model()->findRealAccounts(),
				array('' => '')
		); ?>		
		<?php echo $form->error($model,'wlabel_id'); ?>
	</div>
<?php } ?>

	<div class="row">
		<?php if($model->icon != '') { ?>
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo Yii::app()->params['categoryIcon']; ?>/<?php echo $model->icon; ?>&amp;w=38&amp;h=38&amp;q=30&amp;a=t"/>
		<?php } ?>

		<?php echo $form->labelEx($model,'icon'); ?>
		<?php echo $form->fileField($model,'icon'); ?>
		<?php echo $form->error($model,'icon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100, 'class'=>"full")); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'domain'); ?>
		<?php echo $form->textField($model,'domain',array('size'=>60,'maxlength'=>100, 'class'=>"full")); ?>
		<?php echo $form->error($model,'domain'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->