<div class="mainServices form">
<?php echo $this->Form->create('MainService'); ?>
	<fieldset>
		<legend><?php echo __('Add Main Service'); ?></legend>
	<?php
		echo $this->Form->input('service_name');
		echo $this->Form->input('is_blocked');
		echo $this->Form->input('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Main Services'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Sub Services'), array('controller' => 'sub_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Service'), array('controller' => 'sub_services', 'action' => 'add')); ?> </li>
	</ul>
</div>
