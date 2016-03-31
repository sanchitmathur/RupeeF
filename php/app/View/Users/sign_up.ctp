<?php
	$config = Configure::read('RupeeForadian');
	//pr($config);
	//pr($cities);
	//pr($languages);
	
?>
<script type="text/javascript">
	var redborder="border:1px solid red;";
	var normborder = "border:1px solid #126abf;";
	$(document).ready(function(){
		$("#signup").bind('click',signupformvalidate);
		$(".fastName").bind('focusout',formfieldvalidate);
	});
	function signupformvalidate(e){
		e.preventDefault();
		e.stopPropagation();
		
		var frmValidate=true;
		$.each($(".fastName"),function(i,item){
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
			//alert("fom validate");
			$("#signupfrm").submit();
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
			if (fldval.length==0 || fldval=='' || fldval=='0') {
				//invalid
				$(item).attr('style',redborder);
			}
			else{
				$(item).attr('style',normborder);
			}
		}
	}
	
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
						<h1>Sign Up
							<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</span>
						</h1>
						<div class="login_body">
							<div class="col-md-3">
							</div>
							<div class="col-md-6 left_login">
								<h3>New member ?<span> please sign up here</span></h3>
								<?php
									echo $this->Form->create(array('action'=>'signUp','id'=>'signupfrm'));
								?>
									<input class="fastName" type="text" name="name" value="" placeHolder="Please enter Name" />
									
									<input class="fastName" type="email" name="email" value="" placeHolder="Please enter Email" />
									
									<input class="fastName" type="password" name="password" value="" placeHolder="Please enter Password" />
									
									<input class="fastName" type="password" name="confpassword" value="" placeHolder="Please confirm Password" />
									
									<input class="fastName" type="number" name="phone_no" value="" placeHolder="Please enter Phone No." />
									
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
										'id'=>'signup'
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
