<div class="services view">
<h2><?php echo __('Service'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($service['Service']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Name'); ?></dt>
		<dd>
			<?php echo h($service['Service']['service_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Description'); ?></dt>
		<dd>
			<?php echo h($service['Service']['service_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Releted Service Description'); ?></dt>
		<dd>
			<?php echo h($service['Service']['releted_service_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sub Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($service['SubService']['service_name'], array('controller' => 'sub_services', 'action' => 'view', $service['SubService']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Blocked'); ?></dt>
		<dd>
			<?php echo h($service['Service']['is_blocked']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($service['Service']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
	
	<div class="related">
		<h3><?php echo __('Service Packages'); ?></h3>
		<?php if (!empty($service['ServicePackage'])): ?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Package Name'); ?></th>
			<th><?php echo __('Description'); ?></th>
			<th><?php echo __('Amount'); ?></th>
			<th><?php echo __('Currency'); ?></th>
			<th><?php echo __('Service Id'); ?></th>
			<th><?php echo __('Is Blocked'); ?></th>
			<th><?php echo __('Is Deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($service['ServicePackage'] as $servicePackage): ?>
			<tr>
				<td><?php echo $servicePackage['id']; ?></td>
				<td><?php echo $servicePackage['package_name']; ?></td>
				<td><?php echo $servicePackage['description']; ?></td>
				<td><?php echo $servicePackage['amount']; ?></td>
				<td><?php echo $servicePackage['currency']; ?></td>
				<td><?php echo $servicePackage['service_id']; ?></td>
				<td><?php echo $servicePackage['is_blocked']; ?></td>
				<td><?php echo $servicePackage['is_deleted']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'service_packages', 'action' => 'view', $servicePackage['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'service_packages', 'action' => 'edit', $servicePackage['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'service_packages', 'action' => 'delete', $servicePackage['id']), array(), __('Are you sure you want to delete # %s?', $servicePackage['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	
	</div>

</div>

