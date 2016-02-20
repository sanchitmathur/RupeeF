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
			$service_id = isset($reqdata['service_id'])?$reqdata['service_id']:0;
			$service_package_id = isset($reqdata['service_package_id'])?$reqdata['service_package_id']:0;
			$service = array(
				'service_id'=>$service_id,
				'service_package_id'=>$service_package_id,
			);
			//$this->Session->write('service',$service);
		}
		$cities = $this->getCityList();
		$this->set(compact('cities'));
		
		$languages = $this->getLanguageList();
		$this->set(compact('languages'));
		
		$this->set('service',$service);
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
				return $this->redirect(array('action'=>'registration'));
			}
			
			if($email == ""){
				$this->Session->setFlash(__("Please enter email."));
				return $this->redirect(array('action'=>'registration'));
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
				return $this->redirect(array('action'=>'registration'));
			}
			
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$this->Session->setFlash(__("Please enter valid email."));
				return $this->redirect(array('action'=>'registration'));
			}
			
			if($password == ""){
				$this->Session->setFlash(__("Please enter password."));
				return $this->redirect(array('action'=>'registration'));
			}
			
			if($confpassword == ""){
				$this->Session->setFlash(__("Please confirm password."));
				return $this->redirect(array('action'=>'registration'));
			}
			
			if($password != $confpassword){
				$this->Session->setFlash(__("Password and confirm password doesn't match."));
				return $this->redirect(array('action'=>'registration'));
			}
			
			if($address == ""){
				$this->Session->setFlash(__("Please enter address."));
				return $this->redirect(array('action'=>'registration'));
			}
			
			if($city_id == 0){
				$this->Session->setFlash(__("Please select city."));
				return $this->redirect(array('action'=>'registration'));
			}
			
			if($language_id == 0){
				$this->Session->setFlash(__("Please select language."));
				return $this->redirect(array('action'=>'registration'));
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
				
				$service_id = isset($reqdata['service_id'])?$reqdata['service_id']:0;
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
				}
			}else{
				$this->Session->setFlash(__("Error occured while sign up."));
				return $this->redirect(array('controller'=>'Users','action'=>'registration'));
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
			$email = isset($reqdata['email'])?$reqdata['email']:"";
			$password = isset($reqdata['password'])?$reqdata['password']:"";
			
			if($email == ""){
				$this->Session->setFlash(__("Please enter email."));
				return $this->redirect(array('action'=>'registration'));
			}
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$this->Session->setFlash(__("Please enter valid email."));
				return $this->redirect(array('action'=>'registration'));
			}
			if($password == ""){
				$this->Session->setFlash(__("Please enter password."));
				return $this->redirect(array('action'=>'registration'));
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
				
				$service_id = isset($reqdata['service_id'])?$reqdata['service_id']:0;
				$service_package_id = isset($reqdata['service_package_id'])?$reqdata['service_package_id']:0;
				
				if($service_id == 0){
					$this->Session->setFlash(__('Please select a service.'));
					return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
				}else{
					if($service_package_id == 0){
						$this->Session->setFlash(__('Please select a package.'));
						return $this->redirect(array('controller'=>'Services','action'=>'bussiness_service/'.$service_id));
					}else{
						//return $this->redirect(array('controller'=>'Services','action'=>'addToCart'));
						return $this->redirect(array('controller'=>'Services','action'=>'saveToCart/'.$service_id.'/'.$service_package_id));
					}
				}
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
			$service_ids = explode(',',$service_ids);
			
			$service_package_ids = isset($reqdata['service_package_ids'])?$reqdata['service_package_ids']:"";
			$service_package_ids = explode(',',$service_package_ids);
			
			$user = $this->Session->read('user');
			$user_id = isset($user['user_id'])?$user['user_id']:0;
			
			$this->loadModel('ServicePackage');
			$this->loadModel('UserService');
			$this->loadModel('UserServicePackage');
			$this->loadModel('UserCart');
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
				'UserCart.user_id'=>$user_id,
				'UserCart.is_active'=>'1',
				'UserCart.is_deleted'=>'0',
			);
			$this->UserCart->updateAll($updateCartData,$updateCartCond);
			$this->Session->setFlash(__("Services checked out successfully."));
			
			$this->numberOfItemInCart();
		}
		return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
	}
	
	
}
