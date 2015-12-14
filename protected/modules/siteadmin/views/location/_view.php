<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->location_id), array('view', 'id'=>$data->location_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_location_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_location_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wlabel_id')); ?>:</b>
	<?php echo CHtml::encode($data->wlabel_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logo')); ?>:</b>
	<?php echo CHtml::encode($data->logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('header_html')); ?>:</b>
	<?php echo CHtml::encode($data->header_html); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('footer_html')); ?>:</b>
	<?php echo CHtml::encode($data->footer_html); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>