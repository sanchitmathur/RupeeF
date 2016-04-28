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
            ),
            'dic'=>array(
                'userdocument'=>WWW_ROOT.'userdocuments/',
                'userdocument_thumb'=>WWW_ROOT.'userdocuments/thumb_',
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

}
