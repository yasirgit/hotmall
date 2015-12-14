<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pwhitelabel-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-header">Settings</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>40, 'class'=>"full")); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'domain'); ?>
		<?php echo $form->textField($model,'domain',array('size'=>60,'maxlength'=>150, 'class'=>"full")); ?>
		<?php echo $form->error($model,'domain'); ?>
		<p>domain without www., for example yourdomain.com</p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site_area'); ?>
		<?php echo $form->textField($model,'site_area',array('size'=>60,'maxlength'=>250, 'class'=>"full")); ?>
		<?php echo $form->error($model,'site_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site_title'); ?>
		<?php echo $form->textField($model,'site_title',array('size'=>60,'maxlength'=>250, 'class'=>"full")); ?>
		<?php echo $form->error($model,'site_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site_keywords'); ?>
		<?php echo $form->textArea($model,'site_keywords',array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
		<?php echo $form->error($model,'site_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site_desc'); ?>
		<?php echo $form->textArea($model,'site_desc',array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
		<?php echo $form->error($model,'site_desc'); ?>
	</div>

	<div class="select-menu">
		<?php echo $form->labelEx($model,'show_listing_from_all'); ?>
		<?php echo $form->checkBox($model,'show_listing_from_all'); ?>
		<?php echo $form->error($model,'show_listing_from_all'); ?>
	</div>

	<div class="select-menu">
		<?php echo $form->labelEx($model,'moderate_members'); ?>
		<?php echo $form->checkBox($model,'moderate_members'); ?>
		<?php echo $form->error($model,'moderate_members'); ?>
	</div>

	<div class="select-menu">
		<?php echo $form->labelEx($model,'moderate_mediabrokers'); ?>
		<?php echo $form->checkBox($model,'moderate_mediabrokers'); ?>
		<?php echo $form->error($model,'moderate_mediabrokers'); ?>
	</div>

	<div class="select-menu">
		<?php echo $form->labelEx($model,'premiumad_priority'); ?>
		<?php echo $form->checkBox($model,'premiumad_priority'); ?>
		<?php echo $form->error($model,'premiumad_priority'); ?>
	</div>
	<div class="clearfix"></div>
	
	<div class="form-header">Site Content</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'site_terms'); ?>
		<?php echo $form->textArea($model,'site_terms',array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
		<?php echo $form->error($model,'site_terms'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site_testimonial'); ?>
		<?php echo $form->textArea($model,'site_testimonial',array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
		<?php echo $form->error($model,'site_testimonial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site_welcome'); ?>
		<?php echo $form->textArea($model,'site_welcome',array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
		<?php echo $form->error($model,'site_welcome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site_dailydeals'); ?>
		<?php echo $form->textArea($model,'site_dailydeals',array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
		<?php echo $form->error($model,'site_dailydeals'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site_mostpopular'); ?>
		<?php echo $form->textArea($model,'site_mostpopular',array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
		<?php echo $form->error($model,'site_mostpopular'); ?>
	</div>

	<div class="form-header">Contact Information</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'contact_email'); ?>
		<?php echo $form->textField($model,'contact_email',array('size'=>60,'maxlength'=>250, 'class'=>"full")); ?>
		<?php echo $form->error($model,'contact_email'); ?>
	</div>

	<div class="form-header">Payment Information</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'payment_type'); ?>
		<?php echo $form->dropDownList($model, 'payment_type', CHtml::listData(PaymentType::findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'payment_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paypal_email'); ?>
		<?php echo $form->textField($model,'paypal_email',array('size'=>60,'maxlength'=>250, 'class'=>"full")); ?>
		<?php echo $form->error($model,'paypal_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'auth_api_id'); ?>
		<?php echo $form->textField($model,'auth_api_id',array('size'=>60,'maxlength'=>250, 'class'=>"full")); ?>
		<?php echo $form->error($model,'auth_api_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'auth_trans_key'); ?>
		<?php echo $form->textField($model,'auth_trans_key',array('size'=>40,'maxlength'=>40, 'class'=>"full")); ?>
		<?php echo $form->error($model,'auth_trans_key'); ?>
	</div>

	<div class="form-header">Media Broker Commissions</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mb_commission_type'); ?>
		<?php echo $form->dropDownList($model, 'mb_commission_type', CHtml::listData(CommissionType::findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'mb_commission_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mb_commission'); ?>
		<?php echo $form->textField($model,'mb_commission',array('size'=>10,'maxlength'=>10, 'class'=>"full")); ?>
		<?php echo $form->error($model,'mb_commission'); ?>
	</div>
	
	<div class="form-header">Advertising Plans</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news_price'); ?>
		<?php echo $form->textField($model,'news_price',array('size'=>10,'maxlength'=>10, 'class'=>"full")); ?>
		<?php echo $form->error($model,'news_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'banner_price'); ?>
		<?php echo $form->textField($model,'banner_price',array('size'=>10,'maxlength'=>10, 'class'=>"full")); ?>
		<?php echo $form->error($model,'banner_price'); ?>
	</div>
	
<!--
	<div class="form-header">Premium Ad</div>

	<div class="row">
		<?php echo $form->labelEx($model,'premiumad_display_type'); ?>
		<?php echo $form->textField($model,'premiumad_display_type',array('class'=>"full")); ?>
		<?php echo $form->error($model,'premiumad_display_type'); ?>
	</div>
-->	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->