<div class="userDocumets view">
<h2><?php echo __('User Documet'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userDocument['UserDocument']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Name'); ?></dt>
		<dd>
			<?php echo h($userDocument['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document Type'); ?></dt>
		<dd>
			<?php echo h($userDocument['DocumentType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Satus'); ?></dt>
		<dd>
			<?php
				if(h($userDocument['UserDocument']['doc_status'])==1){
					echo "Approved";
				}
				elseif(h($userDocument['UserDocument']['doc_status'])==2){
					echo "Rejected";
				}
				else{
					echo "Not varified";
				}
			?>
			&nbsp;
		</dd>
		<dt>File </dt>
		<dd><?php
			//$allowedimage = array('image/jpeg','image/png','image/jpg');
			
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
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
		?>
		</dd>
	</dl>
	</br>
	</br>
	<div class="actions">
		<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
	</div>
</div>


