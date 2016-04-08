<script type="text/javascript">
	$(document).ready(function(){
		$("#userId").bind('change',chooseServices);
	});
	function chooseServices(e){
		$("#userfrm").submit();
	}
</script>
<?php
	//pr($communications);
?>
<div class="servicePackages index">
	<h2><?php echo __('User Communications'); ?></h2>
	<div class="actions" style="float: right;margin-top: -50px; min-width:25% !important;">
		<?php
			echo $this->Form->create('User',array('id'=>'userfrm'));
			echo $this->Form->input('user_id',array('value'=>$userId,'id'=>'userId'));
		?>
		<?php echo $this->Html->link(__('Add New Communication'), array('action' => 'add',$userId)); ?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('message'); ?></th>
			<th><?php echo $this->Paginator->sort('create_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($communications as $communication): ?>
	<tr>
		<td><?php echo h($communication['Communication']['id']); ?>&nbsp;</td>
		<td><?php
			if($communication['Communication']['is_user_post']){
				echo h($communication['User']['name']);
			}
			else{
				echo "Admin user";
			}
			 ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['message']); ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['create_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Reply'), array('action' => 'add', $communication['Communication']['reciever_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $communication['Communication']['id']), array(), __('Are you sure you want to delete # %s?', $communication['Communication']['id'])); ?>
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