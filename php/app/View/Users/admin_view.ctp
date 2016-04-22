<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($user['User']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Blocked'); ?></dt>
		<dd>
			<?php echo h($user['User']['is_blocked']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($user['User']['is_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
	</br></br></br>
	
	<div class="related">
		<h3><?php echo __('Related User Service Packages'); ?></h3>
		<?php if (!empty($user['UserServicePackage'])):
			//pr($user);
		?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<!--<th><?php echo __('Service Is'); ?></th>-->
			<th><?php echo __('Service Name'); ?></th>
			<!--<th><?php echo __('Service Package Id'); ?></th>-->
			<th><?php echo __('Package Name'); ?></th>
			<th><?php echo __('Description'); ?></th>
			<th><?php echo __('Amount'); ?></th>
			<th><?php echo __('Currency'); ?></th>
			<th><?php echo __('Purchase Datetime'); ?></th>
			<!--<th class="actions"><?php echo __('Actions'); ?></th>-->
		</tr>
		<?php foreach ($user['UserServicePackage'] as $userServicePackage): ?>
			<tr>
				<td><?php echo $userServicePackage['id']; ?></td>
				<!--<td><?php echo $userServicePackage['service_id']; ?></td>-->
				<td><?php echo (!empty($userServicePackage['Service']))?$userServicePackage['Service']['service_name']:''; ?></td>
				<!--<td><?php echo $userServicePackage['service_package_id']; ?></td>-->
				<td><?php echo $userServicePackage['package_name']; ?></td>
				<td><?php echo $userServicePackage['description']; ?></td>
				<td><?php echo number_format($userServicePackage['amount'],2); ?></td>
				<td><?php echo $userServicePackage['currency']; ?></td>
				<td><?php echo $userServicePackage['purchase_datetime']; ?></td>
				<!--<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'user_service_packages', 'action' => 'view', $userServicePackage['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_service_packages', 'action' => 'edit', $userServicePackage['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_service_packages', 'action' => 'delete', $userServicePackage['id']), array(), __('Are you sure you want to delete # %s?', $userServicePackage['id'])); ?>
				</td>-->
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	
	</div>
	</br></br></br>
	
	<div class="related">
		<h3><?php echo __('Related User Documents'); ?></h3>
		<?php if (!empty($user['UserDocument'])):
			$allowedimage = $this->allowedimageType;
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
		?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Document Type'); ?></th>
			<th><?php echo __('Document'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Upload Date'); ?></th>
			<!--<th class="actions"><?php echo __('Actions'); ?></th>-->
		</tr>
		<?php foreach ($user['UserDocument'] as $userDocument): ?>
			<tr>
				<td><?php echo $userDocument['id']; ?></td>
				<td><?php echo (!empty($userDocument['DocumentType']))?$userDocument['DocumentType']['name']:''; ?></td>
				<td><?php //echo $userDocument['doc_name'];
					$filename = h($userDocument['doc_name']);
			
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
				?></td>
				<td><?php 
					if(h($userDocument['doc_status'])==1){
						echo "Approved";
					}
					elseif(h($userDocument['doc_status'])==2){
						echo "Rejected";
					}
					else{
						echo "Not varified";
					}
				?></td>
				<td><?php echo $userDocument['createdate']; ?></td>
				<!--<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'user_documents', 'action' => 'view', $userDocument['id'])); ?>
				</td>-->
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	</div>
</div>

