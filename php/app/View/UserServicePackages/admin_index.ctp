<div class="userServicePackages index">
	<h2><?php echo __('User Service Packages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_package_id'); ?></th>
			<th><?php echo $this->Paginator->sort('package_name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('currency'); ?></th>
			<th><?php echo $this->Paginator->sort('purchase_datetime'); ?></th>
			<th><?php echo $this->Paginator->sort('is_blocked'); ?></th>
			<th><?php echo $this->Paginator->sort('is_deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($userServicePackages as $userServicePackage): ?>
	<tr>
		<td><?php echo h($userServicePackage['UserServicePackage']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userServicePackage['User']['name'], array('controller' => 'users', 'action' => 'view', $userServicePackage['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userServicePackage['ServicePackage']['package_name'], array('controller' => 'service_packages', 'action' => 'view', $userServicePackage['ServicePackage']['id'])); ?>
		</td>
		<td><?php echo h($userServicePackage['UserServicePackage']['package_name']); ?>&nbsp;</td>
		<td><?php echo h($userServicePackage['UserServicePackage']['description']); ?>&nbsp;</td>
		<td><?php echo h($userServicePackage['UserServicePackage']['amount']); ?>&nbsp;</td>
		<td><?php echo h($userServicePackage['UserServicePackage']['currency']); ?>&nbsp;</td>
		<td><?php echo h($userServicePackage['UserServicePackage']['purchase_datetime']); ?>&nbsp;</td>
		<td><?php echo h($userServicePackage['UserServicePackage']['is_blocked']); ?>&nbsp;</td>
		<td><?php echo h($userServicePackage['UserServicePackage']['is_deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userServicePackage['UserServicePackage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userServicePackage['UserServicePackage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userServicePackage['UserServicePackage']['id']), array(), __('Are you sure you want to delete # %s?', $userServicePackage['UserServicePackage']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User Service Package'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('controller' => 'service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package'), array('controller' => 'service_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
