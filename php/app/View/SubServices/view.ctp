<div class="subServices view">
<h2><?php echo __('Sub Service'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($subService['SubService']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Name'); ?></dt>
		<dd>
			<?php echo h($subService['SubService']['service_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Main Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($subService['MainService']['service_name'], array('controller' => 'main_services', 'action' => 'view', $subService['MainService']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Blocked'); ?></dt>
		<dd>
			<?php echo h($subService['SubService']['is_blocked']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($subService['SubService']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sub Service'), array('action' => 'edit', $subService['SubService']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sub Service'), array('action' => 'delete', $subService['SubService']['id']), array(), __('Are you sure you want to delete # %s?', $subService['SubService']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sub Services'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Service'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Main Services'), array('controller' => 'main_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Main Service'), array('controller' => 'main_services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Services'); ?></h3>
	<?php if (!empty($subService['Service'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Service Name'); ?></th>
		<th><?php echo __('Sub Service Id'); ?></th>
		<th><?php echo __('Is Blocked'); ?></th>
		<th><?php echo __('Is Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($subService['Service'] as $service): ?>
		<tr>
			<td><?php echo $service['id']; ?></td>
			<td><?php echo $service['service_name']; ?></td>
			<td><?php echo $service['sub_service_id']; ?></td>
			<td><?php echo $service['is_blocked']; ?></td>
			<td><?php echo $service['is_deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'services', 'action' => 'view', $service['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'services', 'action' => 'edit', $service['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'services', 'action' => 'delete', $service['id']), array(), __('Are you sure you want to delete # %s?', $service['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
