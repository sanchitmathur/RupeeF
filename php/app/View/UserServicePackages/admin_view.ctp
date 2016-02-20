<div class="userServicePackages view">
<h2><?php echo __('User Service Package'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userServicePackage['UserServicePackage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userServicePackage['User']['name'], array('controller' => 'users', 'action' => 'view', $userServicePackage['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Package'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userServicePackage['ServicePackage']['package_name'], array('controller' => 'service_packages', 'action' => 'view', $userServicePackage['ServicePackage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Package Name'); ?></dt>
		<dd>
			<?php echo h($userServicePackage['UserServicePackage']['package_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($userServicePackage['UserServicePackage']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($userServicePackage['UserServicePackage']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Currency'); ?></dt>
		<dd>
			<?php echo h($userServicePackage['UserServicePackage']['currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase Datetime'); ?></dt>
		<dd>
			<?php echo h($userServicePackage['UserServicePackage']['purchase_datetime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Blocked'); ?></dt>
		<dd>
			<?php echo h($userServicePackage['UserServicePackage']['is_blocked']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($userServicePackage['UserServicePackage']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Service Package'), array('action' => 'edit', $userServicePackage['UserServicePackage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Service Package'), array('action' => 'delete', $userServicePackage['UserServicePackage']['id']), array(), __('Are you sure you want to delete # %s?', $userServicePackage['UserServicePackage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Service Packages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Service Package'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('controller' => 'service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package'), array('controller' => 'service_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
