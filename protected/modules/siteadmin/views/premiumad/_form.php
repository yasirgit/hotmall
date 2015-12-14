<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'premium-ad-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); ?>

	<?php echo $form->errorSummary($model); ?>

<?php if(!Yii::app()->user->isAdvertiser()) { ?>	
	<div class="row">
		<?php echo $form->labelEx($model,'advertiser_id'); ?>
		<?php echo $form->dropDownList(
			$model,'advertiser_id',
			Advertiser::model()->getAdvertisers(),
			array('' => '')
		); ?>		
		<?php echo $form->error($model,'advertiser_id'); ?>
	</div>
<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'headline'); ?>
		<?php echo $form->textField($model,'headline',array('size'=>60,'maxlength'=>200, 'class'=>"full")); ?>
		<?php echo $form->error($model,'headline'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php if($model->image != '') { ?>
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo Yii::app()->params['premiumAdImage']; ?>/<?php echo $model->image; ?>&amp;w=211&amp;h=157&amp;q=30&amp;a=tc" title="The Coupon Image"/>
		<?php } ?>


		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link_text'); ?>
		<?php echo $form->textField($model,'link_text',array('size'=>60,'maxlength'=>250, 'class'=>"full")); ?>
		<?php echo $form->error($model,'link_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link_url'); ?>
		<?php echo $form->textField($model,'link_url',array('size'=>60,'maxlength'=>250, 'class'=>"full")); ?>
		<?php echo $form->error($model,'link_url'); ?>
	</div>

	<div class="select-menu">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->dropDownList($model, 'position', CHtml::listData(PremiumAdPosition::findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="select-menu">
		<?php echo $form->labelEx($model,'display_type'); ?>
		<?php echo $form->dropDownList($model, 'display_type', CHtml::listData(PremiumAdDisplayType::findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'display_type'); ?>
	</div>

	<div class="select-menu">
		<?php echo $form->labelEx($model,'p_categories'); ?>
		<?php echo $form->dropDownList(
				$model, 'p_categories', 
				Category::model()->getCategories(false), 
				array('multiple'=>'multiple', 'size'=>4)
			); ?>
		<?php echo $form->error($model,'p_categories'); ?>
	</div>		

	<div class="select-menu">
		<?php echo $form->labelEx($model,'p_locations'); ?>
		<?php echo $form->dropDownList(
				$model, 'p_locations', 
				Location::model()->getLocations(false), 
				array('multiple'=>'multiple', 'size'=>4)
			); ?>
		<?php echo $form->error($model,'p_locations'); ?>
	</div>		
	<div class="clearfix"></div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'p_listings'); ?>
		<?php echo $form->dropDownList(
				$model, 'p_listings', 
				CHtml::listData(Listing::model()->getListings(), 'listing_id', 'name'), 
				array('multiple'=>'multiple', 'size'=>4)
		); ?>
		<?php echo $form->error($model,'p_listings'); ?>
	</div>		

	<div class="row">
		<?php echo $form->labelEx($model,'show_on_static'); ?>
		<?php echo $form->checkBox($model,'show_on_static'); ?>
		<?php echo $form->error($model,'show_on_static'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
