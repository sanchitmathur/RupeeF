<?php
	$config = Configure::read('RupeeForadian');
	//pr($config);
	//pr($cities);
	//pr($languages);
	
?>

<div class="">
	<h3>Already a Member? Please Log In here.</h3>
	<?php
		echo $this->Form->create(array('action'=>'logIn'));
	?>
		<input class="form-control" type="email" name="email" value="" placeHolder="Please enter Email" />
		<input class="form-control" type="password" name="password" value="" placeHolder="Please enter Password" />
	<?php
		echo $this->Form->end(__('Log In'));
	?>
</div>
