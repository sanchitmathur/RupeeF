<?php
	$config = Configure::read('RupeeForadian');
	
	//pr($serviceData);
?>
<div class="col-md-6">
	<h2>Service Details</h2>
	<div>
		<?php
			$service_id = isset($serviceData['Service']['id'])?$serviceData['Service']['id']:0;
			$service_name = isset($serviceData['Service']['service_name'])?$serviceData['Service']['service_name']:"";
			$service_description = isset($serviceData['Service']['service_description'])?$serviceData['Service']['service_description']:"";
		?>
		<h3><?=$service_name?></h3>
		<p><?=$service_description?></p>
	</div>
</div>
<div class="col-md-6">
	<h2>Package Details</h2>
	<div>
		<?php
			$service_package_id = isset($serviceData['ServicePackage']['id'])?$serviceData['ServicePackage']['id']:0;
			$package_name = isset($serviceData['ServicePackage']['package_name'])?$serviceData['ServicePackage']['package_name']:"";
			$amount = isset($serviceData['ServicePackage']['amount'])?$serviceData['ServicePackage']['amount']:0;
			$currency = isset($serviceData['ServicePackage']['currency'])?$serviceData['ServicePackage']['currency']:"";
		?>
		<h3>Package Name : <?=$package_name?></h3>
		<h3>Amount : <?=$currency?> <?=number_format($amount,0,'',',')?></h3>
		<?php
			echo $this->Form->create(array('action'=>'saveToCart'));
		?>
			<input type="hidden" name="service_id" value="<?=$service_id?>" />
			<input type="hidden" name="service_package_id" value="<?=$service_package_id?>" />
		<?php
			echo $this->Form->end(__('Add To Cart'));
		?>
	</div>
</div>