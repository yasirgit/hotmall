<article>
<!-- Content Area Starts -->

<h1>Customer Login</h1>
<p>You Must Log In To Take Advantage Of These Great Deals. If You Haven't Registered, Please Click The Link Below</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<ul class="content-menu">
<li>
	<a href="<?php echo Yii::app()->createUrl('customer/register'); ?>" class="dine">Customer Registration</a>
</li>
<li>
	<a href="<?php echo Yii::app()->createUrl('site'); ?>" class="stay">Skip Registration</a>
</li>
</ul>

<!-- Content Area Ends -->
</article>
