<div>
	<?php
		if($success){
			echo $transid;
		}
	?>
	</br>
	</br>
	<?php echo $this->Html->link('DashBoard',array('controller'=>'Users','action'=>'index'));?>
</div>