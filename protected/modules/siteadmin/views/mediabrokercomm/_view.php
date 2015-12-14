<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mbcommission_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mbcommission_id), array('view', 'id'=>$data->mbcommission_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mbroker_id')); ?>:</b>
	<?php echo CHtml::encode($data->mbroker_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pppayment_id')); ?>:</b>
	<?php echo CHtml::encode($data->pppayment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_paid')); ?>:</b>
	<?php echo CHtml::encode($data->date_paid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('paystatus')); ?>:</b>
	<?php echo CHtml::encode($data->paystatus); ?>
	<br />

	*/ ?>

</div>