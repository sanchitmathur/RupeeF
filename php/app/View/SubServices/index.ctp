<div class="subServices index">
	<h2><?php echo __('Sub Services'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_name'); ?></th>
			<th><?php echo $this->Paginator->sort('main_service_id'); ?></th>
			<th><?php echo $this->Paginator->sort('is_blocked'); ?></th>
			<th><?php echo $this->Paginator->sort('is_deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($subServices as $subService): ?>
	<tr>
		<td><?php echo h($subService['SubService']['id']); ?>&nbsp;</td>
		<td><?php echo h($subService['SubService']['service_name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($subService['MainService']['service_name'], array('controller' => 'main_services', 'action' => 'view', $subService['MainService']['id'])); ?>
		</td>
		<td><?php echo h($subService['SubService']['is_blocked']); ?>&nbsp;</td>
		<td><?php echo h($subService['SubService']['is_deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $subService['SubService']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $subService['SubService']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $subService['SubService']['id']), array(), __('Are you sure you want to delete # %s?', $subService['SubService']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sub Service'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Main Services'), array('controller' => 'main_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Main Service'), array('controller' => 'main_services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
