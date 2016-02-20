<div class="serviceAdvantages form">
<?php echo $this->Form->create('ServiceAdvantage'); ?>
	<fieldset>
		<legend><?php echo __('Add Service Advantage'); ?></legend>
	<?php
		echo $this->Form->input('service_id');
		echo $this->Form->input('advantage_image');
		echo $this->Form->input('advantage_heading');
		echo $this->Form->input('advantage_description');
		echo $this->Form->input('is_blocked');
		echo $this->Form->input('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Service Advantages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
