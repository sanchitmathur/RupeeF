<?php
	$config = Configure::read('RupeeForadian');
	//pr($config);
	//pr($cities);
	//pr($languages);
	
?>
	<div class="allcommon_body">
		<div class="loginPage">
			<div class="container">
				<div class="row">
					<div class="col-md-12 service_body">
						<h1>Sign Up
							<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</span>
						</h1>
						<div class="login_body">
							<div class="col-md-3">
							</div>
							<div class="col-md-6 left_login">
								<h3>New member ?<span> please sign up here</span></h3>
								<?php
									echo $this->Form->create(array('action'=>'signUp'));
								?>
									<input class="fastName" type="text" name="name" value="" placeHolder="Please enter Name" />
									
									<input class="fastName" type="email" name="email" value="" placeHolder="Please enter Email" />
									
									<input class="fastName" type="password" name="password" value="" placeHolder="Please enter Password" />
									
									<input class="fastName" type="password" name="confpassword" value="" placeHolder="Please confirm Password" />
									
									<input class="fastName" type="text" name="phone_no" value="" placeHolder="Please enter Phone No." />
									
									<input class="fastName" type="text" name="address" value="" placeHolder="Please enter Address" />
									
									<select class="fastName" name="city" >
										<option value="0">-- Select City --</option>
										<?php
											foreach($cities as $city_id=>$city_name){
										?>
											<option value="<?=$city_id?>"><?=$city_name?></option>
										<?php
											}
										?>
									</select>
									
									<select class="fastName" name="language" >
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
									$option = array(
										'label'=>'Sign Up',
										'class'=>'next_button',
									);
									echo $this->Form->end($option);
								?>
							</div>
							<div class="col-md-3">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
