<div class="askexpertcategories index">
	<h2><?php echo __('Ask Expert Categories'); ?></h2>
	<div class="actions" style="float: right;margin-top: -50px; min-width:22%;">
		<?php echo $this->Html->link(__('Add new Expert category'),array('action'=>'add'))?>
	</div>
	
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('category_name'); ?></th>
			<th><?php echo $this->Paginator->sort('is_blocked'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
		foreach ($askExpertCategories as $askExpertCategory): ?>
	<tr>
		<td><?php echo h($askExpertCategory['AskExpertCategory']['id']); ?>&nbsp;</td>
		<td><?php echo ucwords(h($askExpertCategory['AskExpertCategory']['category_name'])); ?>&nbsp;</td>
		<td><?php 
			if(h($askExpertCategory['AskExpertCategory']['is_blocked'])==1){
				echo "Yes";
			}
			else{
				echo "no";
			}
		?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action'=>'view',$askExpertCategory['AskExpertCategory']['id']));?>
			<?php
				if(h($askExpertCategory['AskExpertCategory']['is_blocked'])==1){
					//
					echo $this->Html->link(__('Un Block'), array('action' => 'askcatblocke', $askExpertCategory['AskExpertCategory']['id'],0));
				}
				else{
					echo $this->Html->link(__('Block'), array('action' => 'askcatblocke', $askExpertCategory['AskExpertCategory']['id'],1));
				}	
			?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $askExpertCategory['AskExpertCategory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $askExpertCategory['AskExpertCategory']['id']), array(), __('Are you sure you want to delete # %s?', $askExpertCategory['AskExpertCategory']['id'])); ?>
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
