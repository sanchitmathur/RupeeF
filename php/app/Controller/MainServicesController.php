<?php
App::uses('AppController', 'Controller');
/**
 * MainServices Controller
 *
 * @property MainService $MainService
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MainServicesController extends AppController {

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
		$this->MainService->recursive = 0;
		$this->set('mainServices', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MainService->exists($id)) {
			throw new NotFoundException(__('Invalid main service'));
		}
		$options = array('conditions' => array('MainService.' . $this->MainService->primaryKey => $id));
		$this->set('mainService', $this->MainService->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MainService->create();
			if ($this->MainService->save($this->request->data)) {
				$this->Session->setFlash(__('The main service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The main service could not be saved. Please, try again.'));
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
		if (!$this->MainService->exists($id)) {
			throw new NotFoundException(__('Invalid main service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MainService->save($this->request->data)) {
				$this->Session->setFlash(__('The main service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The main service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MainService.' . $this->MainService->primaryKey => $id));
			$this->request->data = $this->MainService->find('first', $options);
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
		$this->MainService->id = $id;
		if (!$this->MainService->exists()) {
			throw new NotFoundException(__('Invalid main service'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MainService->delete()) {
			$this->Session->setFlash(__('The main service has been deleted.'));
		} else {
			$this->Session->setFlash(__('The main service could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
/**
 * admin_login method
 * 
 */
	public function admin_login(){
		$this->layout="admindefault";
		$this->adminsessionpresent();
		if($this->request->is('post')){
			$posteddata = $this->request->data;
			$email = isset($posteddata['AdminUser']['email'])?$posteddata['AdminUser']['email']:'';
			$password = isset($posteddata['AdminUser']['password'])?$posteddata['AdminUser']['password']:'';
			//validaion
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$this->Session->setFlash(__('Please enter your valid email address'));	
			}
			else{
				if($password==''){
					$this->Session->setFlash(__('Please enter your password'));
				}
				else{
					$findcond = array(
						'AdminUser.email'=>$email,
						'AdminUser.password'=>md5($password),
						'AdminUser.is_active'=>'1',
						'AdminUser.is_deleted'=>'0'
					);
					$this->loadModel('AdminUser');
					$adminUser = $this->AdminUser->find('first',array('conditions'=>$findcond));
					if(is_array($adminUser) && count($adminUser)>0){
						//user found
						$admin_id = $adminUser['AdminUser']['id'];
						$findcond['AdminUser.email']=$admin_id;
						//update the login time
						$updata = array('AdminUser.lastlogin'=>time());
						//update
						$this->AdminUser->updateAll($updata,$findcond);
						//now set the sesstion
						$this->Session->write('adminuser',$adminUser['AdminUser']);
						//
						$this->adminsessionpresent();
					}
					else{
						$this->Session->setFlash(__('Email or password does not matched'));
					}
				}
			}
		}
	}
	
/**
 * admin_logout method
 * 
 */
	public function admin_logout(){
		//first destroy the session
		$this->Session->delete('adminuser');
		$this->adminsessionchecked();
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->adminsessionchecked();
		$this->layout="admindefault";
		$this->MainService->recursive = 0;
		$this->set('mainServices', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->layout="admindefault";
		if (!$this->MainService->exists($id)) {
			throw new NotFoundException(__('Invalid main service'));
		}
		$options = array('conditions' => array('MainService.' . $this->MainService->primaryKey => $id));
		$this->set('mainService', $this->MainService->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->layout="admindefault";
		if ($this->request->is('post')) {
			$this->MainService->create();
			if ($this->MainService->save($this->request->data)) {
				$this->Session->setFlash(__('The main service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The main service could not be saved. Please, try again.'));
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
		$this->layout="admindefault";
		if (!$this->MainService->exists($id)) {
			throw new NotFoundException(__('Invalid main service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MainService->save($this->request->data)) {
				$this->Session->setFlash(__('The main service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The main service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MainService.' . $this->MainService->primaryKey => $id));
			$this->request->data = $this->MainService->find('first', $options);
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
		$this->layout="admindefault";
		$this->MainService->id = $id;
		if (!$this->MainService->exists()) {
			throw new NotFoundException(__('Invalid main service'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MainService->delete()) {
			$this->Session->setFlash(__('The main service has been deleted.'));
		} else {
			$this->Session->setFlash(__('The main service could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
/**
 * services method
 *
 * @return void
 */
	public function services(){
		$this->layout = "main";
		
		$this->MainService->recursive = 2;
		//bind the other models
		$this->MainService->bindModel(array(
			'hasMany'=>array(
				'SubService'=>array(
					'className'=>'SubService',
					'foreingKey'=>'main_service_id',
					'conditions'=>array('SubService.is_blocked'=>'0','SubService.is_deleted'=>'0')
				)
			)
		));
		$this->MainService->SubService->bindModel(array(
			'hasMany'=>array(
				'Service'=>array(
					'className'=>'Service',
					'foreingKey'=>'sub_service_id',
					'conditions'=>array('Service.is_blocked'=>'0','Service.is_deleted'=>'0')
				)
			)
		));
		$this->Paginator->settings=array(
			'conditions'=>array(
				'MainService.is_blocked'=>'0',
				'MainService.is_deleted'=>'0'
			)
		);
		$this->set('mainServices', $this->Paginator->paginate());
		
		$session_id = $this->Session->read('session_id');
		
		if(empty($session_id)){
			$session_id = $this->Session->id();
			//$this->set('session_id',$session_id);
			$this->Session->write('session_id',$session_id);
		}
		
		$this->numberOfItemInCart();
		
		//google map api key
		$this->set('google_api_key',$this->google_mape_user_api_key);
		$this->set('basepath',$this->sitebasepath());
	}
	
}
