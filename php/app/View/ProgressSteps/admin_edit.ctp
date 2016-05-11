<div class="progresssteps form">
<?php echo $this->Form->create('ProgressStep'); ?>
	<fieldset>
		<legend><?php echo __('Add progress Step'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->hidden('is_deleted',array('value'=>'0'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>
</div>
