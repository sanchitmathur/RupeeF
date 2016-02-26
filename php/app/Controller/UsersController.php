<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * registration method
 *
 * @return void
 */
	public function registration(){
		$this->layout = "main";
		
		$service = array();
		if($this->request->is('post','put')){
			$reqdata = $this->request->data;
			
			$service_ids = isset($reqdata['service_ids'])?$reqdata['service_ids']:"";
			$service_package_ids = isset($reqdata['service_package_ids'])?$reqdata['service_package_ids']:"";
			
			$service_id = isset($reqdata['service_id'])?$reqdata['service_id']:0;
			$service_package_id = isset($reqdata['service_package_id'])?$reqdata['service_package_id']:0;
			$service = array(
				'service_ids'=>$service_ids,
				'service_package_ids'=>$service_package_ids,
			);
			$this->Session->write('service',$service);
		}
		$cities = $this->getCityList();
		$this->set(compact('cities'));
		
		$languages = $this->getLanguageList();
		$this->set(compact('languages'));
		
		//$this->set('service',$service);
	}
	
/**
 * signUp method
 *
 * @return void
 */
	public function signUp(){
		if($this->request->is('post','put')){
			$reqdata = $this->request->data;
			// pr($reqdata);
			// die();
			$registration = isset($reqdata['registration'])?$reqdata['registration']:0;
			$name = isset($reqdata['name'])?$reqdata['name']:"";
			$email = isset($reqdata['email'])?$reqdata['email']:"";
			$password = isset($reqdata['password'])?$reqdata['password']:"";
			$confpassword = isset($reqdata['confpassword'])?$reqdata['confpassword']:"";
			$phone_no = isset($reqdata['phone_no'])?$reqdata['phone_no']:"";
			$address = isset($reqdata['address'])?$reqdata['address']:"";
			$city_id = isset($reqdata['city'])?$reqdata['city']:0;
			$language_id = isset($reqdata['language'])?$reqdata['language']:0;
			
			if($name == ""){
				$this->Session->setFlash(__("Please enter name."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($email == ""){
				$this->Session->setFlash(__("Please enter email."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			$cond = array(
				'User.email'=>$email
			);
			$option = array(
				'conditions'=>$cond,
			);
			$userDataCount = $this->User->find('count',$option);
			if($userDataCount > 0){
				$this->Session->setFlash(__("Email already exist."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$this->Session->setFlash(__("Please enter valid email."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($password == ""){
				$this->Session->setFlash(__("Please enter password."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($confpassword == ""){
				$this->Session->setFlash(__("Please confirm password."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($password != $confpassword){
				$this->Session->setFlash(__("Password and confirm password doesn't match."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($address == ""){
				$this->Session->setFlash(__("Please enter address."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($city_id == 0){
				$this->Session->setFlash(__("Please select city."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($language_id == 0){
				$this->Session->setFlash(__("Please select language."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			$saveData = array(
				'User'=>array(
					'name'=>$name,
					'email'=>$email,
					'password'=>md5($password),
					'phone_no'=>$phone_no,
					'address'=>$address,
					'city_id'=>$city_id,
					'language_id'=>$language_id,
				)
			);
			$this->User->create();
			if($this->User->save($saveData)){
				$user_id = $this->User->id;
				$user = array(
					'user_id'=>$user_id,
					'name'=>$name,
					'email'=>$email
				);
				$this->Session->write('user',$user);
				
				$this->Session->setFlash(__("Sign up successfully."));
				
				/* $service = $this->Session->read('service');
				$service_id = isset($service['service_id'])?$service['service_id']:0;
				$service_package_id = isset($service['service_package_id'])?$service['service_package_id']:0; */
				
				/* $service_id = isset($reqdata['service_id'])?$reqdata['service_id']:0;
				$service_package_id = isset($reqdata['service_package_id'])?$reqdata['service_package_id']:0;
				
				if($service_id == 0){
					$this->Session->setFlash(__('Please select a service.'));
					return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
				}else{
					if($service_package_id == 0){
						$this->Session->setFlash(__('Please select a package.'));
						return $this->redirect(array('controller'=>'Services','action'=>'bussiness_service/'.$service_id));
					}else{
						return $this->redirect(array('controller'=>'Services','action'=>'addToCart'));
					}
				} */
				if($registration == 1){
					return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
				}else{
					return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
				}
			}else{
				$this->Session->setFlash(__("Error occured while sign up."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
		}else{
			$this->layout = "main";
			
			$cities = $this->getCityList();
			$this->set(compact('cities'));
			
			$languages = $this->getLanguageList();
			$this->set(compact('languages'));
		}
	}
	
/**
 * login method
 *
 * @return void
 */
	public function logIn(){
		$this->layout = "main";
		
		if($this->request->is('post','put')){
			$reqdata = $this->request->data;
			// pr($reqdata);
			// die();
			$registration = isset($reqdata['registration'])?$reqdata['registration']:0;
			$email = isset($reqdata['email'])?$reqdata['email']:"";
			$password = isset($reqdata['password'])?$reqdata['password']:"";
			
			if($email == ""){
				$this->Session->setFlash(__("Please enter email."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'logIn'));
				}
			}
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$this->Session->setFlash(__("Please enter valid email."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'logIn'));
				}
			}
			if($password == ""){
				$this->Session->setFlash(__("Please enter password."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'logIn'));
				}
			}
			
			$cond = array(
				'User.email'=>$email,
				'User.password'=>md5($password),
			);
			$option = array(
				'conditions'=>$cond,
			);
			$userData = $this->User->find('first',$option);
			// pr($userData);
			// die();
			
			if(is_array($userData) && count($userData)>0){
				$user_id = isset($userData['User']['id'])?$userData['User']['id']:0;
				$name = isset($userData['User']['name'])?$userData['User']['name']:"";
				$email = isset($userData['User']['email'])?$userData['User']['email']:"";
				$user = array(
					'user_id'=>$user_id,
					'name'=>$name,
					'email'=>$email
				);
				$this->Session->write('user',$user);
				
				/* $service = $this->Session->read('service');
				$service_id = isset($service['service_id'])?$service['service_id']:0;
				$service_package_id = isset($service['service_package_id'])?$service['service_package_id']:0; */
				
				/* $service_id = isset($reqdata['service_id'])?$reqdata['service_id']:0;
				$service_package_id = isset($reqdata['service_package_id'])?$reqdata['service_package_id']:0;
				
				if($service_id == 0){
					//$this->Session->setFlash(__('Please select a service.'));
					return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
				}else{
					if($service_package_id == 0){
						$this->Session->setFlash(__('Please select a package.'));
						return $this->redirect(array('controller'=>'Services','action'=>'bussiness_service/'.$service_id));
					}else{
						//return $this->redirect(array('controller'=>'Services','action'=>'addToCart'));
						return $this->redirect(array('controller'=>'Services','action'=>'saveToCart/'.$service_id.'/'.$service_package_id));
					}
				} */
				if($registration == 1){
					return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
				}else{
					return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
				}
			}
		}
	}
	
/**
 * facebookLogIn methohd
 *
 * @return void
 */
	public function facebookLogIn($registration=0){
		
		$client_id = $this->APP_ID;
		$client_secret = $this->APP_SECRET;
		
		$reqdata = $this->request->data;
		$code = isset($_REQUEST["code"])?$_REQUEST["code"]:null;
		$error_code = isset($_REQUEST["error_code"])?$_REQUEST["error_code"]:null;
		$state = md5(uniqid(rand(), TRUE)); // CSRF protection
		
		if(!empty($error_code) && $error_code==200){
			return $this->redirect(array('controller'=>'Users','action'=>'logIn'));
		}
		
		$redirect_uri = "http://mindscale.co.in/demo/RupeeForadian/Users/facebookLogIn/$registration";

		if(empty($code)){
			
			$oauth_url = "https://www.facebook.com/dialog/oauth?client_id=$client_id&redirect_uri=".urlencode($redirect_uri)."&state=$state&scope=publish_actions";
			//die();
			print("<script>window.location='$oauth_url'</script>");
			exit();
		}else{
			$token_url = "https://graph.facebook.com/oauth/access_token?client_id=$client_id&redirect_uri=".urlencode($redirect_uri)."&client_secret=$client_secret&code=$code";
			
			$response = file_get_contents($token_url);
			$params = null;
			parse_str($response,$params);
			//pr($params);
			
			$access_token = $params['access_token'];
			
			if($access_token == ''){
				$this->Session->setFlash(__("Some error occured while log in with Facebook."));
				return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
			}
			
			$graph_url = "https://graph.facebook.com/me?access_token=".$access_token."&fields=first_name,last_name,name,id,email";
			$userDetails = json_decode(file_get_contents($graph_url));
			// pr($userDetails);
			// die();
			
			$fb_id = $userDetails->id;
			$fb_email = $userDetails->email;
			$fb_name = $userDetails->name;
			$fb_first_name = $userDetails->first_name;
			$fb_last_name = $userDetails->last_name;
			
			$graph_url2 = "https://graph.facebook.com/".$fb_id."/picture?access_token=".$access_token."&redirect=false&type=large";
			$userPicture = json_decode(file_get_contents($graph_url2));
			// pr($userPicture);
			// die();
			$fb_image = isset($userPicture->data->url)?$userPicture->data->url:'';
			
			//Check user exist or not
			$cond = array(
				'OR'=>array(
					'User.email'=>$fb_email,
					'User.fb_id'=>$fb_id
				)
			);
			$option = array(
				'conditions'=>$cond
			);
			$userData = $this->User->find('first',$option);
			if(isset($userData) && is_array($userData) && count($userData)>0){ //User exist
				$user_id = $userData['User']['id'];
				$name = $userData['User']['name'];
				$email = $userData['User']['email'];
				$fb_id = $userData['User']['fb_id'];
				$image = $userData['User']['fb_image'];
				$this->User->id = $user_id;
				if($email == ''){
					$this->User->saveField('email',$fb_email);
					$email = $fb_email;
				}
				if($fb_id == ''){
					$this->User->saveField('fb_id',$fb_id);
				}
				if($fb_image != ''){
					$this->User->saveField('fb_image',$fb_image);
					$image = $fb_image;
				}
			}else{
				$saveData = array(
					'User'=>array(
						'name'=>$fb_name,
						'email'=>$fb_email,
						'fb_id'=>$fb_id,
					)
				);
				$this->User->create();
				$this->User->save($saveData);
				
				$user_id = $this->User->id;
				$name = $fb_name;
				$email = $fb_email;
			}
			
			//Set session
			$user = array(
				'user_id'=>$user_id,
				'name'=>$name,
				'email'=>$email
			);
			$this->Session->write('user',$user);
			if($registration == 1){
				return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
			}else{
				return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
			}
		}
	}
	
/**
 * googlePlusLogIn method
 *
 * @return void
 */
	public function googlePlusLogIn($registration=0){
		$this->layout="main";
		
		$client_id = $this->CLIENT_ID;
		$client_secret = $this->CLIENT_SECRET;
		
		$code = isset($_REQUEST["code"])?$_REQUEST["code"]:null;
		$state = md5(uniqid(rand(), TRUE)); // CSRF protection
		//$state = 'rupeeforadian'; 
		
		$redirect_uri = "http://mindscale.co.in/demo/RupeeForadian/Users/googlePlusLogIn/$registration";
		$url = 'https://accounts.google.com/o/oauth2/';
		
		if(empty($code)){
			$oauth_url = $url."auth?response_type=code&client_id=".$client_id."&redirect_uri=".$redirect_uri."&scope=email%20profile&access_type=online&state=".$state;
			print("<script>window.location='$oauth_url'</script>");
			exit();
		}else{
			$token_url = $url.'token';
			$params = array(
			    "code" => $code,
			    "client_id" => $client_id,
			    "client_secret" => $client_secret,
			    "redirect_uri" => $redirect_uri,
			    "grant_type" => "authorization_code"
			);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$token_url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output 
			$result = curl_exec($ch);
			curl_close ($ch);
			
			$responseObj = json_decode($result);
			// pr($responseObj);
			
			$access_token = $responseObj->access_token;
			if($access_token == ''){
				$this->Session->setFlash(__("Some error occured while log in with Google+."));
				return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
			}
			
			$graph_url = "https://www.googleapis.com/oauth2/v1/userinfo?access_token=".$access_token;
			$userDetails = json_decode(file_get_contents($graph_url));
			// pr($userDetails);
			// die();
			
			$google_id = $userDetails->id;
			$google_email = $userDetails->email;
			$google_name = $userDetails->name;
			$google_first_name = $userDetails->given_name;
			$google_last_name = $userDetails->family_name;
			$google_picture = $userDetails->picture;
			
			//Check user exist or not
			$cond = array(
				'OR'=>array(
					'User.email'=>$google_email,
					'User.google_id'=>$google_id
				)
			);
			$option = array(
				'conditions'=>$cond
			);
			$userData = $this->User->find('first',$option);
			if(isset($userData) && is_array($userData) && count($userData)>0){ //User exist
				$user_id = $userData['User']['id'];
				$name = $userData['User']['name'];
				$email = $userData['User']['email'];
				$google_id = $userData['User']['google_id'];
				$image = $userData['User']['google_image'];
				
				$this->User->id = $user_id;
				if($email == ''){
					$this->User->saveField('email',$google_email);
					$email = $google_email;
				}
				if($google_id == ''){
					$this->User->saveField('google_id',$google_id);
				}
				if($google_picture != ''){
					$this->User->saveField('google_image',$google_picture);
					$image = $google_picture;
				}
			}else{
				$saveData = array(
					'User'=>array(
						'name'=>$google_name,
						'email'=>$google_email,
						'google_id'=>$google_id,
						'google_image'=>$google_picture,
					)
				);
				$this->User->create();
				$this->User->save($saveData);
				
				$user_id = $this->User->id;
				$name = $google_name;
				$email = $google_email;
				$image = $google_picture;
			}
			
			//Set session
			$user = array(
				'user_id'=>$user_id,
				'name'=>$name,
				'email'=>$email,
				'image'=>$image,
			);
			$this->Session->write('user',$user);
			if($registration == 1){
				return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
			}else{
				return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
			}
		}
	}
	
/**
 * logout method
 *
 * @return void
 */
	public function logout(){
		$this->Session->destroy();
		$this->Session->setFlash(__("Logged out successfully."));
		return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
	}
	
/**
 * proceedToCheckout method
 *
 * @return void
 */
	public function proceedToCheckout(){
		if($this->request->is('post','put')){
			$reqdata = $this->request->data;
			// pr($reqdata);
			// die();
			$service_ids = isset($reqdata['service_ids'])?$reqdata['service_ids']:"";
			$service_package_ids = isset($reqdata['service_package_ids'])?$reqdata['service_package_ids']:"";
			
			$user = $this->Session->read('user');
			$user_id = isset($user['user_id'])?$user['user_id']:0;
			$session_id = $this->Session->read('session_id');
			
			$this->loadModel('ServicePackage');
			$this->loadModel('UserService');
			$this->loadModel('UserServicePackage');
			$this->loadModel('UserCart');
			
			$service_ids = explode(',',$service_ids);
			$service_package_ids = explode(',',$service_package_ids);
			
			for($i=0; $i<count($service_ids); $i++){
				$service_id = $service_ids[$i];
				$service_package_id = $service_package_ids[$i];
				$purchase_datetime = date('Y-m-d H:i:s');
				$saveService = array(
					'UserService'=>array(
						'user_id'=>$user_id,
						'service_id'=>$service_id,
						'purchase_datetime'=>$purchase_datetime,
					)
				);
				// pr($saveService);
				$this->UserService->create();
				$this->UserService->save($saveService);
				
				$this->ServicePackage->unbindModel(array(
					'belongsTo'=>array('Service'),
				));
				$servicePackageData = $this->ServicePackage->findById($service_package_id);
				// pr($servicePackageData);
				// die();
				$package_name = isset($servicePackageData['ServicePackage']['package_name'])?$servicePackageData['ServicePackage']['package_name']:"";
				$description = isset($servicePackageData['ServicePackage']['description'])?$servicePackageData['ServicePackage']['description']:"";
				$amount = isset($servicePackageData['ServicePackage']['amount'])?$servicePackageData['ServicePackage']['amount']:0;
				$currency = isset($servicePackageData['ServicePackage']['currency'])?$servicePackageData['ServicePackage']['currency']:"";
				$saveServicePackage = array(
					'UserServicePackage'=>array(
						'user_id'=>$user_id,
						'service_package_id'=>$service_package_id,
						'package_name'=>$package_name,
						'description'=>$description,
						'amount'=>$amount,
						'currency'=>$currency,
						'purchase_datetime'=>$purchase_datetime,
					)
				);
				// pr($saveServicePackage);
				// die();
				$this->UserServicePackage->create();
				$this->UserServicePackage->save($saveServicePackage);
			}
			
			$updateCartData = array(
				'UserCart.is_active'=>'0',
				'UserCart.is_deleted'=>'1',
			);
			$updateCartCond = array(
				//'UserCart.user_id'=>$user_id,
				'OR'=>array(
					'UserCart.user_id'=>$user_id,
					'UserCart.session_id'=>$session_id,
				),
				'UserCart.is_active'=>'1',
				'UserCart.is_deleted'=>'0',
			);
			/* if($user_id != 0){
				$updateCartCond['UserCart.user_id'] = $user_id;
			}else{
				$updateCartCond['UserCart.session_id'] = $session_id;
			} */
			$this->UserCart->updateAll($updateCartData,$updateCartCond);
			$this->Session->setFlash(__("Services checked out successfully."));
			
			$this->numberOfItemInCart();
		}
		return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
	}
	
	
}
