<?php
	$config = Configure::read('RupeeForadian');
	//pr($config);
?>
<script>
	$(document).ready(function(){
		$('.header_all').hide();
		$('.readMore').bind('click',readMoreClickhandler);
		//$('.services').bind('click',readMoreClickhandler);
		$('.mainServices').bind('click',mainServicesClickHandler);
		$('.closeServices').bind('click',closeServicesClickHandler);
		
	});
	
	$(window).scroll(function(){
		//alert('scrolled');
		var scrollTop = $(window).scrollTop();
		console.log('scrollTop : '+scrollTop);
		if(scrollTop < 114){
			$('.header_all').fadeOut(300);
		}else{
			$('.header_all').fadeIn(300);
		}
	});
	
	function readMoreClickhandler(e){
		$x = $(e.currentTarget).parents('.mainServices').find('.subService');
		$x.each(function(index,item){
			if($(item).hasClass('liSubService')){
				$(item).removeClass('liSubService');
			}
		});
		$(e.currentTarget).hide();
	}
	
	function mainServicesClickHandler(e){
		$(e.currentTarget).find('.multipleService').css({
			'z-index':'3'
		});
		
		var width = $(e.currentTarget).find('.multipleService').width();
		var height = $(e.currentTarget).find('.multipleService').height();
		//var index = $(e.currentTarget).index();
		var index = $(e.currentTarget).find('.divIndex').val();
		var marginLeft = '0px';
		var marginTop = '0px';
		console.log('index : '+index);
		
		if(index == 0){
			marginLeft = '0px';
			
		}else if(index == 1){
			marginLeft = (1 * width) + 110;
			marginLeft = '-'+marginLeft+'px';
			
		}else if(index == 2){
			marginLeft = (2 * width) + 220;
			marginLeft = '-'+marginLeft+'px';
			
		}else if(index == 3){
			marginTop = (2 * height) - 168;
			marginTop = '-'+marginTop+'px';
			
			marginLeft = '0px';
			
		}else if(index == 4){
			marginTop = (2 * height) - 168;
			marginTop = '-'+marginTop+'px';
			
			marginLeft = (1 * width) + 110;
			marginLeft = '-'+marginLeft+'px';
			
		}else if(index == 5){
			marginTop = (2 * height) - 168;
			marginTop = '-'+marginTop+'px';
			
			marginLeft = (2 * width) + 220;
			marginLeft = '-'+marginLeft+'px';
			
		}
		
		$(e.currentTarget).find('.multipleService').animate(
			{
				width:'1197px',
				height:'748px',
				marginLeft:marginLeft,
				marginTop:marginTop
				//zIndex:'3'
			},
			100,
			function(){
				
			}
		);
		
		$(e.currentTarget).find('.subService').attr('style','width:33.33%!important');
		
		$(e.currentTarget).find('.subServiceName').css({
			"font-weight":"400"
		});
		
		$(e.currentTarget).find('.closeServices').show();
		$(e.currentTarget).find('.services').attr('style','opacity:0;').show();
		$(e.currentTarget).find('.services').animate(
			{
				opacity:1
			},
			100,
			function(){
				//console.log('called');
			}
		);
		
		$fa = $(e.currentTarget).find('.fa');
		if($fa.hasClass('fa-long-arrow-right')){
			$fa.removeClass('fa-long-arrow-right');
			$fa.addClass('fa-long-arrow-down');
		}
		
		$('.mainServices').unbind('click',mainServicesClickHandler);
	}
	
	function closeServicesClickHandler(e){
		$x = $(e.currentTarget).parents('.mainServices');
		
		$x.find('.subServiceName').css({
			"font-weight":"300"
		});
		
		$fa = $x.find('.fa');
		if($fa.hasClass('fa-long-arrow-down')){
			$fa.removeClass('fa-long-arrow-down');
			$fa.addClass('fa-long-arrow-right');
		}
		
		$x.find('.multipleService').animate(
			{
				width:'379px',
				height:'359px',
				marginLeft:'0px',
				marginTop:'0px',
				zIndex:'1'
			},
			100,
			function(){
				//console.log('called');
			}
		);
		
		$x.find('.subService').attr('style','width:100%!important');
		
		$x.find('.closeServices').hide();
		$x.find('.services').animate(
			{
				opacity:0
			},
			100,
			function(){
				//console.log('called');
			}
		);
		$x.find('.services').hide();
		e.stopPropagation();
		$('.mainServices').bind('click',mainServicesClickHandler);
	}
	
</script>

	<!------ Slider ------>
	<div class="slider">
		<div class="child_slider">
			<img src="<?=$config['BaseUrl']?>img/slider1.png" class="sliderpic"/>
		</div>
		
		<div class="nextprv_Div">
			<a href="javascript:void(0);">
				<img src="<?=$config['BaseUrl']?>img/next.png" class="next"/>
			</a>
			<a href="javascript:void(0);">
				<img src="<?=$config['BaseUrl']?>img/prv.png" class="prv"/>
			</a>
		</div>
		
		<div class="slide_text">
			<div class="container">
				<div class="row">
					<div class="col-md-12 aboutbody">
						<div class="col-sm-10 slidText">
							<h2>2 Crores in professional <span>fee saved each year</span>.</h2>
							<p>42,000 hours freed up for Indian business owners</p>
						</div>
						<div class="col-sm-2">
							<a href="javascript:void(0);">
								<img src="<?=$config['BaseUrl']?>img/readmore.png" class="reedMore"/>
							</a>
						</div>
						<div class="clr">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!------ End Slider ------>
	<!------ Services ------>
	<div class="service">
		<div class="container">
			<div class="row">
				<div class="col-md-12 service_body">
					<h1>Services<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span></h1>
					<div class="allService">
					<?php
						//pr($mainServices);
						
						$loopCount = 0;
						$divIndex = 0;
						foreach($mainServices as $mainService){
							$loopCount++;
					?>
						<div class="col-md-4">
							<div class="child_service mainServices">
								<img src="<?=$config['BaseUrl']?>img/servicebg_1.png" class="sliderpic"/>
								<div class="service1 multipleService colorBG<?=$divIndex+1?>">
									<input type="hidden" class="divIndex" value="<?=$divIndex?>" />
									<div class="cancle_div closeServices" style="display:none;">
										<a href="javascript:void(0);" class="">
											<img src="<?=$config['BaseUrl']?>img/cross.png" class=""/>
										</a>
									</div>
									<h2><?=$mainService['MainService']['service_name']?></h2>
							
									<?php
										//$countSubServices = count($mainService['SubService']);
										$countSubServices = 0;
										$innerLoopCount = 0;
										foreach($mainService['SubService'] as $subService){
											$liClass = "";
											$countSubServices++;
											$innerLoopCount++;
											if($countSubServices > 4){
												$liClass = "liSubService";
											}
									?>
										<div class="col-sm-4 expandService subService <?=$liClass?>">
											<p class="subServiceName">
												<i class="fa fa-long-arrow-right dropMenu2"></i>
												<?=$subService['service_name']?>
												
												<ul class="services hoverSub_menu " style="display:none;">
												<?php
													foreach($subService['Service'] as $service){
														$service_id = isset($service['id'])?$service['id']:0;
												?>
													<li class="actual_service">
														<input type="hidden" />
														<a href="<?=$config['BaseUrl']?>Services/bussiness_service/<?=$service_id?>" >
															<?=$service['service_name']?>
														</a>
													</li>
												<?php
													}
												?>
												</ul>
												
											</p>
										</div>
										<?php
											if($innerLoopCount == 3){
												$innerLoopCount = 0;
										?>
											<div class="clr"></div>
										<?php
											}
										?>
									<?php
										}
									?>
									<?php
										if($countSubServices > 4){
									?>
										<div style="display:none;">
											<button type="button" class="readMore">Read More</button>
										</div>
									<?php
										}
									?>
								</div>
							</div>
						</div>
						<?php
							if($loopCount == 3){
								$loopCount = 0;
						?>
							<div class="clr"></div>
						<?php
							}
						?>
					<?php
							$divIndex++;
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!------ End Services ------>
	
	<!--- Features -->
	<div class="features">
		<div class="container">
			<div class="row">
				<div class="col-md-12 service_body">
					<h1>Features<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span></h1>
					<div class="features_body">
						<div class="col-md-3">
							<div class="icon_div">
								<img src="img/icon1.png" class="icon1"/>
							</div>
							<h2>Separate Legal Entity</h2>
							<p>A Proprietorship business needs no registration. Therefore, it is one of the easiest to start with no formalities. However, after starting up the Proprietorship, it is relatively harder to open a bank account or obtain a payment gateway in the name of the business - since more registrations may be required.</p>
						</div>
						
						<div class="col-md-3">
							<div class="icon_div">
								<img src="img/icon2.png" class="icon1"/>
							</div>
							<h2>Uninterrupted Existance</h2>
							<p>A company has 'perpetual succession', that is continued or uninterrupted existence until it is legally dissolved. A company, being a separate legal person, is unaffected by the death or other departure of any member but continues to be in existence irrespective of the changes in membership.</p>
						</div>
						
						<div class="col-md-3">
							<div class="icon_div">
								<img src="img/icon3.png" class="icon1"/>
							</div>
							<h2>Easy Transferability</h2>
							<p>Shares of a company limited by shares are transferable by a shareholder to any other person. Filing and signing a share transfer form and handing over the buyer of the shares along with share certificate can easily transfer shares.</p>
						</div>
						
						<div class="col-md-3">
							<div class="icon_div">
								<img src="img/icon4.png" class="icon1"/>
							</div>
							<h2>Foreign Direct Investment</h2>
							<p>100% Foreign Direct Investment (FDI) is allowed in many of the sectors through Company type business entity without any prior Government approval. FDI is not allowed in Proprietorship or Partnership, LLP requires prior Government approval.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--- End Features -->
	
	<!--- Location --->
	<div class="location">
		<div class="service_body">
			<h1>Location<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span></h1>
			<div class="location_body">
				<div class="col-md-6 location_search">
					<h3>All around the India<span>Available locally, expanding globally</span></h3>
					<div class="search_locet">
						<input class="inputfrom" name="firstName" id="" placeholder="Find Your City" type="text">
						<div class="searchicon">
							<a href="javascript:void(0);"><img src="img/search_icon.png" class="search_Icon"/></a>
						</div>
						<div class="clr"></div>
					</div>
				</div>
				<div class="col-md-6 location_seclect">
					<img src="img/map_pic.png" class=""/>
					<div>
						<img src="img/arrow2.png" class="sideArrow"/>
					</div>
				</div>
				<div class="clr"></div>
			</div>
		</div>
	</div>
	
	<!--- End Location --->