<div class="mainServices form">
<?php echo $this->Form->create('AdminUser'); ?>
	<fieldset>
		<legend><?php echo __('Admin Login'); ?></legend>
	<?php
		echo $this->Form->input('service_name');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>