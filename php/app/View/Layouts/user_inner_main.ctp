<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<?php echo $this->Html->charset(); ?>
	<title>Rupee Foradian</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css(array('before_login','responsive','font-awesome','bootstrap/bootstrap','bootstrap/bootstrap-theme.css'));
		echo $this->Html->script(array('jquery-2.2.0','bootstrap.min'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		$config = Configure::read('RupeeForadian');
		$userglobal_session_id = $this->Session->read('session_id');
		$currentcontact = "";
		$params = $this->params->params;
		//pr($params);
		$currentcontact = strtolower($params['controller'].$params['action']);
		
		$rightheaderpadding="";
		if($currentcontact=="userscommunication"){
			$rightheaderpadding = "padding:0 0 10px 50px;";
		}
	?>
	<!-- update not login users session value -->
	
	<script type="text/javascript">
		var user_current_session_id = "<?=$userglobal_session_id?>";
		var user_old_session_id = "";
		var rfchartsesid="rfchartsesid";
		var cookielifetime=365;
		
		$(document).ready(function(){
			$(".before_Menunav ul .active").bind('click',noredirect);
			$(".ask_expert .active").bind('click',noredirect);
			hideFlashMessage();
			//get the user store session id
			user_old_session_id = getCookie(rfchartsesid);
			if (user_old_session_id!='' && user_old_session_id!='0') {
				//sesson found
				if (user_old_session_id != user_current_session_id) {
					//need to save in the cookie
					setCoockie(rfchartsesid,user_current_session_id,cookielifetime);
					console.log("saved session id : " + getCookie(rfchartsesid));
					//do ajax call for updating the session value
					var url = "<?=$config['BaseUrl']?>UserCarts/usersessionvalueupdate";
					$.ajax({
						url:url,
						type:'post',
						dataType:'json',
						data:{old_session_id:user_old_session_id,new_session_value:user_current_session_id},
						success:function(response){
							console.log(response);
						},
						error:function(response){
							console.log(response);
						}
					});
				}
				else{
					//no need to do anything
					console.log("session id is same");
				}
			}
			else{
				console.log("session id not found ");
				setCoockie(rfchartsesid,user_current_session_id,cookielifetime);
				console.log("fresh saved session id : " + getCookie(rfchartsesid));
			}
		});
		
		function noredirect(e) {
			e.preventDefault();
		}
		
		function setCoockie(cname,cvalue,exdays){
			var d = new Date();
			d.setTime(d.getTime() + (exdays*24*60*60*1000));
			var expires = "expires="+d.toUTCString();
			var path="path=/";
			document.cookie = cname + "=" + cvalue + "; " + expires +"; "+ path;
		}
		function getCookie(cname){
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i=0; i<ca.length; i++) {
			    var c = ca[i];
			    while (c.charAt(0)==' ') c = c.substring(1);
			    if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
			}
			return "";
		}
		function hideFlashMessage(){
			setTimeout(
				function(){
					$('#flashMessage').slideUp(300);
				},
				5000
			);
		}
	</script>
	<style>
		.message {
			z-index: 100;
			/*position: absolute;*/
			width: 100%;
			padding: 10px;
			text-align: center;
			background-color: rgba(253, 203, 24, 0.85);
			color: rgb(255, 255, 255);
			font-weight: 300;
			box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);
		}
		.error{
			z-index: 100;
			/*position: absolute;*/
			width: 100%;
			padding: 10px;
			text-align: center;
			background-color: red;
			color: rgb(255, 255, 255);
			font-weight: 300;
			box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);
		}
	</style>
</head>
<body>
	<div class="wraperr">
		<div class="beforeLogin">
			<div class="col-md-2">
				<?php echo $this->element('logged_left_panel',array('currentcontact'=>$currentcontact));?>
			</div><!--end_leftpert-->
			<div class="col-md-10" style="padding-right:0;">
				<div class="right_beforelogin">
					<div class="rightHeader">
						<?php echo $this->element('logged_header',array('currentcontact'=>$currentcontact));?>
						<div class="clr"></div>
					</div>
					
					<div class="right_beforebody" style="<?=$rightheaderpadding?>">
						
						<?php echo $this->Session->flash(); ?>
	
						<?php echo $this->fetch('content'); ?>
					</div>
					
				</div><!--end_rightpert-->
			</div>
			<div class="clr"></div>
		</div>
		<?php //echo $this->element('sql_dump'); ?>
	</div>
</body>
</html>
