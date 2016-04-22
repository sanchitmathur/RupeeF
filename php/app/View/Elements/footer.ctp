<?php
	$config = Configure::read('RupeeForadian');
	//pr($config);
	$cartItemNo = $this->Session->read('cartItemNo');
	//get all the footer active services
	$footeractiveservices = $this->requestAction(array('controller'=>'Services','action'=>'footerservices'));
	//pr($footeractiveservices);
?>
    <div class="all_footer">
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12 footer_body">
						<div class="col-md-3 responciv_padding">
						<?php
							if(is_array($footeractiveservices) && count($footeractiveservices)>0){
								?>
								<h2>Services</h2>
								<ul>
								<?php
								$scount=1;
								foreach($footeractiveservices as $footeractiveservice){
									$s_name = $footeractiveservice['Service']['service_name'];
									$s_id = $footeractiveservice['Service']['id'];
									echo "<li>".$this->Html->link(__($s_name),array('controller'=>'Services','action'=>'bussiness_service',$s_id))."</li>";
									if($scount%30==0){
										?>
								</ul>
						</div>
						<div class="col-md-3 responciv_padding">
							<ul>
										<?php
									}
									$scount++;
								}
								?>
								</ul>
								
								<?php
							}
						?>
						</div>
						
						<div class="col-md-6 responciv_padding">
							<div class="col-sm-6 responciv_padding">
								<h2>Testimonials</h2>
								<ul>
									<li><a href="javascript:void(0);">Customer stories</a></li>
									<li><a href="javascript:void(0);">Showcase</a></li>
									<li><a href="javascript:void(0);">Documents</a></li>
									<li><a href="javascript:void(0);">Case studies</a></li>
									<li><a href="javascript:void(0);">White Papers</a></li>
								</ul>
							</div>
							<div class="col-sm-6 responciv_padding">
								<h2>Company</h2>
								<ul>
									<li><a href="javascript:void(0);">About Rupee Foradian</a></li>
									<li><a href="javascript:void(0);">Contact Us</a></li>
									<li><a href="javascript:void(0);">Terms & Conditions</a></li>
									<li><a href="javascript:void(0);">Confidentiality Policy</a></li>
									<li><a href="javascript:void(0);">Refund Policy</a></li>
									<li><a href="javascript:void(0);">Privacy Policy</a></li>
									<li><a href="javascript:void(0);">Disclaimer</a></li>
								</ul>
							</div>
							
							<div class="col-sm-12 responciv_padding">
								<div class="video_div">
									<div id="static_sections" style="display: none;">
										<img src="<?=$config['BaseUrl']?>img/video_pic.png" class="video_pic"/>
										<div class="play_video">
											<a href="javascript:void(0);" style="text-align:center; display: block;">
												<img src="<?=$config['BaseUrl']?>img/play_icon.png" class="playIcon"/>
											</a>
										</div>
									</div>
									<iframe width="560" height="315" src="https://www.youtube.com/embed/Jbn39j-xa-k" frameborder="0" allowfullscreen></iframe>
								</div>
							</div>
						</div>
						<div class="clr"></div>
						<div class="col-sm-2 responciv_padding">
							<h2>Inquries</h2>
							<div class="col-sm-6 futter_subnav responciv_padding">
								<ul>
									<li>Contact Press</li>
									<li style="color:#f1cf5a;">Press</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6 responciv_padding">
							<div class="col-sm-6 futter_subnav responciv_padding">
								<ul class="support">
									<li>Support</li>
									<li style="color:#f1cf5a;">Sales &nbsp; Technical &nbsp; Community &nbsp; Legal</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer2">
			<p>Copyright &copy; 2015 Rupee Foradian Financial Services Private Limited. All rights reserved.</p>
		</div>
	</div>