<?php 
$passed = true;		
$advertisers = Advertiser::model()->getAdvertisers();
if(count($advertisers) <= 0) {
	echo "You need to define some advertisers first!<br/>";
	$passed = false;
}

$categories = Category::model()->getCategories(false);
if(count($categories) <= 0) {
	echo "You need to define some categories first!<br/>";
	$passed = false;
}

$locations = Location::model()->getLocations(false);
if(count($locations) <= 0) {
	echo "You need to define some locations first!<br/>";
	$passed = false;
}

	
if($passed) {
?>

	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'listing-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('enctype' => 'multipart/form-data')
	)); ?>

	
	<?php echo $form->errorSummary($model); ?>
	
	<?php if(!Yii::app()->user->isAdvertiser()) { ?>	
		<div class="select-menu">
			<?php echo $form->labelEx($model,'advertiser_id'); ?>
			<?php echo $form->dropDownList(
					$model,'advertiser_id',
					$advertisers,
					array('' => '')
			); ?>		
			<?php echo $form->error($model,'advertiser_id'); ?>
		</div>
	<?php } ?>
		
		<div class="select-menu">
		<label for="Listing_p_locations">Preselected Categories:</label>
		<select class="field select large" name="" tabindex="3">
			<option value="Low"> Mall </option>
			<option value="full"> Hotel </option>
			<option value="High"> Store </option>
		</select>
		</div>
	
		<div class="select-menu">
			<?php echo $form->labelEx($model,'p_categories'); ?>
			<?php echo $form->dropDownList(
					$model, 'p_categories', 
					$categories, 
					array('multiple'=>'multiple', 'size'=>6)
			); ?>
			<?php echo $form->error($model,'p_categories'); ?>
		</div>
	
		<div class="select-menu">
			<?php echo $form->labelEx($model,'p_locations'); ?>
			<?php echo $form->dropDownList(
					$model, 'p_locations', 
					$locations, 
					array('multiple'=>'multiple', 'size'=>6)
			); ?>
			<?php echo $form->error($model,'p_locations'); ?>
		</div>

		<div class="clearfix"></div>
		
		<div>
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100, 'class'=>"full")); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
	
		<div>
			<?php echo $form->labelEx($model,'url'); ?>
			<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>100, 'class'=>"full")); ?>
			<?php echo $form->error($model,'url'); ?>
			<p class="hint">(Ex: http://www.YourDomain.com)</p>
		</div>

		<div class="row">
			<?php if($model->logo != '') { ?>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo Yii::app()->params['listingLogo']; ?>/<?php echo $model->logo; ?>&amp;w=211&amp;h=157&amp;q=30&amp;a=tc" title="The Coupon Image"/>
			<?php } ?>

		
			<?php echo $form->labelEx($model,'logo'); ?>
			<?php echo $form->fileField($model,'logo'); ?>
			<?php echo $form->error($model,'logo'); ?>
		</div>

			<div class="row">
			<?php echo $form->labelEx($model,'street_address'); ?>
			<?php echo $form->textField($model,'street_address',array('size'=>60,'maxlength'=>100, 'class'=>"full")); ?>
			<?php echo $form->error($model,'street_address'); ?>
		</div>
	
		<div class="select-menu">
			<?php echo $form->labelEx($model,'city'); ?>
			<?php echo $form->textField($model,'city',array('size'=>40,'maxlength'=>40)); ?>
			<?php echo $form->error($model,'city'); ?>
		</div>
	
		<div class="select-menu">
			<?php echo $form->labelEx($model,'state'); ?>
			<?php echo $form->textField($model,'state',array('size'=>40,'maxlength'=>40)); ?>
			<?php echo $form->error($model,'state'); ?>
		</div>
	
		<div class="select-menu">
			<?php echo $form->labelEx($model,'zip'); ?>
			<?php echo $form->textField($model,'zip',array('size'=>40,'maxlength'=>40)); ?>
			<?php echo $form->error($model,'zip'); ?>
		</div>
		<div class="clearfix"></div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'phone'); ?>
			<?php echo $form->textField($model,'phone',array('size'=>40,'maxlength'=>40, 'class'=>"full")); ?>
			<?php echo $form->error($model,'phone'); ?>
			<p class="hint">Phone Format: 123-456-7890</p>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'type'); ?>
			<?php echo $form->dropDownList($model, 'type', CHtml::listData(ListingType::findAll(), 'id', 'name')); ?>
			<?php echo $form->error($model,'type'); ?>
		</div>
	
		<table id="coupons" class="coupons">
	    <thead>
	        <tr>
	            <td>
	                <?php echo CHtml::link('Add Coupon', '', array('onClick'=>'addCoupon($(this))', 'class'=>'listingAdd'/* 'submit'=>'', 'params'=>array('Student[command]'=>'add', 'noValidate'=>true)/**/));?>
	            </td>
	        </tr>
	    </thead>
	    <tbody>
	    <?php foreach($coupons->items as $id=>$cModel): ?> 
	    	<?php $this->renderPartial('_formCoupons', array('id'=>$id, 'model'=>$cModel, 'form'=>$form));?>
	    <?php endforeach;?>
	    </tbody>
	    </table>
	
		<?php $this->renderPartial('couponsJs', array('coupons'=>$coupons, 'form'=>$form)); ?>
		
		
		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create Listing' : 'Save Listing', array('class'=>"button ui-state-default ui-corner-all form-submit")); ?>
		</div>
	
	<?php $this->endWidget(); ?>
	
	</div><!-- form -->
<?php } ?>