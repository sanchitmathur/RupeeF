<div class="servicePackages form">
<?php echo $this->Form->create('ServiceProgresStep'); ?>
	<fieldset>
		<legend><?php echo __('Admin Process Steps'); ?></legend>
	<?php
		echo $this->Form->input('service_id');
		echo $this->Form->input('progress_step_id',array('multiple'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>
</div>