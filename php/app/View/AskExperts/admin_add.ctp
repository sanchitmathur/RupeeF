<div class="askexperts form">
<?php echo $this->Form->create('AskExpert'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Ask Expert'); ?></legend>
	<?php
		echo $this->Form->input('ask_expert_category_id');
		echo $this->Form->input('question',array('required'=>true));
		echo $this->Form->input('answer',array('required'=>true));
		echo $this->Form->hidden('is_blocked',array('value'=>'0'));
		echo $this->Form->hidden('is_deleted',array('value'=>'0'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>
</div>
