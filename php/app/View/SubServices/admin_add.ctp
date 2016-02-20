<div class="subServices form">
<?php echo $this->Form->create('SubService'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Sub Service'); ?></legend>
	<?php
		echo $this->Form->input('service_name');
		echo $this->Form->input('main_service_id');
		echo $this->Form->input('is_blocked');
		echo $this->Form->input('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sub Services'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Main Services'), array('controller' => 'main_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Main Service'), array('controller' => 'main_services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
