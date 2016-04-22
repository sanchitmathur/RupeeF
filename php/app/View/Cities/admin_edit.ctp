<div class="cities form">
<?php echo $this->Form->create('City'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit City'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('city_name');
		echo $this->Form->input('lati',array('label'=>'Latitude','id'=>'lat'));
		echo $this->Form->input('longi',array('label'=>'Longitude','id'=>'lon'));
		echo $this->Form->hidden('is_blocked',array('value'=>'0'));
		echo $this->Form->hidden('is_deleted',array('value'=>'0'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>
</div>
