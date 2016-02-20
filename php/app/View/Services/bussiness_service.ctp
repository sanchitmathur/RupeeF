<?php
	$config = Configure::read('RupeeForadian');
	//pr($config);
	//pr($service);
	$user = $this->Session->read('user');
	$user_id = isset($user['user_id'])?$user['user_id']:0;
?>

<script>
	$(document).ready(function(){
		$('.question').bind('click',questionClickHandler);
	});
	
	function questionClickHandler(e){
		$(e.currentTarget).parents('.faq').find('.answer').slideToggle(300);
		
		$fa = $(e.currentTarget).find('.fa');
		if($fa.hasClass('fa-chevron-right') && $fa.hasClass('chevron')){
			$fa.removeClass('fa-chevron-right');
			$fa.removeClass('chevron');
			
			$fa.addClass('fa-chevron-down');
			$fa.addClass('chevron2');
			
		}else if($fa.hasClass('fa-chevron-down') && $fa.hasClass('chevron2')){
			$fa.removeClass('fa-chevron-down');
			$fa.removeClass('chevron2');
			
			$fa.addClass('fa-chevron-right');
			$fa.addClass('chevron');
			
		}
	}
	
</script>

	<div class="proprietorship">
	<?php
		$service_id = 0;
		$service_name = "";
		if(isset($service['Service']) && count($service['Service'])>0){
			$service_id = isset($service['Service']['id'])?$service['Service']['id']:0;
			$service_name = isset($service['Service']['service_name'])?$service['Service']['service_name']:"";
			$service_description = isset($service['Service']['service_description'])?$service['Service']['service_description']:"";
	?>
		<div class="container">
			<div class="row">
				<div class="col-md-12 service_body service_body2">
					<h1><?=$service_name?></h1>
					<p><?=$service_description?></p>
				</div>
			</div>
		</div>
	<?php
		}
	?>

		<div class="container">
			<div class="row">
				<div class="col-md-12 service_body service_body2">
					<h1>Proprietorship Startup Process<span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem</span></h1>
					<div class="features_body">
						<div class="col-md-3 abDiv">
							<div class="icon_div2">
								<p>1</p>
							</div>
							<h2>Separate Legal Entity</h2>
							<p>A Proprietorship business needs no registration. Therefore, it is one of the easiest to start with no formalities. However, after starting up the Proprietorship, it is relatively harder to open a bank account or obtain a payment gateway in the name of the business - since more registrations may be required.</p>
						</div>
						
						<div class="col-md-3 abDiv">
							<div class="leftArrow">
								<img src="<?=$config['BaseUrl']?>img/leftarrow.jpg" class="playIcon"/>
							</div>
							<div class="icon_div2">
								<p>2</p>
							</div>
							<h2>Uninterrupted Existance</h2>
							<p>A company has 'perpetual succession', that is continued or uninterrupted existence until it is legally dissolved. A company, being a separate legal person, is unaffected by the death or other departure of any member but continues to be in existence irrespective of the changes in membership.</p>
						</div>
						
						<div class="col-md-3 abDiv">
							<div class="leftArrow">
								<img src="<?=$config['BaseUrl']?>img/leftarrow.jpg" class="playIcon"/>
							</div>
							<div class="icon_div2">
								<p>3</p>
							</div>
							<h2>Easy Transferability</h2>
							<p>Shares of a company limited by shares are transferable by a shareholder to any other person. Filing and signing a share transfer form and handing over the buyer of the shares along with share certificate can easily transfer shares.</p>
						</div>
						
						<div class="col-md-3 abDiv abDiv2">
							<div class="leftArrow">
								<img src="<?=$config['BaseUrl']?>img/leftarrow.jpg" class="playIcon"/>
							</div>
							<div class="icon_div2">
								<p>4</p>
							</div>
							<h2>Foreign Direct Investment</h2>
							<p>100% Foreign Direct Investment (FDI) is allowed in many of the sectors through Company type business entity without any prior Government approval. FDI is not allowed in Proprietorship or Partnership, LLP requires prior Government approval.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	<?php
		if(isset($service['ServicePackage']) && count($service['ServicePackage'])>0){
	?>
		<div class="container">
			<div class="row">
				<div class="col-md-12 service_body service_body2">
					<h1>Packages
						<span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem</span>
					</h1>
					<div class="packegeDiv">
					<?php
						$count = 0;
						foreach($service['ServicePackage'] as $servicePackage){
							$count++;
							$service_package_id = isset($servicePackage['id'])?$servicePackage['id']:0;
							$package_name = isset($servicePackage['package_name'])?$servicePackage['package_name']:"";
							$description = isset($servicePackage['description'])?$servicePackage['description']:"";
							$amount = isset($servicePackage['amount'])?$servicePackage['amount']:0;
							$currency = isset($servicePackage['currency'])?$servicePackage['currency']:"";
					?>
							<div class="col-sm-4">
								<div class="sub_packege">
									<div class="basic">
										<h2><?=$package_name?></h2>
									</div>
									
									<p><?=$description?></p>
									
									<div class="price_div">
										<h4><?=number_format($amount,0,'',',')?>
											<sup>
												<?php
													$faClass = '';
													if($currency == 'INR'){
														$faClass = 'fa-inr';
													}
												?>
												<i class="fa <?=$faClass?> inricon"></i>
											</sup>
											<span>month</span>
										</h4>
									</div>
								<?php
									if($user_id == 0){
								?>
									<form method="post" action="<?=$config['BaseUrl']?>Users/registration">
								<?php
									}else{
								?>
									<!--<form method="post" action="<?=$config['BaseUrl']?>Services/addToCart">-->
									<form method="post" action="<?=$config['BaseUrl']?>Services/saveToCart">
								<?php
									}
								?>
										<input type="hidden" name="service_id" value="<?=$service_id?>" />
										<input type="hidden" name="service_package_id" value="<?=$service_package_id?>" />
								<?php
									$option = array(
										'label' => 'Add to Cart',
										'class' => 'caryAdd',
									);
									echo $this->Form->end($option);
								?>
								</div>
							</div>
							<?php
								if($count == 3){
							?>
								<div class="clr"></div>
							<?php
								}
							?>
					<?php
						}
					?>
					</div>
				</div>
			</div>
		</div>
	<?php
		}
	?>

	<?php
		if(isset($service['ServiceAdvantage']) && count($service['ServiceAdvantage'])>0){
	?>
		<!--<div class="">
			<h1>Advantages of <?=$service_name?></h1>
			<?php
				$count = 0;
				foreach($service['ServiceAdvantage'] as $serviceAdvantage){
					$count++;
					$advantage_heading = isset($serviceAdvantage['advantage_heading'])?$serviceAdvantage['advantage_heading']:"";
					$advantage_description = isset($serviceAdvantage['advantage_description'])?$serviceAdvantage['advantage_description']:"";
			?>
					<div class="col-md-3">
						<h4><?=$advantage_heading?></h4>
						<p><?=$advantage_description?></p>
					</div>
					<?php
						if($count == 4){
							$count = 0;
					?>
						<div class="clr"></div>
					<?php
						}
					?>
			<?php
				}
			?>
		</div>-->
	<?php
		}
	?>

	<?php
		if(isset($service['ServiceFaq']) && count($service['ServiceFaq'])>0){
	?>
		<div class="container">
			<div class="row">
				<div class="col-md-12 service_body service_body2">
					<h1>Frequently Ask Questions
						<span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem</span>
					</h1>
					
					<div class="questionDiv">
						<div class="panel-group panel-info" id="accordion">
						<?php
							$totalCount = count($service['ServiceFaq']);
							$mid = $totalCount/2;
							//for($i=0; $i<$mid; $i++){
							foreach($service['ServiceFaq'] as $serviceFaq){
								//$serviceFaq = $service['ServiceFaq'][$i];
								$question = isset($serviceFaq['question'])?$serviceFaq['question']:"";
								$answer = isset($serviceFaq['answer'])?$serviceFaq['answer']:"";
						?>
								<div class="panel panel-default allQuiestion faq">
									<div class="question">
										<a href="javascript:void(0);">
											<div class="panel-heading newpanelhead">
												<h4>
													<?=$question?> 
													<i class="fa fa-chevron-right chevron"></i>
												</h4>
											</div>
										</a>
									</div>
									<div class="answer" style="display:none;">
										<div id="collapseOne" class="panel-collapse collapse in newPanelBody">
											<div class="panel-body">
												<?=$answer?>
											</div>
										</div>
									</div>
								</div>
						<?php
							}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
		}
	?>
	</div>
