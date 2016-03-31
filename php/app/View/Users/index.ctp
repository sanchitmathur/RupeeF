<!--<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th><?php echo $this->Paginator->sort('is_blocked'); ?></th>
			<th><?php echo $this->Paginator->sort('is_deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['image']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['is_blocked']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['is_deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List User Service Packages'), array('controller' => 'user_service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Service Package'), array('controller' => 'user_service_packages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Services'), array('controller' => 'user_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Service'), array('controller' => 'user_services', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->
<!-- new section -->

<!-- user bye service section -->
<div class="col-sm-9">
	<div class="userPick">
		<h1>1. Private Limited Company</h1>
		
		<div class="delivery_track">
			<ol class="progtrckr" data-progtrckr-steps="5">
				<li class="progtrckr-done">Submit successfully</li>
				<li class="progtrckr-done">Document upload</li>
				<li class="progtrckr-todo">Document verified</li>
				<li class="progtrckr-todo">Sending</li>
				<li class="progtrckr-todo">Delivered</li>
			</ol>
		</div>
		
		<div class="">
			<h2>Documents Required for Registration</h2>
			<div class="col-sm-6 approveDiv">
				<ul>
					<li><i><img src="img/right.png" class="right"></i> PAN Card</li>
					<li><i><img src="img/right.png" class="right"></i> Identity Proof (Aadhar Card / Passport / Driving License)</li>
					<li><i><img src="img/right.png" class="right"></i> Passport Photo</li>
					<li><i><img src="img/right.png" class="right"></i> DSC Form Download Format</li>
					<li><i><img src="img/right.png" class="right"></i> Address Proof (Bank Statement / Telephone)</li>
				</ul>
			</div>
			<div class="col-sm-6 approveDiv">
				<ul>
					<li><i><img src="img/cross21.png" class="right"></i> PRent Agreement (Notarised: For rented property)</li>
					<li><i><img src="img/cross21.png" class="right"></i> Property (Director / Relative) - Registry Proof / House Tax </li>
					<li><i><img src="img/cross21.png" class="right"></i> Receipts (Notarised)</li>
					<li><i><img src="img/cross21.png" class="right"></i> Latest Electricity Bill</li>
					<li><i><img src="img/cross21.png" class="right"></i> NOC from the owner on the name of any director (Notarised)</li>
				</ul>
			</div>
			<div class="clr"></div>
		</div>
	</div>
</div>
<!-- bye service section end-->
<!-- new sugession section-->
<div class="col-sm-3 other_offer" style="padding-right:0;">
	<h1>Related service for you</h1>
	<div class="itemchuse_log">
		<h2>Tax Registrations</h2>
		<p>Shareholders are only liable for their share of money they invested in the company.</p>
		<h3>Rs. 500/- <span><a href="" style="color:#fff;"><i><img src="img/cart_icon3.png"></i> checkout</a></span></h3>
	</div>
	<div class="itemchuse_log ab1">
		<h2>Service Tax</h2>
		<p>Shareholders are only liable for their share of money they invested in the company.</p>
		<h3>Rs. 500/- <span><a href="" style="color:#fff;"><i><img src="img/cart_icon3.png"></i> checkout</a></span></h3>
	</div>
	<div class="itemchuse_log ab3">
		<h2>VAT or CST</h2>
		<p>Shareholders are only liable for their share of money they invested in the company.</p>
		<h3>Rs. 500/- <span><a href="" style="color:#fff;"><i><img src="img/cart_icon3.png"></i> checkout</a></span></h3>
	</div>
	<div class="itemchuse_log ab1">
		<h2>One Person Company</h2>
		<p>Shareholders are only liable for their share of money they invested in the company.</p>
		<h3>Rs. 500/- <span><a href="" style="color:#fff;"><i><img src="img/cart_icon3.png"></i> checkout</a></span></h3>
	</div>
</div>
<div class="clr"></div>
<!-- suggession section end-->
