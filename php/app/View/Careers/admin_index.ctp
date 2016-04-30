<div class="careers index">
	<h2><?php echo __('Careers'); ?></h2>
	<div class="actions" style="float: right;margin-top: -50px; min-width:22%;">
		<?php echo $this->Html->link(__('Add New Job'),array('action'=>'add'));?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('job_type'); ?></th>
			<th><?php echo $this->Paginator->sort('job_title'); ?></th>
			<th><?php echo $this->Paginator->sort('job_role'); ?></th>
			<th><?php echo $this->Paginator->sort('monthly_salary'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('job_description'); ?></th>
			<th><?php echo $this->Paginator->sort('vacancy'); ?></th>
			<th><?php echo $this->Paginator->sort('create_date'); ?></th>
			<th><?php echo $this->Paginator->sort('applicant'); ?></th>
			<th><?php echo $this->Paginator->sort('is_blocked'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($careers as $career): ?>
	<tr>
		<td><?php echo h($career['Career']['id']); ?>&nbsp;</td>
		<td><?php //echo h($career['Career']['job_type']);
			echo (isset($jobtypes[$career['Career']['job_type']]))?$jobtypes[$career['Career']['job_type']]:'';
		?>&nbsp;</td>
		<td><?php echo h($career['Career']['job_title']); ?>&nbsp;</td>
		<td><?php echo h($career['Career']['job_role']); ?>&nbsp;</td>
		<td><?php echo h($career['Career']['monthly_salary']); ?>&nbsp;</td>
		<td><?php echo h($career['Career']['city']); ?>&nbsp;</td>
		<td><?php echo h($career['Career']['job_description']); ?>&nbsp;</td>
		<td><?php echo h($career['Career']['vacancy']); ?>&nbsp;</td>
		<td><?php echo h($career['Career']['create_date']); ?>&nbsp;</td>
		<td><?php echo h($career['Career']['applicant']); ?>&nbsp;</td>
		<td><?php echo (h($career['Career']['is_blocked'])==1)?"Yes":"No"; ?>&nbsp;</td>
		<td class="actions">
			<?php
				if($career['Career']['is_blocked']==1){
					echo $this->Html->link(__('Un Block'),array('action'=>'blockunblock',$career['Career']['id'],0));
				}
				else{
					echo $this->Html->link(__('Block'),array('action'=>'blockunblock',$career['Career']['id'],1));
				}
			?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $career['Career']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $career['Career']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $career['Career']['id']), array(), __('Are you sure you want to delete # %s?', $career['Career']['id'])); ?>
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