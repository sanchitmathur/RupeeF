<div class="mainServices view">
<h2><?php echo __('Main Service'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mainService['MainService']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Name'); ?></dt>
		<dd>
			<?php echo h($mainService['MainService']['service_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Blocked'); ?></dt>
		<dd>
			<?php echo h($mainService['MainService']['is_blocked']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($mainService['MainService']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
	
	<div class="related">
		<h3><?php echo __('Related Sub Services'); ?></h3>
		<?php if (!empty($mainService['SubService'])): ?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Service Name'); ?></th>
			<th><?php echo __('Main Service Id'); ?></th>
			<th><?php echo __('Is Blocked'); ?></th>
			<th><?php echo __('Is Deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($mainService['SubService'] as $subService): ?>
			<tr>
				<td><?php echo $subService['id']; ?></td>
				<td><?php echo $subService['service_name']; ?></td>
				<td><?php echo $subService['main_service_id']; ?></td>
				<td><?php echo $subService['is_blocked']; ?></td>
				<td><?php echo $subService['is_deleted']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'sub_services', 'action' => 'view', $subService['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'sub_services', 'action' => 'edit', $subService['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sub_services', 'action' => 'delete', $subService['id']), array(), __('Are you sure you want to delete # %s?', $subService['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	
	</div>
</div>


