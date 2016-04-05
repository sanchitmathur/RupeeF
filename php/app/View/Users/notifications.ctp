<?php
	//$evencls="notifi_Text2";
	if(is_array($notifications) && count($notifications)>0){
		$i=1;
		foreach($notifications as $notification){
			$evencls="";
			if($i%2==0){
				$evencls="notifi_Text2";
			}
			$dspldate = date("M d, Y",strtotime($notification['Notification']['notify_date']));
			$dspltxt=$notification['Notification']['notify_txt'];
			$dsplid = $notification['Notification']['id'];
		?>
		<div class="notifi_Text <?=$evencls?>">
			<div class="col-md-2 col-xs-2 rupeePICture">
				<?php echo $this->Html->image('ricon.png',array('class'=>'ricon'));?>
			</div>
			<div class="col-md-10 col-xs-10">
				<h2>Rupee foradian<span>on <?=$dspldate?></span></h2>
				<p><?=$dspltxt?></p>
			</div>
			<?php echo $this->Html->link($this->Html->image('cross5.png',array('class'=>'cross_notifi')),array('action'=>'notificationdelete',$dsplid),array('escape'=>false),__('Are you sure you want to delete ?'));?>
			<div class="clr"></div>
		</div>
		<?php
			$i++;
		}
	}
	else{
		?>
		<div class="notifi_Text">
			<div class="col-md-2 col-xs-2 rupeePICture">
				<?php echo $this->Html->image('ricon.png',array('class'=>'ricon'));?>
			</div>
			<div class="col-md-10 col-xs-10">
				<h2>Rupee foradian<span></span></h2>
				<p>No Notification for you</p>
			</div>
			<div class="clr"></div>
		</div>
		<?php
	}
?>

<!--
<div class="notifi_Text">
	<div class="col-md-2 col-xs-2 rupeePICture">
		<?php echo $this->Html->image('ricon.png',array('class'=>'ricon'));?>
	</div>
	<div class="col-md-10 col-xs-10">
		<h2>Rupee foradian<span>on March 19, 2016</span></h2>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of </p>
	</div>
	<?php echo $this->Html->link($this->Html->image('cross5.png',array('class'=>'cross_notifi')),array('url'=>'javascript:void(0)'),array('escape'=>false));?>
	<div class="clr"></div>
</div>

<div class="notifi_Text notifi_Text2">
	<div class="col-md-2 col-xs-2 rupeePICture">
		<?php echo $this->Html->image('ricon.png',array('class'=>'ricon'));?>
	</div>
	<div class="col-md-10 col-xs-10">
		<h2>Rupee foradian<span>on March 19, 2016</span></h2>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of </p>
	</div>
	<?php echo $this->Html->link($this->Html->image('cross5.png',array('class'=>'cross_notifi')),array('url'=>'javascript:void(0)'),array('escape'=>false));?>
	<div class="clr"></div>
</div>
-->