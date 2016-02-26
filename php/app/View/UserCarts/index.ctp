<?php
	$config = Configure::read('RupeeForadian');
	//pr($config);
	//pr($userCarts);
	//pr($serviceTax);
	
	$user = $this->Session->read('user');
	$user_id = isset($user['user_id'])?$user['user_id']:0;
	
	$taxAmount = isset($serviceTax['ServiceTax']['amount'])?$serviceTax['ServiceTax']['amount']:0;
	$taxType = (isset($serviceTax['ServiceTax']['type']) && $serviceTax['ServiceTax']['type']>1)?2:1;
?>
<script>
	var baseUrl = "<?=$config['BaseUrl']?>";
	var currency = "";
	var total = 0;
	var grand_total = 0;
	var taxAmount = "<?=$taxAmount?>";
	var taxType = "<?=$taxType?>";
	var service_ids = [];
	var service_package_ids = [];
	$(document).ready(function(){
		calculateTotal();
		setValues();
		$('.package').bind('change',packageChangeHandler);
		$('#proceed').bind('click',proceedClickHandler);
	});
	
	function packageChangeHandler(e){
		var description = $(e.currentTarget).find(":selected").attr('description');
		var currency = $(e.currentTarget).find(":selected").attr('currency');
		var amount = $(e.currentTarget).find(":selected").attr('amount');
		$(e.currentTarget).parents('.parentTR').find(".description").html(description);
		$(e.currentTarget).parents('.parentTR').find(".currency").html(currency);
		$(e.currentTarget).parents('.parentTR').find(".amount").html(amount);
		
		calculateTotal();
		setValues();
	}
	
	function calculateTotal(){
		$(".currency").each(function(index,item){
			currency = $(item).html();
		});
		$(".amount").each(function(index,item){
			itemPrice = $(item).html();
			total = total + parseFloat(itemPrice);
		});
		
		if(taxType == "1"){//Percentage
			tax = (total * parseFloat(taxAmount)) / 100;
		}else{//Amount
			tax = parseFloat(taxAmount);
		}
		grand_total = total + tax;
		
		$('#total_currency').html(currency);
		$('#tax_currency').html(currency);
		$('#grand_total_currency').html(currency);
		
		$('#total').html(parseFloat(total).toFixed(2));
		$('#tax').html(parseFloat(tax).toFixed(2));
		$('#grand_total').html(parseFloat(grand_total).toFixed(2));
	}
	
	function setValues(){
		service_ids = [];
		service_package_ids = [];
		
		$('.service_id').each(function(index,item){
			service_ids.push($(item).val());
		});
		
		$('.package').each(function(index,item){
			service_package_ids.push($(item).val());
		});
		
		$('input[name="service_ids"]').val(service_ids);
		$('input[name="service_package_ids"]').val(service_package_ids);
	}
	
	function proceedClickHandler(){
		if(parseInt(total) == 0){
			alert("Please select atleast one service.");
			window.location = baseUrl;
			return false;
		}
	}
	
</script>
	<div class="allcommon_body">
		<div class="checkout">
			<div class="container">
				<div class="row">
					<div class="col-md-12 service_body">
						<h1>Check out
							<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</span>
						</h1>
						<div class="checkout_body">
							<h3>
								<a href="<?=$config['BaseUrl']?>">
									<i class="fa fa-plus-circle plus"></i> 
									Continue Shopping
								</a>
							</h3>
							<div class="col-sm-12 checkout_table">
								<div class="table-responsive">
									<table class="table table-striped table-responsive">
										<thead>
											<tr>
												<th style="width:180px;">Service name</th>
												<th style="width:180px;">Package name</th>
												<th>Package Description</th>
												<th style="width:150px;">Amount</th>
												<th style="width:50px;"></th>
											</tr>
										</thead>
										<tbody>
										<?php
											if(isset($userCarts) && is_array($userCarts) && count($userCarts)>0){
												foreach($userCarts as $userCart){
													$service_id = isset($userCart['Service']['id'])?$userCart['Service']['id']:0;
													$service_name = isset($userCart['Service']['service_name'])?$userCart['Service']['service_name']:"";
													$packge_id = isset($userCart['ServicePackage']['id'])?$userCart['ServicePackage']['id']:"";
													$description = isset($userCart['ServicePackage']['description'])?$userCart['ServicePackage']['description']:"";
													$amount = isset($userCart['ServicePackage']['amount'])?$userCart['ServicePackage']['amount']:0;
													$currency = isset($userCart['ServicePackage']['currency'])?$userCart['ServicePackage']['currency']:"";
										?>
												<tr class="parentTR">
													<td>
														<input type="hidden" class="service_id" value="<?=$service_id?>" />
														<?=$service_name?>
													</td>
													<td>
														<select class="package">
														<?php
															if(isset($userCart['Service']['ServicePackage']) && is_array($userCart['Service']['ServicePackage']) && count($userCart['Service']['ServicePackage'])>0 ){
																foreach($userCart['Service']['ServicePackage'] as $servicePackage){
																	
														?>
															<option value="<?=$servicePackage['id']?>" <?php if($servicePackage['id'] == $packge_id)echo "selected" ?> description="<?=$servicePackage['description']?>" currency="<?=$servicePackage['currency']?>" amount="<?=$servicePackage['amount']?>"><?=$servicePackage['package_name']?></option>
														<?php
																}
															}
														?>
														</select>
													</td>
													<td class="description">
														<?=$description?>
													</td>
													<td style="text-align:right;">
														<span class="currency">
															<?=$currency?>
														</span> 
														<span class="amount">
															<?=$amount?>
														</span>
													</td>
													<td class="">
														<a href="javascript:void(0);">
															<i class="fa fa-trash-o delitIcon"></i>
														</a>
													</td>
												</tr>
										<?php
												}
											}
										?>
										</tbody>
									</table>
								</div>
								
								<div class="rightcost">
									<div class="allcost">
										<table>
											<tr>
												<td style="width:120px;">
													<p>Total</p>
												</td>
												<td style="text-align:right;">
													<h2>
														<span id="total_currency"></span> 
														<span id="total"></span>
													</h2>
												</td>
											</tr>
											<tr>
												<td>
													<p>Service TAX</p>
												</td>
												<td style="text-align:right;">
													<h2>
														<span id="tax_currency"></span> 
														<span id="tax"></span>
													</h2>
												</td>
											</tr>
											<tr class="childcost">
												<td>
													<p>Grand Total</p>
												</td>
												<td style="text-align:right;">
													<h2>
														<span id="grand_total_currency"></span> 
														<span id="grand_total"></span>
													</h2>
												</td>
											</tr>
											<!--<tr>
												<td colspan="2">
													<form method="post" action="<?=$config['BaseUrl']?>Users/proceedToCheckout">
														<input type="hidden" name="service_ids" value="" />
														<input type="hidden" name="service_package_ids" value="" />
														<button type="submit" id="proceed">Proceed To Checkout</button>
													</form>
												</td>
											</tr>-->
										</table>
									<?php
										if($user_id != 0){
									?>
										<form method="post" action="<?=$config['BaseUrl']?>Users/proceedToCheckout">
											<input type="hidden" name="service_ids" value="" />
											<input type="hidden" name="service_package_ids" value="" />
											<button type="submit" class="checkoutButton" id="proceed">Proceed To Checkout</button>
										</form>
									<?php
										}else{
									?>
										<form method="post" action="<?=$config['BaseUrl']?>Users/registration">
											<input type="hidden" name="service_ids" value="" />
											<input type="hidden" name="service_package_ids" value="" />
											<button type="submit" class="checkoutButton" id="proceed">Continue</button>
										</form>
									<?php
										}
									?>
									</div>
								</div>
							</div>
							<div class="crl"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>