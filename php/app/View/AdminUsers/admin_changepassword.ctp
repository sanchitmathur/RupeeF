<div class="users form">
<?php echo $this->Form->create('AdminUser'); ?>
	<fieldset>
		<legend><?php echo __('Change Password'); ?></legend>
	<?php
		echo $this->Form->hidden('old_password',array('type'=>'password'));
		echo $this->Form->input('new_password',array('type'=>'password'));
		echo $this->Form->input('confirm_password',array('type'=>'password'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

</div>
