<div class="cities index">
	<h2><?php echo __('Cities'); ?></h2>
	<div class="actions" style="float: right;margin-top: -50px; min-width:22%;">
		<?php echo $this->Html->link(__('Add New City'),array('action'=>'add'));?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('city_name'); ?></th>
			<th><?php echo $this->Paginator->sort('latitude'); ?></th>
			<th><?php echo $this->Paginator->sort('longitude'); ?></th>
			<th><?php echo $this->Paginator->sort('region'); ?></th>
			<th><?php echo $this->Paginator->sort('is_blocked'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($cities as $city): ?>
	<tr>
		<td><?php echo h($city['City']['id']); ?>&nbsp;</td>
		<td><?php echo h($city['City']['city_name']); ?>&nbsp;</td>
		<td><?php echo h($city['City']['lati']); ?>&nbsp;</td>
		<td><?php echo h($city['City']['longi']); ?>&nbsp;</td>
		<td><?php echo isset($cityregions[h($city['City']['region'])])?$cityregions[h($city['City']['region'])]:"Not Set"; ?>&nbsp;</td>
		<td><?php echo (h($city['City']['is_blocked']))?"Yes":"No"; ?>&nbsp;</td>
		
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $city['City']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $city['City']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $city['City']['id']), array(), __('Are you sure you want to delete # %s?', $city['City']['id'])); ?>
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
