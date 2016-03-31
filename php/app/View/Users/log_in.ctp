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
		$("#login").bind('click',loginformvalidate);
		$(".fastName").bind('focusout',formfieldvalidate);
	});
	function loginformvalidate(e){
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
			//alert("fom validate");
			$("#loginfrm").submit();
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
						<h1>Log In
							<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</span>
						</h1>
						<div class="login_body">
							<div class="col-md-3">
							</div>
							<div class="col-md-6 left_login">
								<h3>Already a member ?<span> please log in here</span></h3>
								<?php
									echo $this->Form->create(array('action'=>'logIn','id'=>'loginfrm'));
								?>
									<input class="fastName" type="email" name="email" value="" placeHolder="Please Enter Email" />
									
									<input class="fastName" type="password" name="password" value="" placeHolder="Please Enter Password" />
								<?php
									$option = array(
										'label'=>'Log In',
										'class'=>'next_button',
										'id'=>'login'
									);
									echo $this->Form->end($option);
								?>
								<div class="joinusing">
									<p>Or Joining using</p>
									<center>
										<a href="<?=$config['BaseUrl']?>Users/facebookLogIn/0">
											<img src="<?=$config['BaseUrl']?>img/fb_icon.png" class=""/>
										</a>
										<a href="<?=$config['BaseUrl']?>Users/googlePlusLogIn/0">
											<img src="<?=$config['BaseUrl']?>img/google_icon.png" class=""/>
										</a>
										<a href="javascript:void(0);">
											<img src="<?=$config['BaseUrl']?>img/card_icon.png" class=""/>
										</a>
									</center>
								</div>
							</div>
							<div class="col-md-3">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
