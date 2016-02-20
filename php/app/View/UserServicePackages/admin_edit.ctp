<div class="userServicePackages form">
<?php echo $this->Form->create('UserServicePackage'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit User Service Package'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('service_package_id');
		echo $this->Form->input('package_name');
		echo $this->Form->input('description');
		echo $this->Form->input('amount');
		echo $this->Form->input('currency');
		echo $this->Form->input('purchase_datetime');
		echo $this->Form->input('is_blocked');
		echo $this->Form->input('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UserServicePackage.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('UserServicePackage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Service Packages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('controller' => 'service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package'), array('controller' => 'service_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
