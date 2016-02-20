<?php
	$config = Configure::read('RupeeForadian');
	//pr($config);
	$cartItemNo = $this->Session->read('cartItemNo');
?>
<script type="text/javascript">
	var divWidth = 100;
	var baseUrl = '<?=$config['BaseUrl']?>';
	var animiTimer;
	$(document).ready(function(){
		$('.scrolLogo').attr('style','margin-left:35px;');
	});
	
	$(window).scroll(function(){
		//alert('scrolled');
		var scrollTop = $(window).scrollTop();
		//$('#scrollTop').html(scrollTop);
		//console.log('scrollTop : '+scrollTop);
		if(scrollTop < 114){
			//$('.header_all').fadeOut(300);
			//$('.header_all').attr('style','height:151px');
			
			// $('.scrolLogo').attr('style','width:100% !important');
			// clearInterval(animiTimer);
			// animiTimer = setInterval(headerExpandAnimation, 300);
			
			$('.scrolLogo').animate(
				{marginLeft:'35px'},
				100,
				function(){
					src = baseUrl+'/img/logo.png';
					$('#logoIcon').attr('src',src);
				}
			);
			$('.scroll_menu').animate(
				{marginTop:'0px'},
				100,
				function(){}
			);
			$('.header_all').animate(
				{height:'151px'},
				100,
				function(){}
			);
		}else{
			//$('.scrolLogo').attr('style','width:9% !important');
			// clearInterval(animiTimer);
			// animiTimer = setInterval(headerCollapsAnimation, 300);
			
			//$('.header_all').attr('style','height:103px');
			//$('.header_all').fadeIn(300);
			
			$('.scroll_menu').animate(
				{marginTop:'-60px'},
				100,
				function(){}
			);
			$('.scrolLogo').animate(
				{marginLeft:'-300px'},
				100,
				function(){
					src = baseUrl+'/img/logo_sm.png';
					$('#logoIcon').attr('src',src);
				}
			);
			$('.header_all').animate(
				{height:'103px'},
				100,
				function(){}
			);
		}
	});
	
	function headerCollapsAnimation(){
		console.log('divWidth : '+divWidth);
		divWidth--;
		if(divWidth <= 8){
			clearInterval(animiTimer);
		}else{
			//$('.scrolLogo').attr('style','width:'+divWidth+'% !important');
			$('.scrolLogo').attr('style','margin-left:-300px');
		}
	}
	
	function headerExpandAnimation(){
		console.log('divWidth : '+divWidth);
		divWidth++;
		if(divWidth >= 100){
			clearInterval(animiTimer);
		}else{
			//$('.scrolLogo').attr('style','width:'+divWidth+'% !important');
			$('.scrolLogo').attr('style','margin-left:40px');
		}
	}
	
</script>
<!--<div class="col-md-12">
	<div class="col-md-2">
		<p>MENU</p>
	</div>
	<div class="col-md-8">
		<h3><a href="<?=$config['BaseUrl']?>">Rupee Foradian</a></h3>
	</div>
	<?php
		$user = $this->Session->read('user');
		$user_id = isset($user['user_id'])?$user['user_id']:0;
		$user_name = isset($user['name'])?$user['name']:"";
		if($user_id != 0){
	?>
		<div class="col-md-2" style="padding:20px 15px;">
			<p>Welcome <?=ucwords($user_name)?> | 
				<span>
					<a href="<?=$config['BaseUrl']?>Users/logout">Logout</a>
				</span>
			</p>
			<div class="cart_class">
				<a href="<?=$config['BaseUrl']?>UserCarts">Cart <?=$cartItemNo?></a>
			</div>
		</div>
	<?php
		}else{
	?>
		<div class="col-md-2" style="padding:20px 15px;">
			<a href="<?=$config['BaseUrl']?>Users/logIn">Log In</a> | 
			<a href="<?=$config['BaseUrl']?>Users/signUp">Sign Up</a>
		</div>
	<?php
		}
	?>
</div>-->
	<div class="main_header ">
	
		<div class="sideMenu" style="display:none;">
			<div class="close_div">
				<a href="javascript:void(0);">
					<img src="<?=$config['BaseUrl']?>img/cross_icon.png" class=""/>
				</a>
				<a href="<?=$config['BaseUrl']?>Users/logIn" class="side_login">Login</a>
				<div class="clr"></div>
				<center>
					<!--<input value="Sign up" id="btnsubmit" class="send_button" type="submit">-->
					<a href="<?=$config['BaseUrl']?>Users/signUp" class="send_button">Sign Up</a>
				</center>
			</div>
			<div class="close_menu">
				<ul>
					<li><a href="javascript:void(0);">Home</a></li>
					<li><a href="javascript:void(0);">our services</a></li>
					<li><a href="javascript:void(0);">our cities</a></li>
					<li><a href="javascript:void(0);">be a business partner</a></li>
					<li><a href="javascript:void(0);">mobile app features</a></li>
					<li><a href="javascript:void(0);">safety / confidentiality</a></li>
					<li><a href="javascript:void(0);">cfo</a></li>
					<li><a href="javascript:void(0);">about us</a></li>
					<li><a href="javascript:void(0);">Careers</a></li>
					<li><a href="javascript:void(0);">legal terms & conditions</a></li>
					<li><a href="javascript:void(0);">News room</a></li>
				</ul>
			</div>
			<div class="playstore_icon">
				<center>
					<a href="javascript:void(0);"><img src="<?=$config['BaseUrl']?>img/apple_icon.png" class=""/></a>
					<a href="javascript:void(0);"><img src="<?=$config['BaseUrl']?>img/android_icon.png" class=""/></a>
					<a href="javascript:void(0);"><img src="<?=$config['BaseUrl']?>img/windows_icon.png" class=""/></a>
				</center>
			</div>
		</div>
		
		<div class="childSub_menu" style="display:none;">
			<div class="col-md-6 left_child">
				<div class="cancle_div2">
					<a href="javascript:void(0);">
						<img src="<?=$config['BaseUrl']?>img/cross.png" class=""/>
					</a>
				</div>
				<h2>Individual</h2>
				<ul>
					<li><a href="javascript:void(0);" class="active">Indian National</a></li>
					<li><a href="javascript:void(0);">Foreign</a></li>
					<li><a href="javascript:void(0);">NRI</a></li>
				</ul>
			</div>
			<div class="col-md-6 right_child">
				<h4>Are you a Foreign National or Indian National?</h4>
				<p>Integer ornare ante elit, a viverra est laoreet sit amet. Morbi euismod et dolor sit amet scelerisque. Vivamus utvulputate quam, a feugiat massa.Vivamus ut vulputate quam, a feugiat massa. Vestibulum ut ante sed nisl consectetur consectetur interdum vel nulla.</p>
				
				<input value="View More" id="" class="view_button" type="submit">
			</div>
			<div class="clr"></div>
		</div>
		
		<nav role="navigation" class="navbar navbar-default headerinn">
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<div class="uperHeader">
					<div class="col-sm-2 LeftNewmenu">
						<a href="javascript:void(0)" class="navbar-brand navbrand">
							<img src="<?=$config['BaseUrl']?>img/menuicon.png" class="menuIcon"/> Menu
						</a>
					</div>
					<div class="col-sm-8 scrol_body">
						<div class="col-sm-2 scrolLogo">
							<div class="main_logo_div">
								<a href="<?=$config['BaseUrl']?>" class="navbar-brand navbrand" style="padding:0;">
									<img src="<?=$config['BaseUrl']?>img/logo.png" class="logoicon" id="logoIcon"/>
								</a>
							</div>
						</div>
						<div class="col-sm-10 scroll_menu" style="padding-right:0;">
							<div class="desktop_menu">
							<ul class="nav navbar-nav navbar-right navigation_new2">
								<li><a href="javascript:void(0)">INDIVIDUAL <i class="fa fa-sort-desc dropMenu"></i></a></li>
								<li><a href="javascript:void(0)">CORPORATE <i class="fa fa-sort-desc dropMenu"></i></a></li>
								<li><a href="javascript:void(0)">BANKS <i class="fa fa-sort-desc dropMenu"></i></a></li>
								<li><a href="javascript:void(0)">NGO/Trust <i class="fa fa-sort-desc dropMenu"></i></a></li>
								<li><a href="javascript:void(0)">GOVT <i class="fa fa-sort-desc dropMenu"></i></a></li>
								<li><a href="javascript:void(0)">AssociAtes <i class="fa fa-sort-desc dropMenu"></i></a></li>
								<li><a href="javascript:void(0)" id="scrollTop">CONTACT</a></li>
								<div class="clr"></div>
							</ul>
							</div>
						</div>
						<!--a href="javascript:void(0)" class="navbarRes"><img src="img/menuicon.png" class="menuIcon"/> Menu</a-->
					</div>
					<div class="col-sm-3 signoutLogin">
					<?php
						$user = $this->Session->read('user');
						$user_id = isset($user['user_id'])?$user['user_id']:0;
						$user_name = isset($user['name'])?$user['name']:"";
						if($user_id != 0){
					?>
							<ul class="sublogin_Div">
								<li>Welcome <span><?=ucwords($user_name)?></span></li>
								<li>|</li>
								<li>
									<a href="<?=$config['BaseUrl']?>Users/logout">
										<i class="fa fa-sign-out"></i> Log Out
									</a>
								</li>
								<li>|</li>
								<li>
									<a href="<?=$config['BaseUrl']?>UserCarts">
										<i><img src="<?=$config['BaseUrl']?>img/cart_icon.png" class=""/></i>
										<div class="cart_quentaty">
											<p><?=$cartItemNo?></p>
										</div>
									</a>
								</li>
								<div class="clr"></div>
							</ul>
					<?php
						}else{
					?>
							<ul class="login_Div">
								<li><a href="<?=$config['BaseUrl']?>Users/logIn">Login</a></li>
								<li><a href="<?=$config['BaseUrl']?>Users/signUp">Sign Up</a></li>
								<div class="clr"></div>
							</ul>
					<?php
						}
					?>
					</div>
					<div class="clr"></div>
				</div>
            </div>
            <!-- Collection of nav links and other content for toggling -->
			<div class="responcive_menu">
				<div id="navbarCollapse" class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right navigation_new">
						<li><a href="javascript:void(0)">INDIVIDUAL <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<li><a href="javascript:void(0)">CORPORATE <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<li><a href="javascript:void(0)">BANKS <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<li><a href="javascript:void(0)">NGO/Trust <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<li><a href="javascript:void(0)">GOVT <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<li><a href="javascript:void(0)">AssociAtes <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<li><a href="javascript:void(0)">CONTACT</a></li>
						<div class="clr"></div>
					</ul>
				</div>
			</div>
        </nav>
    
	</div>
	<div class="header_all"></div>