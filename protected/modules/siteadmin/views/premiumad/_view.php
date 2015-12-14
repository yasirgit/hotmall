<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('premiumad_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->premiumad_id), array('view', 'id'=>$data->premiumad_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wlabel_id')); ?>:</b>
	<?php echo CHtml::encode($data->wlabel_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('headline')); ?>:</b>
	<?php echo CHtml::encode($data->headline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link_text')); ?>:</b>
	<?php echo CHtml::encode($data->link_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link_url')); ?>:</b>
	<?php echo CHtml::encode($data->link_url); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($data->position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_type')); ?>:</b>
	<?php echo CHtml::encode($data->display_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('show_on_static')); ?>:</b>
	<?php echo CHtml::encode($data->show_on_static); ?>
	<br />

	*/ ?>

</div>