<div class="serviceTaxes form">
<?php echo $this->Form->create('ServiceTax'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Service Tax'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('amount');
		echo $this->Form->input('type');
		echo $this->Form->input('is_active');
		echo $this->Form->input('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ServiceTax.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ServiceTax.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Service Taxes'), array('action' => 'index')); ?></li>
	</ul>
</div>
