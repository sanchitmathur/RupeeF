
<div class="cities form">
<?php echo $this->Form->create('ServiceDocument'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Document Type'); ?></legend>
	<?php
		echo $this->Form->input('service_id',array('value'=>$serviceId));
		echo $this->Form->input('document_type_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>
</div>
