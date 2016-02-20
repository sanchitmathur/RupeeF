<div class="serviceTaxes index">
	<h2><?php echo __('Service Taxes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('is_active'); ?></th>
			<th><?php echo $this->Paginator->sort('is_deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($serviceTaxes as $serviceTax): ?>
	<tr>
		<td><?php echo h($serviceTax['ServiceTax']['id']); ?>&nbsp;</td>
		<td><?php echo h($serviceTax['ServiceTax']['amount']); ?>&nbsp;</td>
		<td><?php echo h($serviceTax['ServiceTax']['type']); ?>&nbsp;</td>
		<td><?php echo h($serviceTax['ServiceTax']['is_active']); ?>&nbsp;</td>
		<td><?php echo h($serviceTax['ServiceTax']['is_deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $serviceTax['ServiceTax']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $serviceTax['ServiceTax']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $serviceTax['ServiceTax']['id']), array(), __('Are you sure you want to delete # %s?', $serviceTax['ServiceTax']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Service Tax'), array('action' => 'add')); ?></li>
	</ul>
</div>
