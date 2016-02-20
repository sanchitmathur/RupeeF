<?php
	$config = Configure::read('RupeeForadian');
	//pr($config);
	//pr($cities);
	//pr($languages);
	
?>
<div class="">
	<h3>New Member? Please Sign Up here.</h3>
	<?php
		echo $this->Form->create(array('action'=>'signUp'));
	?>
		<input class="form-control" type="text" name="name" value="" placeHolder="Please enter Name" />
		<input class="form-control" type="email" name="email" value="" placeHolder="Please enter Email" />
		<input class="form-control" type="password" name="password" value="" placeHolder="Please enter Password" />
		<input class="form-control" type="password" name="confpassword" value="" placeHolder="Please confirm Password" />
		<input class="form-control" type="text" name="phone_no" value="" placeHolder="Please enter Phone No." />
		<input class="form-control" type="text" name="address" value="" placeHolder="Please enter Address" />
		<select class="form-control" name="city" >
			<option value="0">-- Select City --</option>
			<?php
				foreach($cities as $city_id=>$city_name){
			?>
				<option value="<?=$city_id?>"><?=$city_name?></option>
			<?php
				}
			?>
		</select>
		<select class="form-control" name="language" >
			<option value="0">-- Select Language --</option>
			<?php
				foreach($languages as $language_id=>$language_name){
			?>
				<option value="<?=$language_id?>"><?=$language_name?></option>
			<?php
				}
			?>

		</select>
	<?php
		echo $this->Form->end(__('Sign Up'));
	?>
</div>
