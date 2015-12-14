<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('newsletter_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->newsletter_id), array('view', 'id'=>$data->newsletter_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recipients')); ?>:</b>
	<?php echo CHtml::encode($data->recipients); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scheduled_date')); ?>:</b>
	<?php echo CHtml::encode($data->scheduled_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment')); ?>:</b>
	<?php echo CHtml::encode($data->attachment); ?>
	<br />


</div>