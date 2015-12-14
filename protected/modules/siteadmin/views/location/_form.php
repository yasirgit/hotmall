<?php

$wlDomain = WhiteLabel::model()->getDomain();
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'location-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_location_id'); ?>
		<?php echo $form->dropDownList(
                $model,'parent_location_id',
                Location::model()->getLocations(),
                array('' => '')
        ); ?>	
		<?php echo $form->error($model,'parent_location_id'); ?>
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
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255, 'class'=>"full")); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'domain'); ?>
		<?php echo $form->textField($model,'domain',array('size'=>60,'maxlength'=>255)); ?>.<?php echo $wlDomain; ?>
		<?php echo $form->error($model,'domain'); ?>
	</div>

	<div class="row">
		<?php if($model->logo != '') { ?>
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo Yii::app()->params['locationLogo']; ?>/<?php echo $model->logo; ?>&amp;w=211&amp;h=157&amp;q=30&amp;a=tc" title="The Coupon Image"/>
		<?php } ?>
	
		<?php echo $form->labelEx($model,'logo'); ?>
		<?php echo $form->fileField($model, 'logo'); ?>
		<?php echo $form->error($model,'logo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'header_html'); ?>
		<?php echo $form->textArea($model,'header_html',array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
		<?php echo $form->error($model,'header_html'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'footer_html'); ?>
		<?php echo $form->textArea($model,'footer_html',array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
		<?php echo $form->error($model,'footer_html'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model, 'status', CHtml::listData(GeneralStatus::findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->