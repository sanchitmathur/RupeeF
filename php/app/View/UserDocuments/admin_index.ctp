<div class="cities index">
	<h2><?php echo __('User Documents'); ?></h2>
	<!--<div class="actions" style="float: right;margin-top: -50px; min-width:22%;">
		<?php echo $this->Html->link(__('Add New Document Type'), array('action' => 'add')); ?>
	</div>-->
	
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
	<?php foreach ($userDocuments as $userDocument): ?>
	<tr>
		<td><?php echo h($userDocument['UserDocument']['id']); ?>&nbsp;</td>
		<td><?php echo h($userDocument['UserDocument']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($userDocument['UserDocument']['document_type_id']); ?>&nbsp;</td>
		<td><?php echo h($userDocument['UserDocument']['doc_name']); ?>&nbsp;</td>
		<td><?php echo (h($userDocument['UserDocument']['doc_status'])==1)?"Yes":"No"; ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $documentType['DocumentType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $documentType['DocumentType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $documentType['DocumentType']['id']), array(), __('Are you sure you want to delete # %s?', $documentType['DocumentType']['id'])); ?>
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
