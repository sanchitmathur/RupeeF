<div class="users form">
<?php echo $this->Form->create('User',array('type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Admin Upload Document'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('document_type_id');
		echo $this->Form->input('image',array('type'=>'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'view',$userId,'admin'=>true)); ?>
</div>
</div>
