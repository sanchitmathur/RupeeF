<div class="servicePackages view">
<h2><?php echo __('Service Package'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Package Name'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['package_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Currency'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($servicePackage['Service']['service_name'], array('controller' => 'services', 'action' => 'view', $servicePackage['Service']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Blocked'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['is_blocked']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Service Package'), array('action' => 'edit', $servicePackage['ServicePackage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Package'), array('action' => 'delete', $servicePackage['ServicePackage']['id']), array(), __('Are you sure you want to delete # %s?', $servicePackage['ServicePackage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
