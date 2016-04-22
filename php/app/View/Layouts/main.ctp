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
		echo $this->Html->css(array('style_sheet','responsive','font-awesome','bootstrap/bootstrap','bootstrap/bootstrap-theme.css'));
		echo $this->Html->script(array('jquery-2.2.0','bootstrap.min'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		$config = Configure::read('RupeeForadian');
		$userglobal_session_id = $this->Session->read('session_id');
	?>
	<!-- update not login users session value -->
	
	<script type="text/javascript">
		var user_current_session_id = "<?=$userglobal_session_id?>";
		var user_old_session_id = "";
		var rfchartsesid="rfchartsesid";
		var cookielifetime=365;
		
		$(document).ready(function(){
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
	</script>
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?3rJDviaCQPhXIhMJ1JfrIwEHwdCSFUYN";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
</head>
<body>
	<div class="wraperr">
		<div id="container">
		
			<div id="header">
				<?php echo $this->element('header'); ?>
			</div>
			
			<div id="content">
				<?php echo $this->Session->flash(); ?>

				<?php echo $this->fetch('content'); ?>
			</div>
			
			<div id="footer">
				<?php echo $this->element('footer'); ?>
			</div>
			
		</div>
		<?php //echo $this->element('sql_dump'); ?>
	</div>
</body>
</html>
