<div class="form2" style="display: block; color: white; margin-right: 20px; margin-left: 20px;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'location-form',
	'enableAjaxValidation'=>false,
	'action'=>Yii::app()->createUrl("siteadmin/defaultwlid"),
	
)); ?>

	<div>
		Default Whitelabel Account: 
			<?php echo CHtml::dropDownList('wlabel_id', $default_wlabel_id, WhiteLabel::model()->findRealAccounts()); ?>
			
		<?php echo CHtml::submitButton('Ok'); ?>			
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->