<div class="cities form">
<?php echo $this->Form->create('RelatedService'); ?>
	<fieldset>
		<legend><?php echo __('Add Related Services'); ?></legend>
	<?php
		echo $this->Form->input('service_id');
		echo $this->Form->input('other_service_id',array('multiple'=>true,'value'=>$prevsavedserviceids));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>
</div>

