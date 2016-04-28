<div class="askexpertcategories form">
<?php echo $this->Form->create('AskExpertCategory'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Ask Expert Category'); ?></legend>
	<?php
		echo $this->Form->input('category_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>
</div>
