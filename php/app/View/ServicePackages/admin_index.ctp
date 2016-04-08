<script type="text/javascript">
	$(document).ready(function(){
		
	});
</script>
<div class="servicePackages index">
	<h2><?php echo __('Service Packages'); ?></h2>
	<div class="actions" style="float: right;margin-top: -50px; min-width:25% !important;">
		<?php
			echo $this->Form->create('Service');
			echo $this->Form->input('service_id',array('value'=>$serviceId));
		?>
		<?php echo $this->Html->link(__('Add New Service Package'), array('action' => 'add')); ?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('package_name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('currency'); ?></th>
			<th><?php echo $this->Paginator->sort('service_id'); ?></th>
			<th><?php echo $this->Paginator->sort('is_blocked'); ?></th>
			<th><?php echo $this->Paginator->sort('is_deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($servicePackages as $servicePackage): ?>
	<tr>
		<td><?php echo h($servicePackage['ServicePackage']['id']); ?>&nbsp;</td>
		<td><?php echo h($servicePackage['ServicePackage']['package_name']); ?>&nbsp;</td>
		<td><?php echo h($servicePackage['ServicePackage']['description']); ?>&nbsp;</td>
		<td><?php echo h($servicePackage['ServicePackage']['amount']); ?>&nbsp;</td>
		<td><?php echo h($servicePackage['ServicePackage']['currency']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($servicePackage['Service']['service_name'], array('controller' => 'services', 'action' => 'view', $servicePackage['Service']['id'])); ?>
		</td>
		<td><?php echo h($servicePackage['ServicePackage']['is_blocked']); ?>&nbsp;</td>
		<td><?php echo h($servicePackage['ServicePackage']['is_deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $servicePackage['ServicePackage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $servicePackage['ServicePackage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $servicePackage['ServicePackage']['id']), array(), __('Are you sure you want to delete # %s?', $servicePackage['ServicePackage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Service Package'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
