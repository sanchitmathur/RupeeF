<?php
App::uses('AppController', 'Controller');
/**
 * ServiceFaqs Controller
 *
 * @property ServiceFaq $ServiceFaq
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ServiceFaqsController extends AppController {

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
		$this->ServiceFaq->recursive = 0;
		$this->set('serviceFaqs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ServiceFaq->exists($id)) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		$options = array('conditions' => array('ServiceFaq.' . $this->ServiceFaq->primaryKey => $id));
		$this->set('serviceFaq', $this->ServiceFaq->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ServiceFaq->create();
			if ($this->ServiceFaq->save($this->request->data)) {
				$this->Session->setFlash(__('The service faq has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service faq could not be saved. Please, try again.'));
			}
		}
		$services = $this->ServiceFaq->Service->find('list');
		$this->set(compact('services'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ServiceFaq->exists($id)) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServiceFaq->save($this->request->data)) {
				$this->Session->setFlash(__('The service faq has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service faq could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ServiceFaq.' . $this->ServiceFaq->primaryKey => $id));
			$this->request->data = $this->ServiceFaq->find('first', $options);
		}
		$services = $this->ServiceFaq->Service->find('list');
		$this->set(compact('services'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ServiceFaq->id = $id;
		if (!$this->ServiceFaq->exists()) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ServiceFaq->delete()) {
			$this->Session->setFlash(__('The service faq has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service faq could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 * @param string $serviceId
 * 
 * @return void
 */
	public function admin_index($serviceId=0) {
		$this->layout="admindefault";
		$this->adminsessionchecked();
		if($this->request->is('post')){
			$serviceId = isset($this->request->data['Menu']['service_id'])?$this->request->data['Menu']['service_id']:0;
		}
		$findqes = array(
			'ServiceFaq.is_blocked'=>'0',
			'ServiceFaq.is_deleted'=>'0'
		);
		if($serviceId>0){
			$findqes['ServiceFaq.service_id']=$serviceId;
		}
		$this->Paginator->settings=array(
			'conditions'=>$findqes
		);
		$this->ServiceFaq->recursive = 0;
		$this->set('serviceFaqs', $this->Paginator->paginate());
		
		//gel all services
		$findservice = array(
			'Service.is_blocked'=>'0',
			'Service.is_deleted'=>'0'
		);
		$services = $this->ServiceFaq->Service->find('list',array('conditions'=>$findservice));
		$services[0]="Select service";
		ksort($services);
		if(is_array($services) && count($services)>0 && $serviceId==0){
			foreach($services as $key=>$val){
				$serviceId = $key;
				break;
			}
		}
		if($serviceId==0){
			$serviceId='';
		}
		$this->set('serviceId',$serviceId);
		$this->set(compact('services'));
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
		if (!$this->ServiceFaq->exists($id)) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		$options = array('conditions' => array('ServiceFaq.' . $this->ServiceFaq->primaryKey => $id));
		$this->set('serviceFaq', $this->ServiceFaq->find('first', $options));
	}

/**
 * admin_add method
 * @param string $service_id
 * @return void
 */
	public function admin_add($service_id=0) {
		$this->layout="admindefault";
		$this->adminsessionchecked();
		if ($this->request->is('post')) {
			$this->ServiceFaq->create();
			$this->request->data['ServiceFaq']['is_blocked']=0;
			$this->request->data['ServiceFaq']['is_deleted']=0;
			
			if ($this->ServiceFaq->save($this->request->data)) {
				$this->Session->setFlash(__('The service faq has been saved.'),'default',array('class'=>'success'));
				//return $this->redirect(array('action' => 'index'));
				$this->redirect(array('action' => 'add',$service_id));
			} else {
				$this->Session->setFlash(__('The service faq could not be saved. Please, try again.'));
			}
		}
		$findservice = array(
			'Service.is_blocked'=>'0',
			'Service.is_deleted'=>'0'
		);
		if($service_id>0){
			$findservice['Service.id']=$service_id;
		}
		$services = $this->ServiceFaq->Service->find('list',array('conditions'=>$findservice));
		$this->set(compact('services'));
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
		if (!$this->ServiceFaq->exists($id)) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServiceFaq->save($this->request->data)) {
				$this->Session->setFlash(__('The service faq has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service faq could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ServiceFaq.' . $this->ServiceFaq->primaryKey => $id));
			$this->request->data = $this->ServiceFaq->find('first', $options);
		}
		$services = $this->ServiceFaq->Service->find('list');
		$this->set(compact('services'));
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
		$this->ServiceFaq->id = $id;
		if (!$this->ServiceFaq->exists()) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		$this->request->allowMethod('post', 'delete');
		$this->ServiceFaq->saveField('is_deleted','1');
		$this->Session->setFlash(__('The service faq has been deleted.'),'default',array('class'=>'success'));
		/*if ($this->ServiceFaq->delete()) {
			$this->Session->setFlash(__('The service faq has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service faq could not be deleted. Please, try again.'));
		}*/
		return $this->redirect(array('action' => 'index'));
	}
}
