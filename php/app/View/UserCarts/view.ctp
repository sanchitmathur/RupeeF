<div class="userCarts view">
<h2><?php echo __('User Cart'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userCart['UserCart']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userCart['User']['name'], array('controller' => 'users', 'action' => 'view', $userCart['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userCart['Service']['service_name'], array('controller' => 'services', 'action' => 'view', $userCart['Service']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Package'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userCart['ServicePackage']['package_name'], array('controller' => 'service_packages', 'action' => 'view', $userCart['ServicePackage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($userCart['UserCart']['is_active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($userCart['UserCart']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Cart'), array('action' => 'edit', $userCart['UserCart']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Cart'), array('action' => 'delete', $userCart['UserCart']['id']), array(), __('Are you sure you want to delete # %s?', $userCart['UserCart']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Carts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Cart'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('controller' => 'service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package'), array('controller' => 'service_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
