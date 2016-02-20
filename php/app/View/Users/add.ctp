<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('image');
		echo $this->Form->input('is_blocked');
		echo $this->Form->input('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List User Service Packages'), array('controller' => 'user_service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Service Package'), array('controller' => 'user_service_packages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Services'), array('controller' => 'user_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Service'), array('controller' => 'user_services', 'action' => 'add')); ?> </li>
	</ul>
</div>
