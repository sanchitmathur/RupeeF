<?php
    $config = Configure::read('RupeeForadian');
?>
<div class="allcommon_body findBODY">
    <div class="checkout">
            <div class="findcity">
                    <div class="career_Bg">
                            <img src="<?=$config['BaseUrl']?>img/career_bg.png" class="cr_bg"/>
                    </div>
            </div>
            <div class="container">
                    <div class="row">
                            <div class="col-md-12 service_body">
                                    <h1>Careers
                                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text </span>
                                    </h1>
                                    <div class="creerText table-responsive">
                                            <?php
                                                if(isset($careers) && is_array($careers) && count($careers)>0){
                                                   ?>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                      <th>TITLE</th>
                                                      <th>TEAM</th>
                                                      <th>CITY</th>
                                                      <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   <?php
                                                    foreach($careers as $career){
                                                       $job_type ="";
                                                       if(isset($jobTypes[$career['Career']['job_type']])){
                                                            $job_type="( ".$jobTypes[$career['Career']['job_type']]." )";
                                                       }
                                                       ?>
                                                       <tr>
                                                            <td><?php
                                                                echo ucwords($career['Career']['job_title'])." ".$job_type;
                                                            ?></td>
                                                            <td><?php echo ucwords($career['Career']['job_role']);?></td>
                                                            <td><?php echo ucwords($career['Career']['city']);?></td>
                                                            <td style="width:174px;">
                                                                  <input class="viewapply" value="View" type="submit" jobdtl="<?=json_encode($career['Career'])?>" job_id="<?=$career['Career']['id']?>">
                                                                  <input class="viewapply" value="Apply" type="submit" job_id="<?=$career['Career']['id']?>">
                                                            </td>
                                                        </tr>
                                                       <?php 
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <h3>There is nothing available right now</h3>
                                                    <?php
                                                }
                                            ?>
                                            <div class="crl"></div>
                                    </div>
                            </div>
                    </div>
            </div>
    </div>
</div>

<div class="apply_popup" style="display:none">
	<div class="subApply" style="display:none">
		<div>
			<h3>Apply Form</h3>
			<form action="demo_form.asp" method="get">
				<table class="formTable">
					<tr>
						<td style="width:105px;">Full Name</td>
						<td><input class="popupName" name="email" value="" placeholder="Please Enter Name" type="name"></td>
					</tr>
					<tr>
						<td>Email Id</td>
						<td><input class="popupName" name="email" value="" placeholder="Please Enter Email" type="email"></td>
					</tr>
					<tr>
						<td>Mobile No.</td>
						<td><input class="popupName" name="email" value="" placeholder="Please Enter mobile no." type="mobile"></td>
					</tr>
					<tr>
						<td>Uplode CV</td>
						<td><input type="file" name="img"></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input class="popup_button" id="" value="Submit" type="submit">
							<button type="reset" class="popup_button2" value="Reset">Reset</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div class="cross_pop">
			<a href="javascript:void(0);"><img src="<?=$config['BaseUrl']?>img/cross2.png" class="cr_bg"/></a>
		</div>
	</div>

	<div class="subApply2">
		<div>
			<h3>Title</h3>
			<h4>Job Role</h4>
			<h5>salary : <span>8000/-</span></h5>
			<h2>kolkata west bengal
				<span>vacancy : 5</span>
			</h2>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
			<input class="popup_button" id="" value="Apply" type="submit">
		</div>
		<div class="cross_pop">
			<a href="javascript:void(0);"><img src="<?=$config['BaseUrl']?>img/cross2.png" class="cr_bg"/></a>
		</div>
	</div>
</div>