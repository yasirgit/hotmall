<tr>    
    <td>
    <hr/>
    
	<div class="row">
	<?php echo $form->labelEx($model,'code'); ?>
	<?php echo $form->textField($model,"[$id]code",array('size'=>40,'maxlength'=>40, 'class'=>"full")); ?>
	<?php echo $form->error($model,'code'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'headline'); ?>
	<?php echo $form->textField($model,"[$id]headline",array('size'=>60,'maxlength'=>100, 'class'=>"full")); ?>
	<?php echo $form->error($model,'headline'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'description'); ?>
	<?php echo $form->textArea($model,"[$id]description",array('rows'=>6, 'cols'=>50, 'class'=>"full")); ?>
	<?php echo $form->error($model,'description'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'url_text'); ?>
	<?php echo $form->textField($model,"[$id]url_text",array('size'=>40,'maxlength'=>40, 'class'=>"full")); ?>
	<?php echo $form->error($model,'url_text'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'url_link'); ?>
	<?php echo $form->textField($model,"[$id]url_link",array('size'=>40,'maxlength'=>40, 'class'=>"full")); ?>
	<?php echo $form->error($model,'url_link'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'disclaimer'); ?>
	<?php echo $form->textField($model,"[$id]disclaimer",array('size'=>40,'maxlength'=>40, 'class'=>"full")); ?>
	<?php echo $form->error($model,'disclaimer'); ?>
</div>

<div class="select-menu">
	<?php echo $form->labelEx($model,'date_start'); ?>
	<?php echo $form->textField($model,"[$id]date_start", array('class'=>"datepicker")); ?>
	<?php echo $form->error($model,'date_start'); ?>
</div>

<div class="select-menu">
	<?php echo $form->labelEx($model,'date_end'); ?>
	<?php echo $form->textField($model,"[$id]date_end", array('class'=>"datepicker")); ?>
	<?php echo $form->error($model,'date_end'); ?>
</div>

<div class="clearfix"></div>

        <?php echo CHtml::link(
                'Delete this coupon', 
                '', 
                array(
                    'class'=>'listingDelete',
                    'onClick'=>'deleteCoupon($(this))', /*
                    'submit'=>'', 
                    'params'=>array(
                        'Student[command]'=>'delete', 
                        'Student[id]'=>$id, 
                        'noValidate'=>true)/**/
                    ));?>
                   
	    <?php echo CHtml::link('Add New Coupon', '', array('onClick'=>'addCoupon($(this))', 'class'=>'listingAdd'/* 'submit'=>'', 'params'=>array('Student[command]'=>'add', 'noValidate'=>true)/**/));?>
                    
    </td>
</tr>