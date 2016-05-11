<?php
	$config = Configure::read('RupeeForadian');
	//pr($config);
	$cartItemNo = $this->Session->read('cartItemNo');
	$cartItemNo = (isset($cartItemNo) && $cartItemNo!='')?$cartItemNo:0;
	
	// echo $session_id = $this->Session->read('session_id');;
?>
<script type="text/javascript">
	var page_name = '';
	var divWidth = 100;
	var baseUrl = '<?=$config['BaseUrl']?>';
	var collapsFlag = true;
	var expandFlag = true;
	var leftPanelWidth = 0;
	var headerCollapsHeight = 103;
	var headerExpandHeight = 151;
	var menus = [];
	var scrollTop = 0;
	var manuIsHide="1";
	/* var menus = {
		'0':{
			'menu_id':1,
			'parent_menu_id':0,
			'menu_name':'Individual',
			'menu_description':{
				'heading':'',
				'description':''
			}
		},
		'1':{
			'menu_id':2,
			'parent_menu_id':0,
			'menu_name':'Corporate',
			'menu_description':{
				'heading':'',
				'description':''
			}
		},
		'2':{
			'menu_id':3,
			'parent_menu_id':0,
			'menu_name':'Banks',
			'menu_description':{
				'heading':'',
				'description':''
			}
		},
		'3':{
			'menu_id':4,
			'parent_menu_id':0,
			'menu_name':'NGO/Trust',
			'menu_description':{
				'heading':'',
				'description':''
			}
		},
		'4':{
			'menu_id':5,
			'parent_menu_id':0,
			'menu_name':'Govt',
			'menu_description':{
				'heading':'',
				'description':''
			}
		},
		'5':{
			'menu_id':6,
			'parent_menu_id':0,
			'menu_name':'Associates',
			'menu_description':{
				'heading':'',
				'description':''
			}
		},
		'6':{
			'menu_id':7,
			'parent_menu_id':0,
			'menu_name':'Contact',
			'menu_description':{
				'heading':'',
				'description':''
			}
		},
		'7':{
			'menu_id':8,
			'parent_menu_id':1,
			'menu_name':'Indian National',
			'menu_description':{
				'heading':'Are you a Indian National?',
				'description':'Integer ornare ante elit, a viverra est laoreet sit amet. Morbi euismod et dolor sit amet scelerisque. Vivamus utvulputate quam, a feugiat massa.Vivamus ut vulputate quam, a feugiat massa. Vestibulum ut ante sed nisl consectetur consectetur interdum vel nulla.'
			}
		},
		'8':{
			'menu_id':9,
			'parent_menu_id':1,
			'menu_name':'Foreign',
			'menu_description':{
				'heading':'Are you a Foreign National?',
				'description':'Integer ornare ante elit, a viverra est laoreet sit amet. Morbi euismod et dolor sit amet scelerisque. Vivamus utvulputate quam, a feugiat massa.Vivamus ut vulputate quam, a feugiat massa. Vestibulum ut ante sed nisl consectetur consectetur interdum vel nulla.'
			}
		},
		'9':{
			'menu_id':10,
			'parent_menu_id':1,
			'menu_name':'NRI',
			'menu_description':{
				'heading':'Are you a NRI?',
				'description':'Integer ornare ante elit, a viverra est laoreet sit amet. Morbi euismod et dolor sit amet scelerisque. Vivamus utvulputate quam, a feugiat massa.Vivamus ut vulputate quam, a feugiat massa. Vestibulum ut ante sed nisl consectetur consectetur interdum vel nulla.'
			}
		},
		'10':{
			'menu_id':11,
			'parent_menu_id':2,
			'menu_name':'Sub Corporate',
			'menu_description':{
				'heading':'Sub Corporate',
				'description':'Integer ornare ante elit, a viverra est laoreet sit amet. Morbi euismod et dolor sit amet scelerisque. Vivamus utvulputate quam, a feugiat massa.Vivamus ut vulputate quam, a feugiat massa. Vestibulum ut ante sed nisl consectetur consectetur interdum vel nulla.'
			}
		},
		'11':{
			'menu_id':12,
			'parent_menu_id':3,
			'menu_name':'Sub Banks',
			'menu_description':{
				'heading':'Sub Banks',
				'description':'Integer ornare ante elit, a viverra est laoreet sit amet. Morbi euismod et dolor sit amet scelerisque. Vivamus utvulputate quam, a feugiat massa.Vivamus ut vulputate quam, a feugiat massa. Vestibulum ut ante sed nisl consectetur consectetur interdum vel nulla.'
			}
		},
		'12':{
			'menu_id':13,
			'parent_menu_id':4,
			'menu_name':'Sub NGO/Trust',
			'menu_description':{
				'heading':'Sub NGO/Trust',
				'description':'Integer ornare ante elit, a viverra est laoreet sit amet. Morbi euismod et dolor sit amet scelerisque. Vivamus utvulputate quam, a feugiat massa.Vivamus ut vulputate quam, a feugiat massa. Vestibulum ut ante sed nisl consectetur consectetur interdum vel nulla.'
			}
		},
		'13':{
			'menu_id':14,
			'parent_menu_id':5,
			'menu_name':'Sub Govt',
			'menu_description':{
				'heading':'Sub Govt',
				'description':'Integer ornare ante elit, a viverra est laoreet sit amet. Morbi euismod et dolor sit amet scelerisque. Vivamus utvulputate quam, a feugiat massa.Vivamus ut vulputate quam, a feugiat massa. Vestibulum ut ante sed nisl consectetur consectetur interdum vel nulla.'
			}
		},
		'14':{
			'menu_id':15,
			'parent_menu_id':6,
			'menu_name':'Sub Associates',
			'menu_description':{
				'heading':'Sub Associates',
				'description':'Integer ornare ante elit, a viverra est laoreet sit amet. Morbi euismod et dolor sit amet scelerisque. Vivamus utvulputate quam, a feugiat massa.Vivamus ut vulputate quam, a feugiat massa. Vestibulum ut ante sed nisl consectetur consectetur interdum vel nulla.'
			}
		},
		'15':{
			'menu_id':16,
			'parent_menu_id':8,
			'menu_name':'Sub Indian National',
			'menu_description':{
				'heading':'Sub Indian National',
				'description':'Integer ornare ante elit, a viverra est laoreet sit amet. Morbi euismod et dolor sit amet scelerisque. Vivamus utvulputate quam, a feugiat massa.Vivamus ut vulputate quam, a feugiat massa. Vestibulum ut ante sed nisl consectetur consectetur interdum vel nulla.'
			}
		},
	}; */
	$(document).ready(function(){
		
		renderMainMenus();
		
		leftPanelWidth = $('#leftMenuPanel').width();
		$('#leftMenuPanel').attr('style','margin-left:-'+leftPanelWidth+'px').show();
		$('.scrolLogo').attr('style','margin-left:35px;');
		$('#leftMenuIcon').bind('click',leftMenuIconClickHandler);
		$('#leftMenuClose').bind('click',leftMenuCloseClickHandler);
		$('.mainMenu').bind('mouseover',mainMenuMouseoverHandler);
		$('.mainMenu').bind('mouseout',mainMenuMouseoutHandler);
		$('.subMenu').bind('mouseover',subMenuMouseoverHandler);
		$('.subMenu').bind('mouseout',subMenuMouseoutHandler);
		$('.subMenu').bind('click',subMenuClickHandler);
		$('#subMenuClose').bind('click',subMenuCloseClickHandler);
		
		hideFlashMessage();
	});
	
	$(window).scroll(function(){
		$('#header').fadeOut(300);
		headerAnimation();
		if (manuIsHide=='0') {
			leftMenuCloseClickHandler();
		}
	});
	
	
	$.fn.scrollEnd = function(callback, timeout){        
		$(this).scroll(function(){
			var $this = $(this);
			if ($this.data('scrollTimeout')){
				clearTimeout($this.data('scrollTimeout'));
			}
			$this.data('scrollTimeout', setTimeout(callback,timeout));
		});
	};

	// how to call it (with a 1000ms timeout):
	$(window).scrollEnd(function(){
		headerAnimation2();
	}, 1000);
	
	function headerAnimation(){
		scrollTop = $(window).scrollTop();
		//$('#scrollTop').html(scrollTop);
		//console.log('scrollTop : '+scrollTop);
		if(scrollTop > 10){
			if(collapsFlag){
				expandFlag = true;
				headerCollapsAnimation();
			}
			collapsFlag = false;
		}else{
			if(expandFlag){
				collapsFlag = true;
				headerExpandAnimation();
			}
			expandFlag = false;
		}
	}
	
	function headerExpandAnimation(){
		$('.header_all').animate(
			{height:headerExpandHeight+'px'},
			300,
			function(){}
		);
		subMenuMarginTop = headerExpandHeight-headerCollapsHeight;
		$('#subMenus').animate(
			{
				marginTop:'0px'
			},
			300,
			function(){}
		);
		$('.scrolLogo').animate(
			{marginLeft:'35px'},
			300,
			function(){
				src = baseUrl+'img/logo.png';
				$('#logoIcon').attr('src',src);
			}
		);
		$('.scroll_menu').animate(
			{marginTop:'0px'},
			300,
			function(){}
		);
	}
	
	function headerCollapsAnimation(){
		$('.header_all').animate(
			{
				height:headerCollapsHeight+'px'
			},
			300,
			function(){}
		);
		subMenuMarginTop = headerExpandHeight-headerCollapsHeight;
		$('#subMenus').animate(
			{
				marginTop:'-'+subMenuMarginTop+'px'
			},
			300,
			function(){}
		);
		$('.scroll_menu').animate(
			{
				marginTop:'-60px'
			},
			300,
			function(){}
		);
		$('.scrolLogo').animate(
			{
				marginLeft:'-300px'
			},
			300,
			function(){
				src = baseUrl+'img/logo_sm.png';
				$('#logoIcon').attr('src',src);
			}
		);
	}
	
	function headerAnimation2(){
		subMenuCloseClickHandler();
		//alert('stopped scrolling');
		$('#header').fadeIn(300);
	}
	
	function hideFlashMessage(){
		setTimeout(
			function(){
				$('#flashMessage').slideUp(300);
			},
			5000
		);
	}
	
	function renderMainMenus(){
		//$('#preloader').show();
		//console.log(menus);
		
		//AJAX call for fetch menus
		// var data = new FormData();
		// data.append("report_id",report_id);
		$.ajax({
			url:baseUrl+'Menus/menus',
			type:'POST',
			dataType:'json',
			//data:data,
			contentType: false,
			cache: false,
			processData:false,
			success:function(response){
				//console.log(response);
				menus = response;
				//console.log(menus);
				//var len = Object.keys(menus).length;
				var len = menus.length;
				//console.log(len);
				var html = '';
				var contactus=""
				for(var i=0; i<len; i++){
					obj = menus[i];
					//console.log(obj);
					var childCount = countNumberOfChild(obj);
					
					//console.log('childCount : '+childCount);
					
					if(obj.parent_menu_id == 0){
						var menu_id = obj.menu_id;
						var menu_name = obj.menu_name;
						var menu_link = obj.menu_link;
						if (menu_link=='') {
							menu_link="javascript:void(0)";
						}
						else{
							menu_link=baseUrl+menu_link;
						}
						html += '<li>\
									<input type="hidden" class="childCount" value="'+childCount+'" />\
									<input type="hidden" class="menuID" value="'+menu_id+'" />\
									<input type="hidden" class="menuName" value="'+menu_name+'" />\
									<a href="'+menu_link+'" class="mainMenu">\
										'+menu_name+' ';
									if(childCount > 0){
										html += '<i class="fa fa-sort-desc dropMenu"></i>';						
									}
							html += '</a>\
						</li>';
					}
				}
				html += '<div class="clr"></div>';
				//console.log(html);
				$('#mainMenus').html(html);
				
				$('.mainMenu').unbind('mouseover',mainMenuMouseoverHandler);
				$('.mainMenu').bind('mouseover',mainMenuMouseoverHandler);
				
				$('.mainMenu').unbind('mouseout',mainMenuMouseoutHandler);
				$('.mainMenu').bind('mouseout',mainMenuMouseoutHandler);
				
				$('#preloader').hide();
			},
			error:function(response){
				console.log(response);
			}
		});
	}
	
	function renderSubMenus(parent_menu_id){
		//console.log(menus);
		//var len = Object.keys(menus).length;
		var len = menus.length;
		//console.log(len);
		var html = '';
		for(var i=0; i<len; i++){
			obj = menus[i];
			//console.log(obj);
			var childCount = countNumberOfChild(obj);
			
			if(obj.parent_menu_id == parent_menu_id){
				var menu_id = obj.menu_id;
				var menu_name = obj.menu_name;
				html += '<li>\
							<input type="hidden" class="childCount" value="'+childCount+'" />\
							<input type="hidden" class="menuID" value="'+menu_id+'" />\
							<input type="hidden" class="menuName" value="'+menu_name+'" />\
							<a href="javascript:void(0);" class="subMenu">\
								'+menu_name+'\
							</a>\
						</li>';
			}
		}
		//console.log(html);
		$('#subMenuList').html(html);
		
		//Unbind bind sub menu functions
		$('.subMenu').unbind('mouseover',subMenuMouseoverHandler);
		$('.subMenu').bind('mouseover',subMenuMouseoverHandler);
		
		$('.subMenu').unbind('mouseout',subMenuMouseoutHandler);
		$('.subMenu').bind('mouseout',subMenuMouseoutHandler);
		
		$('.subMenu').unbind('click',subMenuClickHandler);
		$('.subMenu').bind('click',subMenuClickHandler);
		
		$('#subMenuList').find('.subMenu:first').trigger('mouseover');
		$('#subMenuList').find('.subMenu:first').addClass('active');
	}
	
	
	
	function mainMenuMouseoverHandler(e){
		$('.mainMenu').removeClass('active');
		$(e.currentTarget).addClass('active');
		var menu_id = $(e.currentTarget).parent('li').find('.menuID').val();
		var menu_name = $(e.currentTarget).parent('li').find('.menuName').val();
		$('#subMenuName').html(menu_name);
		
		var childCount = $(e.currentTarget).parent('li').find('.childCount').val();
			//alert('childCount : '+childCount);
		if(childCount > 0){
			//Call function for render sub menus
			renderSubMenus(menu_id);
			$('#subMenus').fadeIn(300);
			$('.header_all').show();
			//setTimeout(delaycall(menu_id),6000);
		}else{
			$('#subMenus').fadeOut(300);
			//$('.header_all').hide();
		}
	}
	
	function delaycall(menu_id){
		renderSubMenus(menu_id);
		$('#subMenus').fadeIn(300);
		$('.header_all').show();
	}
	function mainMenuMouseoutHandler(e){
		var childCount = $(e.currentTarget).parent('li').find('.childCount').val();
		if(childCount == 0){
			$(e.currentTarget).removeClass('active');
		}
	}
	
	function subMenuMouseoverHandler(e){
		$('.subMenu').removeClass('active');
		$(e.currentTarget).addClass('active');
		
		var menu_id = $(e.currentTarget).parent('li').find('.menuID').val();
		var menu_name = $(e.currentTarget).parent('li').find('.menuName').val();
		
		//var len = Object.keys(menus).length;
		var len = menus.length;
		//console.log(len);
		for(var i=0; i<len; i++){
			obj = menus[i];
			if(obj.menu_id == menu_id){
				subMenuHeading = obj.menu_description.heading;
				subMenuDescription = obj.menu_description.description;
				
				$('.subMenuHeading').show();
				$('.subMenuDescription').show();
				
				//$('.subMenuHeading').css({'margin-left':'600px'});
				//$('.subMenuDescription').css({'margin-left':'-600px'});
				
				$('#subMenuHeading').html(subMenuHeading);
				$('#subMenuDescription').html(subMenuDescription);
				
				/* $('.subMenuHeading').animate(
					{marginLeft:'0px'},
					600,
					function(){}
				);
				$('.subMenuDescription').animate(
					{marginLeft:'0px'},
					600,
					function(){}
				); */
			}
		}
	}
	
	function subMenuMouseoutHandler(e){
		//$('.subMenuHeading').hide();
		//$('.subMenuDescription').hide();
		
		// $('.subMenuHeading').css({'margin-left':'600px'});
		// $('.subMenuDescription').css({'margin-left':'-600px'});
	}
	
	function subMenuClickHandler(e){
		var childCount = $(e.currentTarget).parent('li').find('.childCount').val();
		
		if(childCount > 0){
			var menu_id = $(e.currentTarget).parent('li').find('.menuID').val();
			var menu_name = $(e.currentTarget).parent('li').find('.menuName').val();
			$('#subMenuName').html(menu_name);
			//Call function for render sub menus
			
			renderSubMenus(menu_id);
			
			//$('#subMenus').fadeIn(300);
		}
	}
	
	function subMenuCloseClickHandler(){
		$('#subMenus').fadeOut(300);
		$('.mainMenu').removeClass('active');
		
		if((scrollTop == 0) && page_name == 'main' ){
			$('.header_all').hide();
		}
	}
	
	function countNumberOfChild(obj){
		//console.log(obj);
		var childCount = 0;
		var menu_id = obj.menu_id;
		//var len = Object.keys(menus).length;
		var len = menus.length;
		for(var i=0; i<len; i++){
			var menuObj = menus[i];
			if(menuObj.parent_menu_id == menu_id){
				childCount++;
			}
		}
		return childCount;
	}
	
	function leftMenuIconClickHandler(){
		subMenuCloseClickHandler();
		
		$('#leftMenuPanel').animate(
			{marginLeft:'0px'},
			300,
			function(){}
		);
	}
	
	function leftMenuCloseClickHandler(){
		$('#leftMenuPanel').animate(
			{marginLeft:'-'+leftPanelWidth+'px'},
			300,
			function(){}
		);
	}
	
	
	
</script>
	
	
	<div class="preloader" id="preloader">
		<div class="preloader_3">
			<img src="<?=$config['BaseUrl']?>img/preloader.gif" width="60"> 
		</div>
	</div>
	
	<div class="main_header" id="mainHeader">
		<div class="sideMenu" id="leftMenuPanel" style="display:none;">
			<div class="close_div">
				<a href="javascript:void(0);">
					<img src="<?=$config['BaseUrl']?>img/cross_icon.png" class="" id="leftMenuClose"/>
				</a>
				<?php
					if(!$this->Session->check('user')){
					?>
				<a href="<?=$config['BaseUrl']?>Users/logIn" class="side_login">Login</a>
				<div class="clr"></div>
				<center>
					<!--<input value="Sign up" id="btnsubmit" class="send_button" type="submit">-->
					<a href="<?=$config['BaseUrl']?>Users/signUp" class="send_button">Sign Up</a>
				</center>	
					<?php	
					}
				?>
				
			</div>
			<div class="resscrol">
				<div class="close_menu">
					<ul>
						<li><a href="<?=$config['BaseUrl']?>">Home</a></li>
						<!--<li><a href="javascript:void(0);">our services</a></li>-->
						<li><?php echo $this->Html->link(__('Our services'),array('controller'=>'Pages','action'=>'ourservices'));?></li>
						<!--<li><a href="javascript:void(0);">our cities</a></li>-->
						<li><?php echo $this->Html->link(__('Our cities'),array('controller'=>'Pages','action'=>'findcity'));?></li>
						<!--<li><a href="javascript:void(0);">be a business partner</a></li>-->
						<li><?php echo $this->Html->link(__('Be a business partner'),array('controller'=>'Pages','action'=>'businesspartner'));?></li>
						<!--<li><a href="javascript:void(0);">mobile app features</a></li>-->
						<li><?php echo $this->Html->link(__('Mobile app features'),array('controller'=>'Pages','action'=>'mobileapp'));?></li>
						<!--<li><a href="javascript:void(0);">safety / confidentiality</a></li>-->
						<li><?php echo $this->Html->link(__('Safety / confidentiality'),array('controller'=>'Pages','action'=>'safty'));?></li>
						
						<li><a href="javascript:void(0);">cfo</a></li>
						<!--<li><a href="javascript:void(0);">about us</a></li>-->
						<li><?php echo $this->Html->link(__('About us'),array('controller'=>'Pages','action'=>'aboutus'));?></li>
						<!--<li><a href="javascript:void(0);">Careers</a></li>-->
						<li><?php echo $this->Html->link(__('Careers'),array('controller'=>'Pages','action'=>'career'));?></li>
						<!--<li><a href="javascript:void(0);">legal terms & conditions</a></li>-->
						<li><?php echo $this->Html->link(__('Legal terms & conditions'),array('controller'=>'Pages','action'=>'legaltermscondition'));?></li>
						<!--<li><a href="javascript:void(0);">News room</a></li>-->
						<li><?php echo $this->Html->link(__('News room'),array('controller'=>'Pages','action'=>'newsroom'));?></li>
					</ul>
				</div>
			</div>
			<div class="playstore_icon">
				<center>
					<a href="javascript:void(0);"><img src="<?=$config['BaseUrl']?>img/apple_icon.png" class=""/></a>
					<a href="javascript:void(0);"><img src="<?=$config['BaseUrl']?>img/android_icon.png" class=""/></a>
					<a href="javascript:void(0);"><img src="<?=$config['BaseUrl']?>img/windows_icon.png" class=""/></a>
				</center>
			</div>
		</div>
		
		<div class="childSub_menu" id="subMenus" style="display:none;">
			<div class="col-md-6 left_child">
				<div class="cancle_div2">
					<a href="javascript:void(0);" id="subMenuClose">
						<img src="<?=$config['BaseUrl']?>img/cross2.png" class=""/>
					</a>
				</div>
				<h2 id="subMenuName"><!--Individual--></h2>
				<ul id="subMenuList">
					<!--<li>
						<a href="javascript:void(0);" class="active">
							Indian National
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							Foreign
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							NRI
						</a>
					</li>-->
				</ul>
			</div>
			<div class="col-md-6 right_child">
				<div class="right_child_heading subMenuHeading">
					<h4 id="subMenuHeading">
						<!--Are you a Foreign National or Indian National?-->
					</h4>
				</div>
				<div class="right_child_details subMenuDescription">
					<p id="subMenuDescription">
						<!--Integer ornare ante elit, a viverra est laoreet sit amet. Morbi euismod et dolor sit amet scelerisque. Vivamus utvulputate quam, a feugiat massa.Vivamus ut vulputate quam, a feugiat massa. Vestibulum ut ante sed nisl consectetur consectetur interdum vel nulla.-->
					</p>
				</div>
				
				<!--<input value="View More" id="" class="view_button" type="submit">-->
			</div>
			<div class="clr"></div>
		</div>
		
		<nav role="navigation" class="navbar navbar-default headerinn">
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle" style="display:none;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
					<a href="<?=$config['BaseUrl']?>" class="navbarRes"><img src="<?=$config['BaseUrl']?>img/logo_sm_res.png" class="logimgres"></a><!--res_icon-->
					
						<!--a href="javascript:void(0)" class="navbar-brand navbrand leftMenuIcon" id="leftMenuIcon">
							<img src="<?=$config['BaseUrl']?>img/menuicon.png" class="menuIcon"/> Menu
						</a><!--res_menu-->
				
				<div class="uperHeader">
					<div class="col-sm-2 LeftNewmenu">
						<a href="javascript:void(0)" class="navbar-brand navbrand leftMenuIcon resLEFTmenu" id="leftMenuIcon">
							<p><img src="<?=$config['BaseUrl']?>img/menuicon.png" class="menuIcon"/><span>Menu</span></p>
						</a>
					</div>
					<div class="col-sm-8 scrol_body">
						<div class="col-sm-2 scrolLogo">
							<div class="main_logo_div">
								<a href="<?=$config['BaseUrl']?>" class="navbar-brand navbrand" style="padding:0;">
									<!--<img src="<?=$config['BaseUrl']?>img/logo.png" class="logoicon" id="logoIcon"/>-->
									<?php echo $this->Html->image('logo.png',array('class'=>'logoicon','id'=>'logoIcon'));?>
								</a>
							</div>
						</div>
						<div class="col-sm-10 scroll_menu" style="padding-right:0;">
							<div class="desktop_menu">
							<ul class="nav navbar-nav navbar-right navigation_new2" id="mainMenus">
								<!--<li>
									<a href="javascript:void(0)" class="mainMenu">
										<input type="hidden" class="childCount" value="1" />
										<input type="hidden" class="menuName" value="Individual" />
										Individual 
										<i class="fa fa-sort-desc dropMenu"></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)" class="mainMenu">
										<input type="hidden" class="childCount" value="1" />
										<input type="hidden" class="menuName" value="Corporate" />
										Corporate 
										<i class="fa fa-sort-desc dropMenu"></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)" class="mainMenu">
										<input type="hidden" class="childCount" value="1" />
										<input type="hidden" class="menuName" value="Banks" />
										Banks 
										<i class="fa fa-sort-desc dropMenu"></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)" class="mainMenu">
										<input type="hidden" class="childCount" value="1" />
										<input type="hidden" class="menuName" value="NGO/Trust" />
										NGO/Trust 
										<i class="fa fa-sort-desc dropMenu"></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)" class="mainMenu">
										<input type="hidden" class="childCount" value="1" />
										<input type="hidden" class="menuName" value="Govt" />
										Govt 
										<i class="fa fa-sort-desc dropMenu"></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)" class="mainMenu">
										<input type="hidden" class="childCount" value="1" />
										<input type="hidden" class="menuName" value="Associates" />
										Associates 
										<i class="fa fa-sort-desc dropMenu"></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)" class="mainMenu" id="scrollTop">
										<input type="hidden" class="childCount" value="0" />
										Contact
									</a>
								</li>
								<div class="clr"></div>-->
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
								<li>
									<div style="width:100%;" class="res_wel">
										Welcome 
										<?php
											$len = strlen($user_name);
											if($len > 6){
												$name = substr($user_name,0,6).'...';
											}else{
												$name = $user_name;
											}
										?>
										<span title="<?=ucwords($user_name)?>"><?=ucwords($name)?></span>
									</div>
									<div class="myacc">
										<?php echo $this->Html->link('My Account',array('controller'=>'Users','action'=>'index'));?>
									</div>
								</li>
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
								<li>
									<a href="<?=$config['BaseUrl']?>UserCarts" style="border:none; padding:12px 0;">
										<i><img src="<?=$config['BaseUrl']?>img/cart_icon.png" class=""/></i>
										<div class="cart_quentaty" style="top:0px; right:-6px;">
											<p><?=$cartItemNo?></p>
										</div>
									</a>
								</li>
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
			<div class="responcive_menu" style="display:none;">
				<div id="navbarCollapse" class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right navigation_new">
						<li><a href="javascript:void(0)">INDIVIDUAL <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<li><a href="javascript:void(0)">CORPORATE <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<li><a href="javascript:void(0)">BANKS <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<li><a href="javascript:void(0)">NGO/Trust <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<li><a href="javascript:void(0)">GOVT <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<li><a href="javascript:void(0)">AssociAtes <i class="fa fa-sort-desc dropMenu"></i></a></li>
						<!--<li><a href="javascript:void(0)">CONTACT</a></li>-->
						<li><?php echo $this->Html->link(__('CONTACT'),array('controller'=>'Pages','action'=>'contactus'));?></li>
						<div class="clr"></div>
					</ul>
				</div>
			</div>
        </nav>
    
	</div>
	<div class="header_all"></div>