<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('plan_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->plan_id), array('view', 'id'=>$data->plan_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wlabel_id')); ?>:</b>
	<?php echo CHtml::encode($data->wlabel_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
	<?php echo CHtml::encode($data->duration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />


</div>