<div class="users form">
<?php echo $this->Form->create('AdminUser'); ?>
	<fieldset>
		<legend><?php echo __('Reset Password'); ?></legend>
	<?php
		
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('controller'=>'MainServices','action' => 'login','admin'=>true)); ?>
</div>
</div>
