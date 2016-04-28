<div class="cities form">
<?php echo $this->Form->create('Notification'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Notification'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('notify_txt',array('type'=>'textarea'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php //echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>
</div>
