<script type="text/javascript">
	$(document).ready(function(){
		$("#serviceid").bind('change',filtermenu);
	});
	function filtermenu(e) {
		$("#servicedocfrm").submit();
	}
</script>
<div class="cities index">
	<h2><?php echo __('Related Services'); ?></h2>
	<div class="actions" style="float: right;margin-top: -50px; min-width:25%;">
		<?php
			echo $this->Form->create('RelatedSerice',array('id'=>'servicedocfrm'));
			echo $this->Form->input('service_id',array('id'=>'serviceid','value'=>$serviceId));
			echo "</form>";
		?>
		<?php echo $this->Html->link(__('Add Service Related Service'), array('action' => 'add',$serviceId)); ?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_id'); ?></th>
			<th><?php echo $this->Paginator->sort('related_service_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($relatedServices as $relatedService): ?>
	<tr>
		<td><?php echo h($relatedService['RelatedService']['id']); ?>&nbsp;</td>
		<td><?php echo h($relatedService['Service']['service_name']); ?>&nbsp;</td>
		<td><?php echo h($relatedService['RelatedService']['related_service_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $city['City']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $city['City']['id']), array(), __('Are you sure you want to delete # %s?', $city['City']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New City'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
