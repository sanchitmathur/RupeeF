<div class="services index">
	<h2><?php echo __('Services'); ?></h2>
	<div class="actions" style="float: right;margin-top: -50px;min-width:20%;">
		<?php echo $this->Html->link(__('Add New Service'), array('action' => 'add')); ?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_name'); ?></th>
			<th><?php echo $this->Paginator->sort('service_description'); ?></th>
			<th><?php echo $this->Paginator->sort('releted_service_description'); ?></th>
			<th><?php echo $this->Paginator->sort('sub_service_id'); ?></th>
			<th><?php echo $this->Paginator->sort('show_in_footer'); ?></th>
			<th><?php echo $this->Paginator->sort('is_blocked'); ?></th>
			<!--<th><?php echo $this->Paginator->sort('is_deleted'); ?></th>-->
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($services as $service): ?>
	<tr>
		<td><?php echo h($service['Service']['id']); ?>&nbsp;</td>
		<td><?php echo h($service['Service']['service_name']); ?>&nbsp;</td>
		<td><?php echo substr(h($service['Service']['service_description']),0,400)."..."; ?>&nbsp;</td>
		<td><?php echo substr(h($service['Service']['releted_service_description']),0,300)."..."; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($service['SubService']['service_name'], array('controller' => 'sub_services', 'action' => 'view', $service['SubService']['id'])); ?>
		</td>
		<td><?php
			if(h($service['Service']['show_in_footer'])==1){
				echo $this->Html->link(__('Yes'),array('action'=>'shownidfooter',h($service['Service']['id']),0));
			}
			else{
				echo $this->Html->link(__('No'),array('action'=>'shownidfooter',h($service['Service']['id']),1));
			}
		?>&nbsp;</td>
		<td><?php 
			if(h($service['Service']['is_blocked'])==1){
				echo $this->Html->link(__('Yes'),array('action'=>'blockedservice',h($service['Service']['id']),0));
			}
			else{
				echo $this->Html->link(__('No'),array('action'=>'blockedservice',h($service['Service']['id']),1));
			}
		?>&nbsp;</td>
		<!--<td><?php echo h($service['Service']['is_deleted']); ?>&nbsp;</td>-->
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $service['Service']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $service['Service']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $service['Service']['id']), array(), __('Are you sure you want to delete # %s?', $service['Service']['id'])); ?>
			</br></br>
			<?php echo $this->Html->link(__('Document Need'), array('controller'=>'ServiceDocuments','action' => 'add', $service['Service']['id'])); ?>
			</br></br>
			<?php echo $this->Html->link(__('Related Services'), array('controller'=>'RelatedServices','action' => 'add', $service['Service']['id'])); ?>
			</br></br>
			<?php echo $this->Html->link(__('New Service Package'), array('controller'=>'service_packages','action' => 'add', $service['Service']['id'])); ?>
			</br></br>
			<?php echo $this->Html->link(__('Service Progress Step'), array('controller'=>'serviceProgresSteps','action' => 'add', $service['Service']['id'])); ?>
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
<!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Service'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sub Services'), array('controller' => 'sub_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Service'), array('controller' => 'sub_services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('controller' => 'service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package'), array('controller' => 'service_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->