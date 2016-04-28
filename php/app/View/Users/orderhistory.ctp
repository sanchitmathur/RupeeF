<?php
	//pr($serviceProcessprogresses);
	
	if(is_array($serviceProcessprogresses) && count($serviceProcessprogresses)>0){
		foreach($serviceProcessprogresses as $serviceProcessprogress){
			$status=0;
			$date="";
			$text="";
			$service_name="";
			$orderhistory_id = "0";
			if(isset($serviceProcessprogress['ServiceProcessProgress']) && count($serviceProcessprogress['ServiceProcessProgress'])>0){
				$status=$serviceProcessprogress['ServiceProcessProgress']['status'];
				$date = date($sitedatedisplayformat,strtotime($serviceProcessprogress['ServiceProcessProgress']['create_date']));
				$orderhistory_id =$serviceProcessprogress['ServiceProcessProgress']['id'];
			}
			
			if(isset($serviceProcessprogress['UserServicePackage']['Service']) && count($serviceProcessprogress['UserServicePackage']['Service'])>0){
				$service_name = $serviceProcessprogress['UserServicePackage']['Service']['service_name'];
			}
			
			switch($status){
				case 1:
					$text="";
					break;
				default:
					$text=$service_name." service is submitted";
					break;
			}
			
			$status = isset($serviceProgressStatus[$status])?$serviceProgressStatus[$status]:'';
			
			?>
			<div class="notifi_Text">
				<div class="col-md-2 col-xs-2 suced">
					<?php echo $this->Html->image('icon-checkmark.png',array('class'=>'ricon2'));?>
				</div>
				<div class="col-md-10 col-xs-10">
					<h2><?=$status?><span>on <?=$date?></span></h2>
					<p><?=$text?></p>
				</div>
				<?php echo $this->Html->link($this->Html->image('cross5.png',array('class'=>'cross_notifi')),array('action'=>'removeorderhistory',$orderhistory_id),array('escape'=>false),__('Are you sure, you want to delete ?'));?>
				<div class="clr"></div>
			</div>
			<?php
		}
	}
?>