<div class="careers form">
<?php echo $this->Form->create('Career'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Career Job'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('job_type');
		echo $this->Form->input('job_title');
		echo $this->Form->input('job_role');
		echo $this->Form->input('monthly_salary');
		echo $this->Form->input('city');
		echo $this->Form->input('job_description',array('type'=>'textarea'));
		echo $this->Form->input('vacancy');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>

</div>
