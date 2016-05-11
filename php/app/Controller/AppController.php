<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	//Facebook App ID & App Secret
	public $APP_ID = '831739943597878';
	public $APP_SECRET = '74739fdb7f1869613fd0e8288a94e3b0';
	
	//Google Client ID & Client Secret
	/*public $CLIENT_ID = '683114562708-ki5aombr7qvlq0981nssrrj90pdfegtb.apps.googleusercontent.com';
	public $CLIENT_SECRET = 'aTfcg3C1wztVD0gFe0-to1NI';*/
	
	public $CLIENT_ID = '859474289527-a0pvl63cr0rn5n3nm3jt2svc8sh9q0oh.apps.googleusercontent.com';
	public $CLIENT_SECRET = '1472Vtz72DCJsNfZvkjGc09v';
	public $COOKIE_LIFE_TIME = 365;
	
	public $thumbImageHeight=400;
	public $thumbImageWidth=400;
	
	public $allowedimageType=array('image/png','image/jpg','image/jpeg');
	public $google_mape_user_api_key="AIzaSyC6_a4N5vVm6upRF3pF0TJbbDrC-_1UMSQ";
	
	// service process progress status sections
	public $serviceProgressStatusServiceSubmit='0';
	public $serviceProgressStatusDocUploaded='1';
	public $serviceProgressStatusDocRejected='2';
	public $serviceProgressStatusDocProvidedByAdmin='3';
	
	//site date format
	public $sitedatedisplayformat = "F d, Y";
	
	//email type section
	public $emailSendResetPassword='0';
	public $emailSendUpdatePassword='1';
	public $emailSendNewRegistration='2';
	public $emailSendUserUploadDocument='3';
	public $emailSendAdminUploadDocument='4';
	public $emailSendAdminRejectDocument='5';
	public $emailSendAdminApprovedDocument='6';
	public $emailSendUserBuyService='7';
	
/**
 * getCityList method
 *
 * @return array
 */
	public function getCityList(){
		$this->loadModel('City');
		$cities = array();
		
		$cond = array(
			'City.is_blocked'=>'0',
			'City.is_deleted'=>'0',
		);
		
		$option = array(
			'conditions'=>$cond
		);
		
		$cities = $this->City->find('list',$option);
		
		return $cities;
	}
	
/**
 * getLanguageList method
 *
 * @return array
 */
	public function getLanguageList(){
		$this->loadModel('Language');
		$languages = array();
		
		$cond = array(
			'Language.is_blocked'=>'0',
			'Language.is_deleted'=>'0',
		);
		
		$option = array(
			'conditions'=>$cond
		);
		
		$languages = $this->Language->find('list',$option);
		
		return $languages;
	}
	
/**
 * numberOfItemInCart method
 *
 * @return int
 */
	public function numberOfItemInCart(){
		$this->loadModel('UserCart');
		
		$user = $this->Session->read('user');
		$user_id = isset($user['user_id'])?$user['user_id']:0;
		$session_id = $this->Session->read('session_id');
		$lifetime=$this->COOKIE_LIFE_TIME;
		
		$cond = array(
			'UserCart.is_active'=>1,
			'UserCart.is_deleted'=>0,
		);
		if($user_id>0){
			$cond['UserCart.user_id']=$user_id;	
		}
		else{
			$cond['UserCart.session_id']=$session_id;
		}
		//pr($cond);
		//die("lll");
		/*$cond = array(
			//'UserCart.user_id'=>$user_id,
			'OR'=>array(
				'UserCart.user_id'=>$user_id,
				'UserCart.session_id'=>$session_id,
			),
			'UserCart.is_active'=>1,
			'UserCart.is_deleted'=>0,
		);*/
		
		$option = array(
			'conditions'=>$cond
		);
		$cartItemNo = $this->UserCart->find('count',$option);
		//$this->set('cartItemNo',$cartItemNo);
		//return $cartItemNo;
		//$this->Session->delete('cartItemNo');
		$this->Session->write('cartItemNo',$cartItemNo);
	}
	
/**
 * getServiceTax method
 *
 * @return void
 */
	public function getServiceTax(){
		$this->loadModel('ServiceTax');
		
		$cond = array(
			'ServiceTax.is_active'=>1,
			'ServiceTax.is_deleted'=>0
		);
		$option = array(
			'conditions'=>$cond
		);
		$serviceTax = $this->ServiceTax->find('first',$option);
		return $serviceTax;
	}
	
/**
 * updatecartitemwithuser method
 * @return bool
 */
	public function updatecartitemwithuser(){
		$this->loadModel('UserCart');
		$user = $this->Session->read('user');
		$user_id = isset($user['user_id'])?$user['user_id']:0;
		$session_id = $this->Session->read('session_id');
		if($user_id>0){
			if($session_id!=''){
				//now update the user all curt with the logged user id
				$updatecond = array('UserCart.session_id'=>$session_id,'UserCart.user_id'=>'0','UserCart.is_deleted'=>'0','UserCart.is_active'=>'1');
				$updatedata = array('UserCart.user_id'=>$user_id);
				$this->UserCart->updateAll($updatedata,$updatecond);
			}
			else{
				//session not set
			}
		}
		else{
			//user nor login
		}
		return true;
	}
	
/**
 * generatepurchasehax method
 * @param string
 * @return string
 */
	public function generatepurchasehax($user_id=0){
		$purchasehax="";
		$time = time();
		$hascode = $time."_".$user_id;
		$purchasehax = base64_encode($hascode);
		return $purchasehax;
	}
	
/**
 * loggeduserredirect method
 */
	public function loggeduserredirect(){
		if($this->Session->check('user')){
			return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
		}
	}

/**
 * usersessionchecked method
 */
	public function usersessionchecked(){
		if(!$this->Session->check('user')){
			return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
		}
	}
	
/**
 * replacespecialcharacter method
 *
 * @return string
 */
    public function replacespecialcharacter($string=''){
        $replacecharacter = array('^',' ','*','<','>','$','#','@','!','%');
        if($string!=''){
            $string = str_replace($replacecharacter,'_',$string);
        }
        return $string;
    }
    
/**
 * alltypefilepaths method
 *
 * @return array
 */
    public function alltypefilepaths(){
        $sitebasepath = $this->sitebasepath();
        
        $alltypefilepath = array(
            'url'=>array(
                'userdocument'=>$sitebasepath.'userdocuments/',
                'userdocument_thumb'=>$sitebasepath.'userdocuments/thumb_',
		'applicant_cv'=>$sitebasepath.'applicant_cv/',
            ),
            'dic'=>array(
                'userdocument'=>WWW_ROOT.'userdocuments/',
                'userdocument_thumb'=>WWW_ROOT.'userdocuments/thumb_',
		'applicant_cv'=>WWW_ROOT.'applicant_cv/',
            )
        );
        return $alltypefilepath;
    }

/**
 * sitebasepath method
 *
 * @return string
 */
    public function sitebasepath(){
        $sitebasepath = Router::fullbaseUrl().$this->base;
        $lstchar = substr($sitebasepath,-1);
        if($lstchar!="/"){
            $sitebasepath.="/";
        }
        
        return $sitebasepath;
    }
    
/**
 * admin section section done here
 */

 /**
  * adminsessionchecked method
  *
  * @return void
  */
	public function adminsessionchecked(){
		if(!$this->Session->check('adminuser')){
			//redirect for login
			return $this->redirect(array('controller'=>'MainServices','action'=>'login'));
		}
	}
	
/**
  * adminsessionpresent method
  *
  * @return void
  */
	public function adminsessionpresent(){
		if($this->Session->check('adminuser')){
			//redirect for login
			return $this->redirect(array('controller'=>'Menus','action'=>'index'));
		}
	}
	
/**
 * serviceProgressStatus method
 *
 * @return array $serviceProgressStatus
 */
	public function serviceProgressStatus(){
		$serviceProgressStatus = array(
			$this->serviceProgressStatusServiceSubmit=>'Service Submited',
			$this->serviceProgressStatusDocUploaded=>'Document Uploaded',
			$this->serviceProgressStatusDocRejected=>'Document Rejected',
			$this->serviceProgressStatusDocProvidedByAdmin=>'Admin Upload Ducument',
		);
		return $serviceProgressStatus;
	}
	
/**
 * cityregion method
 *
 * @return array $cityregions
 */
	public function cityregion(){
		$cityregions=array(
			'1'=>'North East India',
			'2'=>'North West India',
			'3'=>'South EAST India',
			'4'=>'South West India'
		);
		return $cityregions;
	}

/**
 * allnotificationsection method
 * 
 */
	public function allnotificationsection($notify_type=-1,$user_id=0,$is_email_send='0',$emaildata=array()){
		if($notify_type>-1){
			$this->loadModel('Notification');
			$notify_txt='';
			$notify_date=date('Y-m-d H:i:s');
			$reciever_email=isset($emaildata['email'])?$emaildata['email']:'';
			
			switch($notify_type){
				case $this->emailSendNewRegistration:
					$notify_txt="Welcome, We here to help you.";
					$this->admintousercommunicate($user_id);
					
					break;
				case $this->emailSendResetPassword:
					$notify_txt="";
					break;
				case $this->emailSendUpdatePassword:
					$notify_txt="You Successfully Update your password";
					break;
				case $this->emailSendAdminApprovedDocument:
					$notify_txt="One Document of your is approved by the admin";
					break;
				case $this->emailSendAdminRejectDocument:
					$notify_txt="One Document of your is rejected by the admin";
					break;
				case $this->emailSendAdminUploadDocument:
					$notify_txt="Admin upload a document for you";
					break;
				case $this->emailSendUserBuyService:
					$notify_txt="You successfully buy our services";
					break;
				case $this->emailSendUserUploadDocument:
					$notify_txt="You upload a duccument";
					break;
				default:
					$notify_txt="";
					break;
			}
			
			if($notify_txt!=''){
				$savedata = array(
					'Notification'=>array(
						'user_id'=>$user_id,
						'notify_txt'=>$notify_txt,
						'notify_date'=>"'".$notify_date."'",
						'is_user_deleted'=>'0'
					)
				);
				$this->Notification->save($savedata);
			}
			
			//now send the email about this notification
			if($is_email_send){
				
				$this->siteemailnotification($notify_type,array(),$reciever_email,$emaildata);
			}
		}
		else{
			//no need to tracked
		}
	}
	
/**
 * admintousercommunicate method
 * 
 */
	public function admintousercommunicate($user_id=0,$admin_id=0){
		if($user_id>0){
			$create_date=date('Y-m-d H:i:s');
			$this->loadModel('Communication');
			$message="Welcome, We are here to help you.";
			$savedaata = array(
				'Communication'=>array(
					'user_id'=>'0',
					'admin_user_id'=>$admin_id,
					'reciever_id'=>$user_id,
					'message'=>$message,
					'is_user_post'=>'0',
					'create_date'=>$create_date,
					'is_deleted'=>'0'
				)
			);
			//pr($savedaata);
			
			$this->Communication->save($savedaata);
		}
		//die();
	}
	
	
/**
 * siteemailnotification method
 * 
 */
	public function siteemailnotification($mailtype=-1,$from=array(),$to='',$data=array()){
		//data formate
		/*
			$data = array(
				'reciever_name'=>'',
				'body_text'=>'',
				
			);
		*/
		
		if($mailtype<0){
			return false;
		}
		//data config section
		$revertemail='';
		$body_text='test template mail';
		$subject="";
		$layoutname='rupeeforadianemail';
		$templatename='sitemailtemp';
		$linktitle="";
		if(!is_array($from) || (is_array($from) && count($from)==0)){
			$from=array('noreply@rupeeforadian.com'=>'RupeeForadian');
		}
		if(!filter_var($to,FILTER_VALIDATE_EMAIL)){
			$revertemail = $to;
			$to="adminrevert@ruppeforadian.com";
		}
		
		switch($mailtype){
			case $this->emailSendResetPassword:
				$body_text="Your password resest link valied for till next day";
				$subject="Password reset link";
				break;
			case $this->emailSendUpdatePassword:
				$body_text="You Successfully update your password";
				$subject="Password update";
				break;
			case $this->emailSendNewRegistration:
				$body_text="Congratulations on taking your first step toward making a simple life. Now you concentrate on your expertise area and we take care of all you CA/CA compliances etc";
				$subject="Welcome to Rupee Foradian";
				$linktitle="Click to access your dashboard";
				//for time being
				$body_text.="Greeting from team Rupee Foradian";
				$body_text.=" </br> </br> \n\n ";
				$body_text.="Following is your credentials to easily access our platform : </br> \n ";
				$body_text.=" Email : ".isset($data['email'])?$data['email']:$to." </br> \n ";
				$body_text.=" Password : ".isset($data['password'])?$data['password']:'';
				$body_text.=" </br></br> \n\n";
				break;
			case $this->emailSendAdminApprovedDocument:
				$body_text="One of your uploded document approved by the admin";
				$subject="RupeeForadian approved your one uploaded document";
				break;
			case $this->emailSendAdminRejectDocument:
				$body_text="One of your uploded document rejected by the admin";
				$subject="RupeeForadian reject your one uploaded document";
				break;
			case $this->emailSendAdminUploadDocument:
				$body_text="RuppeForadian upload a document for you";
				$subject="RupeeForadian upload a new document";
				break;
			case $this->emailSendUserBuyService:
				$service_name = isset($data['service_name'])?$data['service_name']:'';
				$body_text="Your service booking for ".$service_name." was successful and we are immediately taking action on this. You can track the progress from dashboard.";
				$body_text.=" </br> An invoice copy of this transaction is attached. </br></br>";
				
				$subject=$service_name." booked successfully";
				break;
			case $this->emailSendUserUploadDocument:
				$body_text="You upload a new document";
				$subject="One Document Uploaded";
				break;
			default:
				break;
		}
		
		$data['body_text']=$body_text;
		$data['linktitle']=$linktitle;
		//for test
		//$data['body_text']=$body_text." </br> Sending data : ".json_encode($data);
		//$to="mrintoryal@gmail.com";
		
		//mail send section
		$Email = new CakeEmail();
		$Email->from($from);
		$Email->to($to);
		$Email->subject($subject);
		$Email->emailFormat('html');
		//$Email->layout($layoutname);
		$Email->template($templatename,$layoutname);
		$Email->viewVars($data);
		$Email->send();
		
		return true;
	}
	
/**
 * currencysymboles method
 * @return array $currencysymboles
 */
	public function currencysymboles(){
		$currencysymboles=array(
			'INR'=>'Rs.'
		);
		return $currencysymboles;
	}
	
/**
 * careerjobtypes method
 *
 * @return array $careerjobtypes
 */
	public function careerjobtypes(){
		$careerjobtypes = array(
			'1'=>'Part Time Jobs',
			'2'=>'Full Time Jobs',
		);
		return $careerjobtypes;
	}
	
/**
 * userservicepackageprograastatus method
 * @return array $serviceprogressstatus
 */
	public function userservicepackageprograastatus(){
		
	}
	
}
