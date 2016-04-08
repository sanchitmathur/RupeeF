<!-- new section -->
<?php
	//pr($userdocuments);
	//pr($userservicepackages);
	//pr($relatedServices);
	$phpbaseurl=FULL_BASE_URL.$this->base."/";
?>
<!-- user bye service section -->
<div class="col-sm-9">
	<?php
		if(isset($userservicepackages) && is_array($userservicepackages) && count($userservicepackages)>0){
			$count=0;
			foreach($userservicepackages as $userservicepackage){
				$count++;
				$servicename = $userservicepackage['Service']['service_name'];
				$requiredocuments = $userservicepackage['Service']['ServiceDocument'];
			?>
			<div class="userPick">
				<h1><?=$count.". ".$servicename?></h1>
				
				<div class="delivery_track">
					<ol class="progtrckr" data-progtrckr-steps="5">
						<li class="progtrckr-done">Submit successfully</li>
						<li class="progtrckr-todo">Document upload</li>
						<li class="progtrckr-todo">Document verified</li>
						<li class="progtrckr-todo">Sending</li>
						<li class="progtrckr-todo">Delivered</li>
					</ol>
				</div>
				
				<div class="">
					<h2>Required Documents</h2>
					<div class="col-sm-6 approveDiv">
						<ul>
					<?php
						if(is_array($requiredocuments) && count($requiredocuments)>0){
							
							$recdoctnumber = count($requiredocuments);
							$middlepoint = ($recdoctnumber>1)?ceil($recdoctnumber/2):'1';
							$innercount=0;
							foreach($requiredocuments as $requiredocument){
								$docname = ucwords($requiredocument['DocumentType']['name']);
								$doctypeid = $requiredocument['document_type_id'];
								//
								$imagename="cross21.png";
								$islinkgivem=true;
								if(in_array($doctypeid,$userdocuments)){
									$imagename="right.png";
									$islinkgivem=false;
								}
							?>
								<!--<li><i><?php echo $this->Html->image(__($imagename),array('class'=>'right'));?></i><?=$docname?></li>-->
							<?php
								if($innercount==$middlepoint){
									?>
									</ul>
								</div>
								<div class="col-sm-6 approveDiv">
									<ul>
									<?php
								}
								if($islinkgivem){
									?>
									<li><i><?php echo $this->Html->image(__($imagename),array('class'=>'right'));?></i>
									<?php echo $this->Html->link($docname,array('action'=>'documentupload'));?></li>
									<?php
								}
								else{
								
								?>
								<li><i><?php echo $this->Html->image(__($imagename),array('class'=>'right'));?></i><?=$docname?></li>
								<?php
								}
								$innercount++;
							}
						}
					?>
						</ul>
					</div>
					<div class="clr"></div>
				</div>
			</div>
			<?php
			}
		}
		else{
			//no service byed by this user
		}
	?>
</div>
<!-- bye service section end-->
<!-- new sugession section-->
<div class="col-sm-3 other_offer" style="padding-right:0;">
	<h1>Related service for you</h1>
	<?php
		if(is_array($relatedServices) && count($relatedServices)>0){
			$i=1;
			foreach($relatedServices as $relatedService){
				$clas="";
				if($i%2==0){
					$clas="ab1";
				}
				elseif($i%3==0){
					$clas="ab3";
				}
				else{
					$clas="";	
				}
				$servicename=$relatedService['Service']['service_name'];
				$service_description = $relatedService['Service']['service_description'];
				$service_description=substr($service_description,0,100);
				$packagecost="";
				$serviceid=$relatedService['Service']['id'];
				$link =$phpbaseurl."Services/bussiness_service/".$serviceid;
				if(isset($relatedService['ServicePackage']) && is_array($relatedService['ServicePackage']) && count($relatedService['ServicePackage'])>0){
					$package = $relatedService['ServicePackage']['0'];
					$packagecost="Rs. ".$package['amount']."/- ";
				}
				else{
					continue;
				}
				?>
				<div class="itemchuse_log <?=$clas?>">
					<h2><?=$servicename?></h2>
					<p><?=$service_description?>...</p>
					<h3><?=$packagecost?><span><a href="<?=$link?>" style="color:#fff;"><i><?php echo $this->Html->image('cart_icon3.png')?></i> Add To Cart</a></span></h3>
				</div>	
				<?php
				$i++;
			}
		}
		else{
			
		}
	?>
	<!--
	<div class="itemchuse_log">
		<h2>Tax Registrations</h2>
		<p>Shareholders are only liable for their share of money they invested in the company.</p>
		<h3>Rs. 500/- <span><a href="" style="color:#fff;"><i><img src="img/cart_icon3.png"></i> checkout</a></span></h3>
	</div>
	<div class="itemchuse_log ab1">
		<h2>Service Tax</h2>
		<p>Shareholders are only liable for their share of money they invested in the company.</p>
		<h3>Rs. 500/- <span><a href="" style="color:#fff;"><i><img src="img/cart_icon3.png"></i> checkout</a></span></h3>
	</div>
	<div class="itemchuse_log ab3">
		<h2>VAT or CST</h2>
		<p>Shareholders are only liable for their share of money they invested in the company.</p>
		<h3>Rs. 500/- <span><a href="" style="color:#fff;"><i><img src="img/cart_icon3.png"></i> checkout</a></span></h3>
	</div>
	<div class="itemchuse_log ab1">
		<h2>One Person Company</h2>
		<p>Shareholders are only liable for their share of money they invested in the company.</p>
		<h3>Rs. 500/- <span><a href="" style="color:#fff;"><i><img src="img/cart_icon3.png"></i> checkout</a></span></h3>
	</div>
	-->
</div>
<div class="clr"></div>
<!-- suggession section end-->
