<?php

?>

<div class="table-responsive documentTable">
	<?php echo $this->Form->create('UserDocument',array('type'=>'file'));
		echo $this->Form->hidden('id');
		echo $this->Form->hidden('old_doc_name');
	?>	
	<table class="table table-striped">
	  <tbody>
		<tr>
		  <td>
				<?php echo $this->Form->input('document_type_id'); ?>
		  </td>
		</tr>
		<tr>
		  <td>
				<?php echo $this->Form->input('doc_name',array('type'=>'file')); ?>
		  </td>
		</tr>
		<tr>
				<td>
						<?php
						$options = array('label' => 'Upload', 'class' => 'ok', 'div' => false);
						echo $this->Form->end($options);?>
				</td>
		</tr>
	  </tbody>
	</table>
</div>