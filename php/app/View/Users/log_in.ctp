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
						<h1>Log In
							<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</span>
						</h1>
						<div class="login_body">
							<div class="col-md-3">
							</div>
							<div class="col-md-6 left_login">
								<h3>New member ?<span> please sign up here</span></h3>
								<?php
									echo $this->Form->create(array('action'=>'logIn'));
								?>
									<input class="fastName" type="email" name="email" value="" placeHolder="Please Enter Email" />
									
									<input class="fastName" type="password" name="password" value="" placeHolder="Please Enter Password" />
								<?php
									$option = array(
										'label'=>'Log In',
										'class'=>'next_button',
									);
									echo $this->Form->end($option);
								?>
								<div class="joinusing">
									<p>Or Joining using</p>
									<center>
										<a href="javascript:void(0);">
											<img src="<?=$config['BaseUrl']?>img/fb_icon.png" class=""/>
										</a>
										<a href="javascript:void(0);">
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
