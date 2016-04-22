<?php
App::uses('AppController', 'Controller');
/**
 * Services Controller
 *
 * @property Service $Service
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ServicesController extends AppController {

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
		$this->Service->recursive = 0;
		$this->set('services', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Service->exists($id)) {
			throw new NotFoundException(__('Invalid service'));
		}
		$options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
		$this->set('service', $this->Service->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Service->create();
			if ($this->Service->save($this->request->data)) {
				$this->Session->setFlash(__('The service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}
		}
		$subServices = $this->Service->SubService->find('list');
		$this->set(compact('subServices'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Service->exists($id)) {
			throw new NotFoundException(__('Invalid service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Service->save($this->request->data)) {
				$this->Session->setFlash(__('The service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
			$this->request->data = $this->Service->find('first', $options);
		}
		$subServices = $this->Service->SubService->find('list');
		$this->set(compact('subServices'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Service->id = $id;
		if (!$this->Service->exists()) {
			throw new NotFoundException(__('Invalid service'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Service->delete()) {
			$this->Session->setFlash(__('The service has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->layout="admindefault";
		$this->adminsessionchecked();
		$this->Service->recursive = 0;
		$this->set('services', $this->Paginator->paginate());
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
		$this->adminsessionchecked();
		if (!$this->Service->exists($id)) {
			throw new NotFoundException(__('Invalid service'));
		}
		$options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
		$this->set('service', $this->Service->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->layout="admindefault";
		$this->adminsessionchecked();
		if ($this->request->is('post')) {
			$this->Service->create();
			if ($this->Service->save($this->request->data)) {
				$this->Session->setFlash(__('The service has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}
		}
		$subServices = $this->Service->SubService->find('list');
		$this->set(compact('subServices'));
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
		$this->adminsessionchecked();
		if (!$this->Service->exists($id)) {
			throw new NotFoundException(__('Invalid service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Service->save($this->request->data)) {
				$this->Session->setFlash(__('The service has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
			$this->request->data = $this->Service->find('first', $options);
		}
		$subServices = $this->Service->SubService->find('list');
		$this->set(compact('subServices'));
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
		$this->adminsessionchecked();
		$this->Service->id = $id;
		if (!$this->Service->exists()) {
			throw new NotFoundException(__('Invalid service'));
		}
		$this->request->allowMethod('post', 'delete');
		
		$this->Service->saveField('is_deleted','1');
		$this->Session->setFlash(__('The service has been deleted.'),'default',array('class'=>'success'));
		/*if ($this->Service->delete()) {
			$this->Session->setFlash(__('The service has been deleted.'),'default',array('class'=>'success'));
		} else {
			$this->Session->setFlash(__('The service could not be deleted. Please, try again.'));
		}*/
		return $this->redirect(array('action' => 'index'));
	}
	
/**
 * admin_shownidfooter method
 * @param string $id
 * @param string $show_in_footer
 */
	public function admin_shownidfooter($id=null, $show_in_footer=0){
		$this->adminsessionchecked();
		if($id>0){
			$upcond = array(
				'Service.id'=>$id,
				'Service.is_deleted'=>'0'
			);
			$updata = array('Service.show_in_footer'=>$show_in_footer);
			$this->Service->updateAll($updata,$upcond);
			if($show_in_footer==1){
				$message="This service shown in footer section";
			}
			else{
				$message="This service does not shown in footer section";
			}
			$this->Session->setFlash(__($message),'default',array('class'=>'success'));
		}
		else{
			$this->Session->setFlash(__('Service id missing'));
		}
		return $this->redirect(array('controller'=>'Services','action'=>'index'));
	}
	
/**
 * admin_blockedservice method
 * @param string $id
 * @param string $is_blocked
 */
	public function admin_blockedservice($id=null, $is_blocked=0){
		$this->adminsessionchecked();
		if($id>0){
			$upcond = array(
				'Service.id'=>$id,
				'Service.is_deleted'=>'0'
			);
			$updata = array('Service.is_blocked'=>$is_blocked);
			$this->Service->updateAll($updata,$upcond);
			if($is_blocked==1){
				$message="This service is blocked successfully";
			}
			else{
				$message="This service is unblocked successfully";
			}
			$this->Session->setFlash(__($message),'default',array('class'=>'success'));
		}
		else{
			$this->Session->setFlash(__('Service id missing'));
		}
		return $this->redirect(array('controller'=>'Services','action'=>'index'));
	}
	
	
/**
 * bussiness_service method
 *
 * @return void
 */
	public function bussiness_service($service_id=null){
		$this->layout = "main";
		
		if (!$this->Service->exists($service_id)) {
			$this->Session->setFlash(__('The service is not available.'));
			return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
		}
		
		$cond = array(
			'Service.' . $this->Service->primaryKey => $service_id,
			'Service.is_blocked' => 0,
			'Service.is_deleted' => 0,
		);
		$options = array(
			'conditions' => $cond
		);
		$service = $this->Service->find('first', $options);
		if(count($service)>0){
			$this->set('service', $service);
		}else{
			$this->Session->setFlash(__('The service is not available.'));
			return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
		}
	}
	
/**
 * addToCart method
 *
 * @return void
 */
	public function addToCart(){
		$this->layout = "main";
		
		if($this->request->is('post','put')){
			$reqdata = $this->request->data;
			$service_id = isset($reqdata['service_id'])?$reqdata['service_id']:0;
			$service_package_id = isset($reqdata['service_package_id'])?$reqdata['service_package_id']:0;
		}else{
			$service = $this->Session->read('service');
			$service_id = isset($service['service_id'])?$service['service_id']:0;
			$service_package_id = isset($service['service_package_id'])?$service['service_package_id']:0;
		}
		if($service_id == 0){
			$this->Session->setFlash(__('Please select a service.'));
			$this->redirect(array('controller'=>'MainServices','action'=>'services'));
			if($service_package_id == 0){
				$this->Session->setFlash(__('Please select a package.'));
				return $this->redirect(array('controller'=>'Services','action'=>'bussiness_service/'.$service_id));
			}
		}else{
			if (!$this->Service->exists($service_id)) {
				$this->Session->setFlash(__('The service is not available.'));
				return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
			}
			
			$this->loadModel('ServicePackage');
			if (!$this->ServicePackage->exists($service_package_id)) {
				$this->Session->setFlash(__('The package is not available.'));
				return $this->redirect(array('controller'=>'Services','action'=>'bussiness_service/'.$service_id));
			}
			
			$this->Service->unbindModel(array(
				'hasMany'=>array('ServiceAdvantage','ServiceFaq','ServicePackage'),
			));
			
			$this->Service->bindModel(array(
				'hasOne'=>array(
					'ServicePackage' => array(
						'className' => 'ServicePackage',
						'foreignKey' => 'service_id',
						'dependent' => false,
						'conditions' => array('ServicePackage.id'=>$service_package_id),
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
					)
				)
			));
			
			$cond = array(
				'Service.' . $this->Service->primaryKey => $service_id,
				'Service.is_blocked' => 0,
				'Service.is_deleted' => 0,
			);
			$options = array(
				'conditions' => $cond
			);
			$serviceData = $this->Service->find('first', $options);
			if(count($serviceData)>0){
				$this->set('serviceData', $serviceData);
			}else{
				$this->Session->setFlash(__('The service is not available.'));
				return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
			}
		}
	}
	
/**
 * saveToCart method
 *
 * @return void
 */
	public function saveToCart($service_id=0, $service_package_id=0){
		if($this->request->is('post','put')){
			$reqdata = $this->request->data;
			// pr($reqdata);
			// die();
			$service_id = isset($reqdata['service_id'])?$reqdata['service_id']:0;
			$service_package_id = isset($reqdata['service_package_id'])?$reqdata['service_package_id']:0;
		}
			
		if (!$this->Service->exists($service_id)) {
			$this->Session->setFlash(__('The service is not available.'));
			return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
		}
		
		$this->loadModel('ServicePackage');
		if (!$this->ServicePackage->exists($service_package_id)) {
			$this->Session->setFlash(__('The package is not available.'));
			return $this->redirect(array('controller'=>'Services','action'=>'bussiness_service/'.$service_id));
		}
		
		$this->loadModel('UserCart');
		$user = $this->Session->read('user');
		$session_id = $this->Session->read('session_id');
		$user_id = isset($user['user_id'])?$user['user_id']:0;
		$saveData = array(
			'UserCart'=>array(
				'user_id'=>$user_id,
				'session_id'=>$session_id,
				'service_id'=>$service_id,
				'service_package_id'=>$service_package_id,
				'createtime'=>time()
			)
		);
		// pr($saveData);
		// die();
		$this->UserCart->create();
		if($this->UserCart->save($saveData)){
			$this->Session->setFlash(__('Successfully added to cart.'));
		}else{
			$this->Session->setFlash(__('Oops !!! An error occured while adding to cart.'));
		}
		$this->numberOfItemInCart();
		//return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
		return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
	}
	
/**
 * footerservices method
 * @return array $services
 */
	public function footerservices(){
		$findcond = array(
			'Service.show_in_footer'=>'1',
			'Service.is_blocked'=>'0',
			'Service.is_deleted'=>'0'
		);
		$order = array('Service.service_name'=>'ASC');
		//unbind models
		$this->Service->unbindModel(array(
			'belongsTo'=>array('SubService'),
			'hasMany'=>array('ServiceAdvantage','ServiceFaq','ServicePackage','ServiceDocument')
		));
		
		$services = $this->Service->find('all',array('recursive'=>'0','conditions'=>$findcond,'limit'=>60,'order'=>$order));
		return $services;
	}
	
}
