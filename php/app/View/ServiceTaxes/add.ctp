<div class="serviceTaxes form">
<?php echo $this->Form->create('ServiceTax'); ?>
	<fieldset>
		<legend><?php echo __('Add Service Tax'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Service Taxes'), array('action' => 'index')); ?></li>
	</ul>
</div>
