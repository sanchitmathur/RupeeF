<script type="text/javascript">
	$(document).ready(function(){
		$("#userchoose").bind('change',userchoosed);
	});
	function userchoosed(e){
		//$("#userFltFrm").submit();
	}
</script>
<div class="cities index">
	<h2><?php echo __('Ask Expert Questions'); ?></h2>
	<div class="actions" style="float: right;margin-top: -50px; min-width:42%;">
		
		<?php
			echo $this->Form->create('AskExpertCategory',array('id'=>'userFltFrm'));
			echo $this->Form->input('ask_expert_category_id',array('value'=>$categoryId,'id'=>'userchoose'));
			echo "</form>";
		?>
		<?php echo $this->Html->link(__('Add New Question'),array('action'=>'add'),array('style'=>'float:right; margin-top: -50px;'))?>
	</div>
	
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('ask_expert_catrgory_id'); ?></th>
			<th><?php echo $this->Paginator->sort('question'); ?></th>
			<th><?php echo $this->Paginator->sort('answer'); ?></th>
			<th><?php echo $this->Paginator->sort('is_blocked'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
		foreach ($askExperts as $askExpert): ?>
	<tr>
		<td><?php echo h($askExpert['AskExpert']['id']); ?>&nbsp;</td>
		<td><?php echo h($askExpert['AskExpertCategory']['category_name']); ?>&nbsp;</td>
		<td><?php echo h($askExpert['AskExpert']['question']);?>&nbsp;</td>
		<td><?php echo h($askExpert['AskExpert']['answer']);?>&nbsp;</td>
		<td><?php 
			if(h($askExpert['AskExpert']['is_blocked'])==1){
				echo "Yes";
			}
			else{
				echo "No";
			}
		?>&nbsp;</td>
		<td class="actions">
			
			<?php
				if(h($askExpert['AskExpert']['is_blocked'])==1){
					//
					echo $this->Html->link(__('Un Block'), array('action' => 'questionenable', $askExpert['AskExpert']['id'],0));
				}
				else{
					echo $this->Html->link(__('Block'), array('action' => 'questionenable', $askExpert['AskExpert']['id'],1));
				}	
			?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $askExpert['AskExpert']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $askExpert['AskExpert']['id']), array(), __('Are you sure you want to delete # %s?', $askExpert['AskExpert']['id'])); ?>
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
