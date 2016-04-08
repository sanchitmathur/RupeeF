<div class="servicePackages form">
<?php echo $this->Form->create('Communication'); ?>
	<fieldset>
		<legend><?php echo __('Admin Communication'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>
</div>