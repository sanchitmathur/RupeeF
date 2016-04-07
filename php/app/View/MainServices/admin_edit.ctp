<div class="mainServices form">
<?php echo $this->Form->create('MainService'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Main Service'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('service_name');
		echo $this->Form->hidden('is_blocked');
		echo $this->Form->hidden('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>
</div>
<!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MainService.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('MainService.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Main Services'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Sub Services'), array('controller' => 'sub_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Service'), array('controller' => 'sub_services', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->