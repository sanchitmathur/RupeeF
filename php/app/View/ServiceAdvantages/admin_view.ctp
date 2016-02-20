<div class="serviceAdvantages view">
<h2><?php echo __('Service Advantage'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($serviceAdvantage['ServiceAdvantage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($serviceAdvantage['Service']['service_name'], array('controller' => 'services', 'action' => 'view', $serviceAdvantage['Service']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Advantage Image'); ?></dt>
		<dd>
			<?php echo h($serviceAdvantage['ServiceAdvantage']['advantage_image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Advantage Heading'); ?></dt>
		<dd>
			<?php echo h($serviceAdvantage['ServiceAdvantage']['advantage_heading']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Advantage Description'); ?></dt>
		<dd>
			<?php echo h($serviceAdvantage['ServiceAdvantage']['advantage_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Blocked'); ?></dt>
		<dd>
			<?php echo h($serviceAdvantage['ServiceAdvantage']['is_blocked']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($serviceAdvantage['ServiceAdvantage']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Service Advantage'), array('action' => 'edit', $serviceAdvantage['ServiceAdvantage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Advantage'), array('action' => 'delete', $serviceAdvantage['ServiceAdvantage']['id']), array(), __('Are you sure you want to delete # %s?', $serviceAdvantage['ServiceAdvantage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Advantages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Advantage'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
