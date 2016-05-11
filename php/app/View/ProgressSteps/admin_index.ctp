<?php
	//pr($progressSteps);
?>
<div class="progresssteps index">
	<h2><?php echo __('Service Pregress Steps'); ?></h2>
	<div class="actions" style="float: right;margin-top: -50px; min-width:25%;">
		<?php echo $this->Html->link(__('Add progress Steps'),array('action'=>'add')); ?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('Name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($progressSteps as $progressStep): ?>
	<tr>
		<td><?php echo h($progressStep['ProgressStep']['id']); ?>&nbsp;</td>
		<td><?php echo h($progressStep['ProgressStep']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $progressStep['ProgressStep']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $progressStep['ProgressStep']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $progressStep['ProgressStep']['id']), array(), __('Are you sure you want to delete # %s?', $progressStep['ProgressStep']['id'])); ?>
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
