<div class="servicePackages form">
<?php echo $this->Form->create('ServiceProgresStep'); ?>
	<fieldset>
		<legend><?php echo __('Admin Process Steps'); ?></legend>
	<?php
		echo $this->Form->input('service_id',array('value'=>$serviceId));
		//echo $this->Form->input('progress_step_id',array('multiple'=>true));
		if(is_array($progressSteps) && count($progressSteps)>0){
			$i=1;
			foreach($progressSteps as $progressStep_id=>$progressStep_name){
				?>
				<div>
					<span><input type="checkbox" name="data[ServiceProgresStep][progress_step_id][]" value="<?=$progressStep_id?>"> <?=$progressStep_name?></span>
					<label>Order</label>
					<input type="text" name="data[ServiceProgresStep][<?=$progressStep_id?>]" value="<?=$i?>" />
				</div>
				<?php
				$i++;
			}
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php
		if($serviceId>0){
			//echo $this->Html->link(__('Back'), array('controller'=>'Services','action' => 'index','admin'=>true));
		}
		else{
			//echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true));
		}
		echo $this->Html->link(__('Back'), array('controller'=>'Services','action' => 'index','admin'=>true));
	?>
</div>
</div>