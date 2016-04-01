<?php

?>
<div class="docADD">
		<h3>
			<a href="javascript:void(0)">
				<i class="fa fa-plus-circle plus"></i> 
				Add Document
			</a>
		</h3>
</div>
<div class="table-responsive documentTable">
	<table class="table table-striped">
	  <thead>
		<tr>
		  <th style="width:290px;">Document Name</th>
		  <th>Dare</th>
		  <th>Document Status</th>
		  <th style="width:140px;">Action</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
		  <td>
			<i><!--<img src="img/userPic.png" class="panimg">-->
			<?php echo $this->Html->image('userPic.png',array('class'=>'panimg'));?>
			</i>
			Pan Card
		  </td>
		  <td>30.03.2016</td>
		  <td>
			<a href="javascript:void(0)" class="app">Approved</a> 
			<a href="javascript:void(0)" class="">Rejected</a>
		  </td>
		  <td>
			<!--<a href="javascript:void(0)"><img src="img/download.png" class="downEdit"></a>
			<a href="javascript:void(0)"><img src="img/edit.png" class="downEdit"></a>
			<a href="javascript:void(0)"><img src="img/delite.png" class="downEdit"></a>-->
			
			<?php echo $this->Html->link($this->Html->image('download.png',array('class'=>'downEdit')),array('controller'=>'users','action'=>'downloaddoc'),array('escape'=>false));?>
			<?php echo $this->Html->link($this->Html->image('edit.png',array('class'=>'downEdit')),array('controller'=>'users','action'=>'editedocument'),array('escape'=>false));?>
			<?php echo $this->Html->link($this->Html->image('delite.png',array('class'=>'downEdit')),array('controller'=>'users','action'=>'deletedoc'),array('escape'=>false));?>
		  </td>
		</tr>
		<tr>
		  <td>
			<i><?php echo $this->Html->image('userPic.png',array('class'=>'panimg'));?></i>
			Pan Card
		  </td>
		  <td>30.03.2016</td>
		  <td>
			<a href="javascript:void(0)" class="">Approved</a> 
			<a href="javascript:void(0)" class="reg">Rejected</a>
		  </td>
		  <td>
			<?php echo $this->Html->link($this->Html->image('download.png',array('class'=>'downEdit')),array('controller'=>'users','action'=>'downloaddoc'),array('escape'=>false));?>
			<?php echo $this->Html->link($this->Html->image('edit.png',array('class'=>'downEdit')),array('controller'=>'users','action'=>'editedocument'),array('escape'=>false));?>
			<?php echo $this->Html->link($this->Html->image('delite.png',array('class'=>'downEdit')),array('controller'=>'users','action'=>'deletedoc'),array('escape'=>false));?>
		  </td>
		</tr>
		
	  </tbody>
	</table>
</div>