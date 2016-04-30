<div class="mainServices form">
<?php echo $this->Form->create('AdminUser'); ?>
	<fieldset>
		<legend><?php echo __('Admin Login'); ?></legend>
	<?php
		echo $this->Form->input('email');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px; min-width: 40%;">
	<?php echo $this->Html->link(__('Forgot Password'), array('controller'=>'AdminUsers','action' => 'forgotpassword'),array('style'=>'color:#e32;')); ?>
</div>
</div>