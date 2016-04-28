<script type="text/javascript">
	$(document).ready(function(){
		$("#userchoose").bind('change',userchoosed);
	});
	function userchoosed(e){
		$("#userFltFrm").submit();
	}
</script>
<div class="cities index">
	<h2><?php echo __('User Documents'); ?></h2>
	<div class="actions" style="float: right;margin-top: -50px; min-width:22%;">
		<?php
			echo $this->Form->create('User',array('id'=>'userFltFrm'));
			echo $this->Form->input('user_id',array('value'=>$userId,'id'=>'userchoose'));
			echo "</form>";
		?>
	</div>
	
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('document_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('doc_name'); ?></th>
			<th><?php echo $this->Paginator->sort('doc_status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
		//pr($userDocuments);
		//$allowedimage = array('image/jpeg','image/png','image/jpg');
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		foreach ($userDocuments as $userDocument): ?>
	<tr>
		<td><?php echo h($userDocument['UserDocument']['id']); ?>&nbsp;</td>
		<td><?php echo h($userDocument['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($userDocument['DocumentType']['name']);?>&nbsp;</td>
		<td><?php
			//determind is a image or not
			$filename = h($userDocument['UserDocument']['doc_name']);
			
			if(in_array(finfo_file($finfo,$thumb_filepath.$filename),$allowedimage)){
				//valied image
				$fileurl = $thumb_fileurl.$filename;
				?>
				<img src="<?=$fileurl?>" />
				<?php
			}
			else{
				echo $filename;
			}
		?>&nbsp;</td>
		<td><?php 
			if(h($userDocument['UserDocument']['doc_status'])==1){
				echo "Approved";
			}
			elseif(h($userDocument['UserDocument']['doc_status'])==2){
				echo "Rejected";
			}
			else{
				echo "Not varified";
			}
		?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action'=>'view',$userDocument['UserDocument']['id']));?>
			<?php
				if(h($userDocument['UserDocument']['doc_status'])==1){
					//
					echo $this->Html->link(__('Reject'), array('action' => 'docacceptreject', $userDocument['UserDocument']['id'],2));
				}
				elseif(h($userDocument['UserDocument']['doc_status'])==2){
					//
				}
				else{
					echo $this->Html->link(__('Approve'), array('action' => 'docacceptreject', $userDocument['UserDocument']['id'],1));
					echo $this->Html->link(__('Reject'), array('action' => 'docacceptreject', $userDocument['UserDocument']['id'],2));
				}	
			?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $userDocument['UserDocument']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userDocument['UserDocument']['id']), array(), __('Are you sure you want to delete # %s?', $userDocument['UserDocument']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
