<div class="userServices view">
<h2><?php echo __('User Service'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userService['UserService']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userService['User']['name'], array('controller' => 'users', 'action' => 'view', $userService['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userService['Service']['service_name'], array('controller' => 'services', 'action' => 'view', $userService['Service']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase Datetime'); ?></dt>
		<dd>
			<?php echo h($userService['UserService']['purchase_datetime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Blocked'); ?></dt>
		<dd>
			<?php echo h($userService['UserService']['is_blocked']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($userService['UserService']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Service'), array('action' => 'edit', $userService['UserService']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Service'), array('action' => 'delete', $userService['UserService']['id']), array(), __('Are you sure you want to delete # %s?', $userService['UserService']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Services'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Service'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
