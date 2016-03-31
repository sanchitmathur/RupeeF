<?php
	$config = Configure::read('RupeeForadian');
	//pr($config);
	//pr($cities);
	//pr($languages);
	//pr($service);
	
	//$service_id = isset($service['service_id'])?$service['service_id']:0;
	//$service_package_id = isset($service['service_package_id'])?$service['service_package_id']:0;
	
	$service = $this->Session->read('service');
	
	$service_ids = isset($service['service_ids'])?$service['service_ids']:0;
	$service_package_ids = isset($service['service_package_ids'])?$service['service_package_ids']:0;
	
?>
<script type="text/javascript">
	var redborder="border:1px solid red;";
	var normborder = "border:1px solid #126abf;";
	$(document).ready(function(){
		$("#login").bind('click',loginformvalidate);
		$(".fastName").bind('focusout',formfieldvalidate);
		
		$("#signup").bind('click',signupformvalidate);
		//$("#signupfrm .fastName").bind('focusout',formfieldvalidate);
	});
	
	function loginformvalidate(e){
		e.preventDefault();
		e.stopPropagation();
		var frmValidate=true;
		$.each($("#loginfrm .fastName"),function(i,item){
			var fldype = $(item).attr('type');
			var fldval = $(item).val();
			if (fldype=='email') {
				if (!isValidEmail(fldval)) {
					//imvalid
					frmValidate=false;
					$(item).attr('style',redborder);
				}
				else{
					$(item).attr('style',normborder);
				}
			}
			else{
				if (fldval.length==0 || fldval=='') {
					//invalid
					frmValidate=false;
					$(item).attr('style',redborder);
				}
				else{
					$(item).attr('style',normborder);
				}
			}
		});
		
		//form post sections
		if (frmValidate) {
			//post the form
			//alert("login form validate");
			$("#loginfrm").submit();
		}
		else{
			//alert("login form validate fail");
		}
	}
	
	function signupformvalidate(e){
		e.preventDefault();
		e.stopPropagation();
		
		var frmValidate=true;
		$.each($("#signupfrm .fastName"),function(i,item){
			var fldype = $(item).attr('type');
			var fldval = $(item).val();
			if (fldype=='email') {
				if (!isValidEmail(fldval)) {
					//imvalid
					frmValidate=false;
					$(item).attr('style',redborder);
				}
				else{
					$(item).attr('style',normborder);
				}
			}
			else if (fldype=='number') {
				if (!$.isNumeric(fldval) || fldval<=-1 ) {
					//invalid
					frmValidate=false;
					$(item).attr('style',redborder);
				}
				else{
					$(item).attr('style',normborder);
				}
			}
			else{
				if (fldval.length==0 || fldval=='' || fldval=='0') {
					//invalid
					frmValidate=false;
					$(item).attr('style',redborder);
				}
				else{
					$(item).attr('style',normborder);
				}
			}
		});
		
		//form post sections
		if (frmValidate) {
			//post the form
			//alert("form validate signup");
			$("#signupfrm").submit();
		}
		else{
			//alert("form validate signup faild");
		}
	}
	
	function formfieldvalidate(e) {
		var item = $(e.currentTarget);
		
		var fldype = $(item).attr('type');
		var fldval = $(item).val();
		if (fldype=='email') {
			if (!isValidEmail(fldval)) {
				//imvalid
				$(item).attr('style',redborder);
			}
			else{
				$(item).attr('style',normborder);
			}
		}
		else if (fldype=='number') {
			if (!$.isNumeric(fldval) || fldval<=-1 ) {
				//invalid
				$(item).attr('style',redborder);
			}
			else{
				$(item).attr('style',normborder);
			}
		}
		else{
			if (fldval.length==0 || fldval=='') {
				//invalid
				$(item).attr('style',redborder);
			}
			else{
				$(item).attr('style',normborder);
			}
		}
	}
	
	
	
	/*function formfieldvalidate(e) {
		var item = $(e.currentTarget);
		
		var fldype = $(item).attr('type');
		var fldval = $(item).val();
		if (fldype=='email') {
			if (!isValidEmail(fldval)) {
				//imvalid
				$(item).attr('style',redborder);
			}
			else{
				$(item).attr('style',normborder);
			}
		}
		else if (fldype=='number') {
			if (!$.isNumeric(fldval) || fldval<=-1 ) {
				//invalid
				$(item).attr('style',redborder);
			}
			else{
				$(item).attr('style',normborder);
			}
		}
		else{
			if (fldval.length==0 || fldval=='' || fldval=='0') {
				//invalid
				$(item).attr('style',redborder);
			}
			else{
				$(item).attr('style',normborder);
			}
		}
	}*/
	
	function isValidEmail(email){
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}
</script>
	<div class="allcommon_body">
		<div class="loginPage">
			<div class="container">
				<div class="row">
					<div class="col-md-12 service_body">
						<h1>Login / Sign up
							<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</span>
						</h1>
						<div class="login_body">
							<div class="col-md-6 left_login">
								<h3>Already a member ?<span> please log in here</span></h3>
								
								<?php
									echo $this->Form->create(array('action'=>'logIn','id'=>'loginfrm'));
								?>
									<input type="hidden" name="registration" value="1" />
									
									<input type="hidden" name="service_ids" value="<?=$service_ids?>" />
									
									<input type="hidden" name="service_package_ids" value="<?=$service_package_ids?>" />
									
									<input class="fastName" type="email" name="email" value="" placeHolder="Please Enter Email" />
									
									<input class="fastName" type="password" name="password" value="" placeHolder="Please Enter Password" />
								<?php
									$option = array(
										'label'=>'Next',
										'class'=>'next_button',
										'id'=>'login'
									);
									echo $this->Form->end($option);
								?>
								
								<div class="joinusing">
									<p>Or Joining using</p>
									<center>
										<a href="<?=$config['BaseUrl']?>Users/facebookLogIn/1">
											<img src="<?=$config['BaseUrl']?>img/fb_icon.png" class=""/>
										</a>
										<a href="<?=$config['BaseUrl']?>Users/googlePlusLogIn/1">
											<img src="<?=$config['BaseUrl']?>img/google_icon.png" class=""/>
										</a>
										<a href="javascript:void(0);">
											<img src="<?=$config['BaseUrl']?>img/card_icon.png" class=""/>
										</a>
									</center>
								</div>
							</div>

							<div class="col-md-6 rightlogin">
								<div class="ordive">
									<img src="<?=$config['BaseUrl']?>img/or_pic.png" class=""/>
								</div>
								<h3>New member ?<span> please sign up here</span></h3>
								
								<?php
									echo $this->Form->create(array('action'=>'signUp','id'=>'signupfrm'));
								?>
									<input type="hidden" name="registration" value="1" />
									
									<input type="hidden" name="service_ids" value="<?=$service_ids?>" />
									
									<input type="hidden" name="service_package_ids" value="<?=$service_package_ids?>" />
									
									<input class="fastName" type="text" name="name" value="" placeHolder="Please Enter Name" />
									
									<input class="fastName" type="email" name="email" value="" placeHolder="Please Enter Email" />
									
									<input class="fastName" type="password" name="password" value="" placeHolder="Please Enter Password" />
									
									<input class="fastName" type="password" name="confpassword" value="" placeHolder="Please Confirm Password" />
									
									<input class="fastName" type="number" name="phone_no" value="" placeHolder="Please Enter Phone No." />
									
									<!--<input class="fastName" type="text" name="address" value="" placeHolder="Please Enter Address" />-->
									<textarea class="fastName" name="address" rows="2" placeholder="Please Enter Address" ></textarea>
									
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
										'label'=>'Next',
										'class'=>'next_button',
										'id'=>'signup'
									);
									echo $this->Form->end($option);
								?>
							</div>
							<div class="crl"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
