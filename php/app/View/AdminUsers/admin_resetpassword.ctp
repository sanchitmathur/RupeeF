<div class="users form">
<?php echo $this->Form->create('AdminUser'); ?>
	<fieldset>
		<legend><?php echo __('Set New Password'); ?></legend>
	<?php
		echo $this->Form->hidden('admin_id',array('value'=>$admin_id));
		echo $this->Form->hidden('reset_token',array('value'=>$reset_token));
		echo $this->Form->input('new_password',array('type'=>'password'));
		echo $this->Form->input('confirm_password',array('type'=>'password'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

</div>
