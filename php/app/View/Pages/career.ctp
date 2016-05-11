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
                                        <span>Inspiring, Empowering, Rewarding, Fun. These are some of the words people commonly use to describe their careers at RF. </span>
                                    </h1>
									<div class="careers_small">
										<p>Our small team is growing fast. Come and be a part of the team. We'll be happy to hear from you. Drop us an email at <a href="javascript:void(0);">careers@rupeeforadian.com</a></p>
										
									</div>
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
                                                                  <input class="viewapply jobview" value="View" type="submit" jobdtl='<?=json_encode($career['Career'])?>' job_id="<?=$career['Career']['id']?>">
                                                                  <input class="viewapply jobapply" value="Apply" type="submit" job_id="<?=$career['Career']['id']?>">
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

<script type="text/javascript">
    var jobtypes = $.parseJSON('<?=json_encode($jobTypes)?>');
    var chooseJobId=0;
    var errColor="red";
    var succColor="#126abf";
    var baseurl="<?=$sitepath?>";
    var jobrequest="jobApplicants/applyjob";
    
    $(document).ready(function(){
        $(".jobview").bind('click',viewJobDetails);
        $(".jobapply").bind('click',applyToTheJob);
        $(".cross_pop a").bind('click',cloaseTheViewApllySection);
        $("#jobapply").bind('click',viwedJobApply);
        $("#applionjob").bind('click',applyOnTheJob);
        $(".frmvalied").bind('focusout',frmfieldvalidate);
    });
    
    function viewJobDetails(e) {
        $(".apply_popup").show();
        
        var career = $.parseJSON($(e.currentTarget).attr('jobdtl'));
        //console.log(career);
        //console.log(career.job_title);
        //console.log(jobtypes[career.job_type]);
        
        $("#jobtitle").html(career.job_title+" ("+jobtypes[career.job_type]+" )");
        $("#jobrole").html(career.job_role);
        $("#jobcity").html(career.city);
        $("#jobsalary").html(career.monthly_salary);
        $("#jobdesc").html(career.job_description);
        $("#jobapply").attr('job_id',career.id);
        $(".subApply2").show();
        
    }
    
    function viwedJobApply(e){
        $(".subApply2").hide();
        chooseJobId = $(e.currentTarget).attr('job_id');
        $(".subApply").show();
    }
    
    function applyToTheJob(e) {
        $(".apply_popup").show();
        $(".subApply").show();
        chooseJobId = $(e.currentTarget).attr('job_id');
    }
    
    function cloaseTheViewApllySection(e) {
        $(".apply_popup").hide();
        $(".subApply").hide();
        $(".subApply2").hide();
        chooseJobId=0;
    }
    
    function applyOnTheJob(e){
        e.preventDefault();
        //validate the sections
        var name="";
        var email="";
        var mobile="";
        var files="";
        
        if (chooseJobId>0) {
            //validate form
            var formValidate = true;
            
            $.each($(".frmvalied"),function(i,item){
                var itemval = $.trim($(item).val());
                var itemtype = $(item).attr('type');
                console.log('val : '+itemval+" type : "+itemtype);
                switch (itemtype) {
                    case "name":
                        if (itemval=='') {
                            formValidate=false;
                            $(item).attr('style','border:1px solid '+errColor+';');
                        }
                        else{
                            name=itemval;
                            $(item).attr('style','border:1px solid '+succColor+';');
                        }
                        break;
                    case "email":
                        if (!isEmail(itemval)) {
                            formValidate=false;
                            $(item).attr('style','border:1px solid '+errColor+';');
                        }
                        else{
                            email=itemval;
                            $(item).attr('style','border:1px solid '+succColor+';');
                        }
                        break;
                    case "mobile":
                        if (itemval=='' || !$.isNumeric(itemval) ) {
                            formValidate=false;
                            $(item).attr('style','border:1px solid '+errColor+';');
                        }
                        else{
                            mobile=itemval;
                            $(item).attr('style','border:1px solid '+succColor+';');
                        }
                        break;
                    case "file":
                        if (itemval=='') {
                            formValidate=false;
                            $(item).attr('style','border:1px solid '+errColor+';');
                        }
                        else{
                            files=item.files[0];
                            console.log(files);
                            $(item).attr('style','border:1px solid '+succColor+';');
                            
                        }    
                        break;
                    default:
                        break;
                }
            });
            //submit the  request
            if (formValidate) {
                //now do the ajax call
                var fd = new FormData();
                fd.append('name',name);
                fd.append('email',email);
                fd.append('mobile',mobile);
                fd.append('cvdoct',files);
                fd.append('career_id',chooseJobId);
                //now call the server
                $.ajax({
                    url:baseurl+jobrequest,
                    type:'post',
                    dataType:'json',
                    contentType:false,
                    processData:false,
                    data:fd,
                    success:function(response){
                        console.log(response);
                        if (response.status>0) {
                            cloaseTheViewApllySection();
                            $.each($(".frmvalied"),function(i,item){
                                $(item).val('');
                            });
                            alert(response.message);
                        }
                        else{
                            alert(response.message);
                        }
                    },
                    error:function(response){
                        console.log(response);
                    }
                });
            }
        }
        else{
            //do nothing
        }
    }
    
    function frmfieldvalidate(e){
        var item = $(e.currentTarget);
        
        var itemval = $.trim($(item).val());
        var itemtype = $(item).attr('type');
        console.log('val : '+itemval+" type : "+itemtype);
        switch (itemtype) {
            case "name":
                if (itemval=='') {
                    $(item).attr('style','border:1px solid '+errColor+';');
                }
                else{
                    $(item).attr('style','border:1px solid '+succColor+';');
                }
                break;
            case "email":
                if (!isEmail(itemval)) {
                    $(item).attr('style','border:1px solid '+errColor+';');
                }
                else{
                    $(item).attr('style','border:1px solid '+succColor+';');
                }
                break;
            case "mobile":
                if (itemval=='' || !$.isNumeric(itemval) || itemval < 0) {
                    $(item).attr('style','border:1px solid '+errColor+';');
                }
                else{
                    $(item).attr('style','border:1px solid '+succColor+';');
                }
                break;
            case "file":
                if (itemval=='') {
                    $(item).attr('style','border:1px solid '+errColor+';');
                }
                else{
                    $(item).attr('style','border:1px solid '+succColor+';');
                    var file = e.currentTarget.files[0];
                    console.log(file);
                }    
                break;
            default:
                break;
        }
    }
    
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
</script>

<div class="apply_popup" style="display:none">
	<div class="subApply" style="display:none">
		<div>
			<h3>Apply Form</h3>
			<form action="" method="get">
				<table class="formTable">
					<tr>
						<td style="width:105px;">Full Name</td>
						<td><input class="popupName frmvalied" name="email" value="" placeholder="Please Enter Name" type="name"></td>
					</tr>
					<tr>
						<td>Email Id</td>
						<td><input class="popupName frmvalied" name="email" value="" placeholder="Please Enter Email" type="email"></td>
					</tr>
					<tr>
						<td>Mobile No.</td>
						<td><input class="popupName frmvalied" name="email" value="" placeholder="Please Enter mobile no." type="mobile"></td>
					</tr>
					<tr>
						<td>Uplode CV</td>
						<td><input type="file" name="img" class="frmvalied" ></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input class="popup_button" id="applionjob" value="Submit" type="submit">
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

	<div class="subApply2" style="display:none">
		<div>
			<h3 id="jobtitle">Title</h3>
			<h4 id="jobrole">Job Role</h4>
			<h5>salary : <span id="jobsalary">8000/-</span></h5>
                        <h5>location : <span id="jobcity">Kolkata</span></h5>
                        <h5>vacancy : <span id="jobsalary">5</span></h5>
                        
			<!--<h2>kolkata west bengal
				<span>vacancy : 5</span>
			</h2>-->
                        
			<p id="jobdesc"></p>
			<input class="popup_button" id="jobapply" value="Apply" type="submit" job_id="0">
		</div>
		<div class="cross_pop">
			<a href="javascript:void(0);"><img src="<?=$config['BaseUrl']?>img/cross2.png" class="cr_bg"/></a>
		</div>
	</div>
</div>