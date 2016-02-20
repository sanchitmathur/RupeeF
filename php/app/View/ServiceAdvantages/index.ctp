<div class="serviceAdvantages index">
	<h2><?php echo __('Service Advantages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_id'); ?></th>
			<th><?php echo $this->Paginator->sort('advantage_image'); ?></th>
			<th><?php echo $this->Paginator->sort('advantage_heading'); ?></th>
			<th><?php echo $this->Paginator->sort('advantage_description'); ?></th>
			<th><?php echo $this->Paginator->sort('is_blocked'); ?></th>
			<th><?php echo $this->Paginator->sort('is_deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($serviceAdvantages as $serviceAdvantage): ?>
	<tr>
		<td><?php echo h($serviceAdvantage['ServiceAdvantage']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($serviceAdvantage['Service']['service_name'], array('controller' => 'services', 'action' => 'view', $serviceAdvantage['Service']['id'])); ?>
		</td>
		<td><?php echo h($serviceAdvantage['ServiceAdvantage']['advantage_image']); ?>&nbsp;</td>
		<td><?php echo h($serviceAdvantage['ServiceAdvantage']['advantage_heading']); ?>&nbsp;</td>
		<td><?php echo h($serviceAdvantage['ServiceAdvantage']['advantage_description']); ?>&nbsp;</td>
		<td><?php echo h($serviceAdvantage['ServiceAdvantage']['is_blocked']); ?>&nbsp;</td>
		<td><?php echo h($serviceAdvantage['ServiceAdvantage']['is_deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $serviceAdvantage['ServiceAdvantage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $serviceAdvantage['ServiceAdvantage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $serviceAdvantage['ServiceAdvantage']['id']), array(), __('Are you sure you want to delete # %s?', $serviceAdvantage['ServiceAdvantage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Service Advantage'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
