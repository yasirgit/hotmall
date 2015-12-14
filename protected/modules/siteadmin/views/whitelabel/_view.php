<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('wlabel_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->wlabel_id), array('view', 'id'=>$data->wlabel_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>