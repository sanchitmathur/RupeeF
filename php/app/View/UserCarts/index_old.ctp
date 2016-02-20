<div class="userCarts index">
	<h2><?php echo __('User Carts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_package_id'); ?></th>
			<th><?php echo $this->Paginator->sort('is_active'); ?></th>
			<th><?php echo $this->Paginator->sort('is_deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($userCarts as $userCart): ?>
	<tr>
		<td><?php echo h($userCart['UserCart']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userCart['User']['name'], array('controller' => 'users', 'action' => 'view', $userCart['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userCart['Service']['service_name'], array('controller' => 'services', 'action' => 'view', $userCart['Service']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userCart['ServicePackage']['package_name'], array('controller' => 'service_packages', 'action' => 'view', $userCart['ServicePackage']['id'])); ?>
		</td>
		<td><?php echo h($userCart['UserCart']['is_active']); ?>&nbsp;</td>
		<td><?php echo h($userCart['UserCart']['is_deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userCart['UserCart']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userCart['UserCart']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userCart['UserCart']['id']), array(), __('Are you sure you want to delete # %s?', $userCart['UserCart']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New User Cart'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('controller' => 'service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package'), array('controller' => 'service_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
