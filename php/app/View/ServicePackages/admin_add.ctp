<?php
	$currencies=array(
		'INR'=>'INR'
	);
?>
<div class="servicePackages form">
<?php echo $this->Form->create('ServicePackage'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Service Package'); ?></legend>
	<?php
		echo $this->Form->input('service_id');
		echo $this->Form->input('package_name');
		echo $this->Form->input('description');
		echo $this->Form->input('amount');
		echo $this->Form->input('currency',array('options'=>$currencies));
		
		echo $this->Form->hidden('is_blocked',array('value'=>'0'));
		echo $this->Form->hidden('is_deleted',array('value'=>'0'));
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

		<li><?php echo $this->Html->link(__('List Service Packages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->