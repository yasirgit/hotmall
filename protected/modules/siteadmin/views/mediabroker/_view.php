<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mbroker_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mbroker_id), array('view', 'id'=>$data->mbroker_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wlabel_id')); ?>:</b>
	<?php echo CHtml::encode($data->wlabel_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ref')); ?>:</b>
	<?php echo CHtml::encode($data->ref); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>