<!--<form action="<?php echo $action; ?>" method="post" name="payuForm">
<div>


<?php echo $this->Form->create(array('action'=>'payupaymentsecondstep'));?>

  <input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>"/>
  <input type="hidden" name="trnsid" value="<?php echo (empty($posted['trnsid'])) ? '' : $posted['trnsid'] ?>"/>
  <table>
	<tr>
	  <td style="width:180px;">Amount: </td>
	  <td><input name="amounts" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" disabled="disabled" class="inputfrom" /></td>
	  
	</tr>
	<tr>
		<td>Name: </td>
	  <td><input name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname'] ?>" class="inputfrom" /></td>
	</tr>
	<tr>
	  <td>Email: </td>
	  <td><input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email'] ?>" class="inputfrom" /></td>
	  
	</tr>
	<tr>
	<td>Phone: </td>
	  <td><input name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone'] ?>" class="inputfrom" /></td>
	</tr>
	<tr>
	  <td>Product Info: </td>
	  <td><textarea name="productinfod" disabled="disabled" rows="5" class="inputfrom"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea></td>
	</tr>
	
	<tr>
		<td></td>
		<td><input type="submit" value="Submit" class="send_button" />
		
		<?php echo $this->Html->link(__('Cancel'),array('controller'=>'UserCarts','action'=>'index'));?>
		</td>
	</tr>
  </table>
</form>
</div>
-->