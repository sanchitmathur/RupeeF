
<div class="docADD">
		<h3>
			<?php
			echo $this->Html->link(__('<i class="fa fa-plus-circle plus"></i> Add Document'),
			array('controller'=>'Users','action'=>'documentupload'),
			array('escape'=>false));
			?>
		</h3>
</div>

<div class="table-responsive documentTable">
	<table class="table table-striped">
	  <thead>
		<tr>
		  <th style="width:290px;">Document Name</th>
		  <th>Document Status</th>
		  <th style="width:140px;">Action</th>
		</tr>
	  </thead>
	
	  <tbody>
		<?php
			//pr($userdocumens);
			
			if(is_array($userdocumens) && count($userdocumens)>0){
				foreach($userdocumens as $userdocumen){
					$documenttypename=ucwords($userdocumen['DocumentType']['name']);
					$doc_name= $userdocumen['UserDocument']['doc_name'];
					$stscla="";
					$is_user_provide = isset($userdocumen['DocumentType']['is_user_provide'])?$userdocumen['DocumentType']['is_user_provide']:'1';
					
					if($userdocumen['UserDocument']['doc_status']=='1'){
						$docstatus="Approved";
						$stscla="app";
					}
					elseif($userdocumen['UserDocument']['doc_status']=='2'){
						$docstatus="Rejected";
						$stscla="reg";
					}
					else{
						$docstatus="Not decieded";
					}
					
					$docid=$userdocumen['UserDocument']['id'];
					
					if($is_user_provide==0){
						$docstatus="Admin Uploaded";
						$stscla="app";
					}
				?>
					<tr>
						<td>
						      <i>
						      <?php //echo $this->Html->image('userPic.png',array('class'=>'panimg'));?>
						      </i>
						      <?=$documenttypename?>
						</td>
						<td>
						      <a href="javascript:void(0)" class="<?=$stscla?>"><?=$docstatus?></a>
						</td>
						<td>
						      <?php
								if($is_user_provide==0){
									echo $this->Html->link($this->Html->image('download.png',array('class'=>'downEdit')),array('controller'=>'users','action'=>'downloaddoc',$doc_name),array('escape'=>false));
								}
							?>
						      <?php echo $this->Html->link($this->Html->image('edit.png',array('class'=>'downEdit')),array('controller'=>'users','action'=>'documentupload',$docid),array('escape'=>false));?>
						      <?php echo $this->Html->link($this->Html->image('delite.png',array('class'=>'downEdit')),array('controller'=>'users','action'=>'deletedoc',$docid),array('escape'=>false),__('Are you sure you want to delete ?'));?>
						</td>
					</tr>
				<?php
				}
			}
			else{
				?>
				<tr>
					<td colspan="3">Document not found</td>
				</tr>
				<?php
			}
		?>
		<!--
		<tr>
		  <td>
			<i>
			<?php //echo $this->Html->image('userPic.png',array('class'=>'panimg'));?>
			</i>
			Pan Card
		  </td>
		  <td>30.03.2016</td>
		  <td>
			<a href="javascript:void(0)" class="app">Approved</a> 
			<a href="javascript:void(0)" class="">Rejected</a>
		  </td>
		  <td>
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
		-->
	  </tbody>
	</table>
</div>