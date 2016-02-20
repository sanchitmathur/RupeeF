<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($user['User']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Blocked'); ?></dt>
		<dd>
			<?php echo h($user['User']['is_blocked']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($user['User']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Service Packages'), array('controller' => 'user_service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Service Package'), array('controller' => 'user_service_packages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Services'), array('controller' => 'user_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Service'), array('controller' => 'user_services', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related User Service Packages'); ?></h3>
	<?php if (!empty($user['UserServicePackage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Service Package Id'); ?></th>
		<th><?php echo __('Package Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Currency'); ?></th>
		<th><?php echo __('Purchase Datetime'); ?></th>
		<th><?php echo __('Is Blocked'); ?></th>
		<th><?php echo __('Is Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserServicePackage'] as $userServicePackage): ?>
		<tr>
			<td><?php echo $userServicePackage['id']; ?></td>
			<td><?php echo $userServicePackage['user_id']; ?></td>
			<td><?php echo $userServicePackage['service_package_id']; ?></td>
			<td><?php echo $userServicePackage['package_name']; ?></td>
			<td><?php echo $userServicePackage['description']; ?></td>
			<td><?php echo $userServicePackage['amount']; ?></td>
			<td><?php echo $userServicePackage['currency']; ?></td>
			<td><?php echo $userServicePackage['purchase_datetime']; ?></td>
			<td><?php echo $userServicePackage['is_blocked']; ?></td>
			<td><?php echo $userServicePackage['is_deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_service_packages', 'action' => 'view', $userServicePackage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_service_packages', 'action' => 'edit', $userServicePackage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_service_packages', 'action' => 'delete', $userServicePackage['id']), array(), __('Are you sure you want to delete # %s?', $userServicePackage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Service Package'), array('controller' => 'user_service_packages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Services'); ?></h3>
	<?php if (!empty($user['UserService'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Service Id'); ?></th>
		<th><?php echo __('Purchase Datetime'); ?></th>
		<th><?php echo __('Is Blocked'); ?></th>
		<th><?php echo __('Is Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserService'] as $userService): ?>
		<tr>
			<td><?php echo $userService['id']; ?></td>
			<td><?php echo $userService['user_id']; ?></td>
			<td><?php echo $userService['service_id']; ?></td>
			<td><?php echo $userService['purchase_datetime']; ?></td>
			<td><?php echo $userService['is_blocked']; ?></td>
			<td><?php echo $userService['is_deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_services', 'action' => 'view', $userService['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_services', 'action' => 'edit', $userService['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_services', 'action' => 'delete', $userService['id']), array(), __('Are you sure you want to delete # %s?', $userService['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Service'), array('controller' => 'user_services', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
