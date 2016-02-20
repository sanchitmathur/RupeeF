<div class="serviceTaxes view">
<h2><?php echo __('Service Tax'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($serviceTax['ServiceTax']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($serviceTax['ServiceTax']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($serviceTax['ServiceTax']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($serviceTax['ServiceTax']['is_active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($serviceTax['ServiceTax']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Service Tax'), array('action' => 'edit', $serviceTax['ServiceTax']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Tax'), array('action' => 'delete', $serviceTax['ServiceTax']['id']), array(), __('Are you sure you want to delete # %s?', $serviceTax['ServiceTax']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Taxes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Tax'), array('action' => 'add')); ?> </li>
	</ul>
</div>
