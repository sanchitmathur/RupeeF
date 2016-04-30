<?php
App::uses('AppController', 'Controller');
/**
 * AdminUsers Controller
 *
 * @property AdminUser $AdminUser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AdminUsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Thumb');

/**
 * admin_changepassword method
 * 
 */
	public function admin_changepassword(){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		if($this->request->is('post')){
			$admin_id = $this->Session->read('adminuser.id');
			
			$posteddata = isset($this->request->data['AdminUser'])?$this->request->data['AdminUser']:array();
			if(is_array($posteddata) && count($posteddata)>0){
				$old_password = isset($posteddata['old_password'])?$posteddata['old_password']:'';
				$new_password = isset($posteddata['new_password'])?$posteddata['new_password']:'';
				$confirm_password = isset($posteddata['confirm_password'])?$posteddata['confirm_password']:'';
				//validation
				if($new_password!=''){
					if($new_password==$confirm_password){
						//old password validate
						$findcond = array(
							'AdminUser.id'=>$admin_id,
							'AdminUser.is_deleted'=>'0',
							'AdminUser.is_active'=>'1',
							//'AdminUser.password'=>md5($old_password)
						);
						$updata = array('AdminUser.password'=>"'".md5($new_password)."'");
						$this->AdminUser->updateAll($updata,$findcond);
						$this->Session->setFlash(__('Your password change successfully'),'default',array('class'=>'success'));
						return $this->redirect(array('action'=>'changepassword'));
					}
					else{
						// confirm password missmatched
						$this->Session->setFlash(__('You confirmation password does not matched'));
					}
				}
				else{
					//password not blank
					$this->Session->setFlash(__('Enter your new password'));
				}
			}
			
		}
	}
	
/**
 * admin_forgotpassword method
 * 
 */
	public function admin_forgotpassword(){
		$this->layout="admindefault";
		//$this->adminsessionchecked();
		if($this->request->is('post')){
			$posteddata = isset($this->request->data['AdminUser'])?$this->request->data['AdminUser']:array();
			if(is_array($posteddata) && count($posteddata)>0){
				$email = isset($posteddata['email'])?$posteddata['email']:'';
				//email validate
				if(filter_var($email,FILTER_VALIDATE_EMAIL)){
					//now validate the email present or not in the server
					$findcond = array(
						'AdminUser.email'=>$email,
						'AdminUser.is_active'=>'1',
						'AdminUser.is_deleted'=>'0'
					);
					$adminuser = $this->AdminUser->find('first',array('conditions'=>$findcond));
					if(is_array($adminuser) && count($adminuser)>0){
						$siteurl = $this->sitebasepath();
						$resetpasswordlink = $siteurl."admin/AdminUsers/resetpassword";
						$tocken = strtotime("+1 day");
						$adminuser_id = $adminuser['AdminUser']['id'];
						$valiedtiken = base64_encode($tocken."_".$adminuser_id);
						$mailtype=$this->emailSendResetPassword;
						$from=array();
						$to=$email;
						
						$data = array(
							'reciever_name'=>$adminuser['AdminUser']['name'],
							'sitelink'=>$resetpasswordlink."/".$valiedtiken
						);
						
						$this->siteemailnotification($mailtype,$from,$to,$data);
						//now update the link
						$updata = array('AdminUser.reset_token'=>"'".$valiedtiken."'");
						$this->AdminUser->updateAll($updata,$findcond);
						//pr($data);
						$this->Session->setFlash(__('A reset password link send to your email'),'default',array('class'=>'success'));
						return $this->redirect(array('controller'=>'MainServices','action'=>'login'));
					}
					else{
						$this->Session->setFlash(__('Your provided email does not exists'));
					}
				}
				else{
					$this->Session->setFlash(__('Please provide valid email'));
				}
			}
			else{
				$this->Session->setFlash(__('Invalid request made'));
			}
		}
	}
	
/**
 * admin_resetpassword method
 * @param string $token
 * 
 */
	public function admin_resetpassword($token=''){
		$is_return=true;
		$admin_id=0;
		if($token!=''){
			if($this->request->is('post')){
				$posteddata = isset($this->request->data['AdminUser'])?$this->request->data['AdminUser']:array();
				if(is_array($posteddata) && count($posteddata)>0){
					$new_password = isset($posteddata['new_password'])?$posteddata['new_password']:'';
					$confirm_password = isset($posteddata['confirm_password'])?$posteddata['confirm_password']:'';
					$admin_id = isset($posteddata['admin_id'])?$posteddata['admin_id']:'0';
					$reset_token = isset($posteddata['reset_token'])?$posteddata['reset_token']:'';
					//validation
					if($new_password!=''){
						if($new_password==$confirm_password){
							//old password validate
							$findcond = array(
								'AdminUser.id'=>$admin_id,
								'AdminUser.is_deleted'=>'0',
								'AdminUser.is_active'=>'1',
								'AdminUser.reset_token'=>$reset_token
							);
							$adminuser = $this->AdminUser->find('first',array('conditions'=>$findcond));
							if(is_array($adminuser) && count($adminuser)>0){
								$updata = array(
									'AdminUser.password'=>"'".md5($new_password)."'",
									'AdminUser.reset_token'=>''
								);
								$this->AdminUser->updateAll($updata,$findcond);
								//send email
								$mailtype = $this->emailSendUpdatePassword;
								$to = $adminuser['AdminUser']['email'];
								$from=array();
								$data = array(
									'reciever_name'=>$adminuser['AdminUser']['name']
								);
								$this->siteemailnotification($mailtype,$from,$to,$data);
								$this->Session->setFlash(__('Your password change successfully'),'default',array('class'=>'success'));
							}
							else{
								$this->Session->setFlash(__('Link expired or invalid request'));
							}
						}
						else{
							$is_return=false;
							// confirm password missmatched
							$this->Session->setFlash(__('You confirmation password does not matched'));
						}
					}
					else{
						$is_return=false;
						//password not blank
						$this->Session->setFlash(__('Enter your new password'));
					}
				}
				else{
					$this->Session->setFlash(__('Invalid request send'));
				}
			}
			else{
				$usertoken = base64_decode($token);
				$tokendata = explode("_",$usertoken);
				if(count($tokendata)==2){
					$admin_id = $tokendata[1];
					$valiedtime = $tokendata[0];
					$currenttime = time();
					if($currenttime>$valiedtime){
						$this->Session->setFlash(__('Link expired'));
					}
					else{
						//now validate the request
						$finduser = array(
							'AdminUser.reset_token'=>$token,
							'AdminUser.id'=>$admin_id
						);
						
						$adminuser = $this->AdminUser->find('first',array('conditions'=>$finduser));
						
						if(is_array($adminuser) && count($adminuser)>0){
							$is_return=false;
							//valied section
						}
						else{
							$this->Session->setFlash(__('Invalid link'));
						}
					}
				}
				else{
					$this->Session->setFlash(__('Invalid token'));
				}
			}
		}
		else{
			$this->Session->setFlash(__('Invalid request'));
		}
		
		if($is_return){
			return $this->redirect(array('controller'=>'MainServices','action'=>'login'));
		}
		else{
			$this->set('reset_token',$token);
			$this->set('admin_id',$admin_id);
		}
		
	}
 
}
