<?php
    $config = Configure::read('RupeeForadian');
?>

<script>
	var initialHeight = 0;
	var initialWidth = 0;
	var winWidth=0;
	$(document).ready(function(){
		page_name = 'main';
		$('.header_all').hide();
		$('.readMore').bind('click',readMoreClickhandler);
		//$('.services').bind('click',readMoreClickhandler);
		$('.mainServices').bind('click',mainServicesClickHandler);
		$('.closeServices').bind('click',closeServicesClickHandler);
		winWidth=$(window).innerWidth();
		if (winWidth<769) {
			$(".allService .services").show();
			$(".allService .child_service").css({
				'height':'100%'
			});
		}
	});
	
	$(window).scroll(function(){
		//alert('scrolled');
		var scrollTop = $(window).scrollTop();
		//console.log('scrollTop : '+scrollTop);
		if(scrollTop > 10){
			$('.header_all').fadeIn(100);
		}else{
			$('.header_all').fadeOut(100);
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
			'z-index':'3',
			'height':'100%'
		});
		
		// var width = $(e.currentTarget).find('.multipleService').width();
		// var height = $(e.currentTarget).find('.multipleService').height();
		// console.log('height : '+height);
		initialWidth = $(e.currentTarget).width();
		initialHeight = $(e.currentTarget).height();
		//console.log('initialWidth : '+initialWidth);
		//console.log('initialHeight : '+initialHeight);
		//var index = $(e.currentTarget).index();
		var index = $(e.currentTarget).find('.divIndex').val();
		var marginLeft = '0px';
		var marginTop = '0px';
		console.log('index : '+index);
		
		if(index == 0){
			marginLeft = '0px';
			
		}else if(index == 1){
			//marginLeft = (1 * width) + 110;
			marginLeft = (1 * initialWidth) + (1 * 30);
			marginLeft = '-'+marginLeft+'px';
			
		}else if(index == 2){
			//marginLeft = (2 * width) + 220;
			marginLeft = (2 * initialWidth) + (2 * 30);
			marginLeft = '-'+marginLeft+'px';
			
		}else if(index == 3){
			//marginTop = (2 * height) - 169;
			marginTop = (1 * initialHeight) + (1 * 30);
			marginTop = '-'+marginTop+'px';
			
			marginLeft = '0px';
			
		}else if(index == 4){
			//marginTop = (2 * height) - 169;
			marginTop = (1 * initialHeight) + (1 * 30);
			marginTop = '-'+marginTop+'px';
			
			//marginLeft = (1 * width) + 110;
			marginLeft = (1 * initialWidth) + (1 * 30);
			marginLeft = '-'+marginLeft+'px';
			
		}else if(index == 5){
			//marginTop = (2 * height) - 169;
			marginTop = (1 * initialHeight) + (1 * 30);
			marginTop = '-'+marginTop+'px';
			
			//marginLeft = (2 * width) + 220;
			marginLeft = (2 * initialWidth) + (2 * 30);
			marginLeft = '-'+marginLeft+'px';
			
		}
		//for responsive support
		if (winWidth<769) {
			$(e.currentTarget).find('.multipleService').animate(
				{
					width:'100%',
					height:'auto!important'
					//marginLeft:marginLeft,
					//marginTop:marginTop
				},
				100,
				function(){
					
				}
			);
			//$(e.currentTarget).attr('style','height:100%!important');
		}
		else{
			increasedWidth = (3 * initialWidth) + (2 * 30);
			increasedHeight = (2 * initialHeight) + 30;
			//console.log('increasedHeight : '+increasedHeight);
			$(e.currentTarget).find('.multipleService').animate(
				{
					width:increasedWidth+'px',
					height:increasedHeight+'px',
					marginLeft:marginLeft,
					marginTop:marginTop
					//zIndex:'3'
				},
				100,
				function(){
					
				}
			);
			$(e.currentTarget).find('.subService').attr('style','width:33.33%!important');
			$(e.currentTarget).find('.closeServices').show();
		}
		
		
		$(e.currentTarget).find('.multipleService').css({
			"cursor":"default"
		});
		
		$(e.currentTarget).find('.subServiceName').css({
			"font-weight":"400"
		});
		
		
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
		
		/* if($(e.currentTarget).find('.subService').hasClass('liSubService')){
			$(e.currentTarget).find('.subService').addClass('liSubService2');
			$(e.currentTarget).find('.subService').removeClass('liSubService');
		} */
		
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
				width:initialWidth+'px',
				height:initialHeight+'px',
				marginLeft:'0px',
				marginTop:'0px',
				zIndex:'1'
			},
			100,
			function(){
				//console.log('called');
			}
		);
		
		$x.find('.multipleService').css({
			"cursor":"pointer"
		});
		
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
		
		/* if($x.find('.subService').hasClass('liSubService2')){
			$x.find('.subService').addClass('liSubService');
			$x.find('.subService').removeClass('liSubService2');
		} */
		
		e.stopPropagation();
		$('.mainServices').bind('click',mainServicesClickHandler);
	}
	
</script>
<div class="allcommon_body">
    <div class="checkout">
        <div class="container">
			<div class="row">
				<div class="col-md-12 service_body">
					<h1>Our Service<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text </span></h1>
					
	
					<!------ Services ------>
	<div class="service">
		<div class="container">
			<div class="row">
				<div class="col-md-12 service_body">
					
					<div class="allService">
					<?php
						//pr($mainServices);
						
						$loopCount = 0;
						$divIndex = 0;
						foreach($mainServices as $mainService){
							$loopCount++;
					?>
						<div class="col-md-4 responciv_padding">
							<div class="child_service mainServices">
								<!--<img src="<?=$config['BaseUrl']?>img/servicebg_1.png" class="sliderpic"/>-->
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
					
				</div>
			</div>
		</div>
	</div>
</div>