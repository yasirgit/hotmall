<article>
	<!-- Content Area Starts -->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'coupon-redemption-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h1>Promotion Redemption</h1>
	<p>To Redeem, Please Enter The Salespersons Identification In The Space Below And Tap The Redeem Button.</p>
	<br/>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>40,'maxlength'=>40,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'clerk_id'); ?>
		<?php echo $form->textField($model,'clerk_id'); ?>
		<?php echo $form->error($model,'clerk_id'); ?>
	</div>

	<input type="hidden" name="CouponRedemption[coupon_id]" value="<?php echo $model->coupon_id; ?>">
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Redeem'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<!-- Content Area Ends -->
</article>