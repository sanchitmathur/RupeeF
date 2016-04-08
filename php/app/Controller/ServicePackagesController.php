<?php
App::uses('AppController', 'Controller');
/**
 * ServicePackages Controller
 *
 * @property ServicePackage $ServicePackage
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ServicePackagesController extends AppController {

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
		$this->ServicePackage->recursive = 0;
		$this->set('servicePackages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ServicePackage->exists($id)) {
			throw new NotFoundException(__('Invalid service package'));
		}
		$options = array('conditions' => array('ServicePackage.' . $this->ServicePackage->primaryKey => $id));
		$this->set('servicePackage', $this->ServicePackage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ServicePackage->create();
			if ($this->ServicePackage->save($this->request->data)) {
				$this->Session->setFlash(__('The service package has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service package could not be saved. Please, try again.'));
			}
		}
		$services = $this->ServicePackage->Service->find('list');
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
		if (!$this->ServicePackage->exists($id)) {
			throw new NotFoundException(__('Invalid service package'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServicePackage->save($this->request->data)) {
				$this->Session->setFlash(__('The service package has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service package could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ServicePackage.' . $this->ServicePackage->primaryKey => $id));
			$this->request->data = $this->ServicePackage->find('first', $options);
		}
		$services = $this->ServicePackage->Service->find('list');
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
		$this->ServicePackage->id = $id;
		if (!$this->ServicePackage->exists()) {
			throw new NotFoundException(__('Invalid service package'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ServicePackage->delete()) {
			$this->Session->setFlash(__('The service package has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service package could not be deleted. Please, try again.'));
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
		$service_id=0;
		$paginatecond=array();
		if($this->request->is('post')){
			$service_id=$this->request->data['Service']['service_id'];
			if($service_id>0){
				$paginatecond=array('ServicePackage.service_id'=>$service_id);
			}
		}
		$this->ServicePackage->recursive = 0;
		$this->Paginator->settings=array(
			'conditions'=>$paginatecond
		);
		$this->set('servicePackages', $this->Paginator->paginate());
		//
		$service_cond = array(
			'Service.is_blocked'=>'0',
			'Service.is_deleted'=>'0'
		);
		$services = $this->ServicePackage->Service->find('list',array('conditions'=>$service_cond));
		$services[0]="Select Service";
		ksort($services);
		$this->set(compact('services'));
		$this->set('serviceId',$service_id);
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ServicePackage->exists($id)) {
			throw new NotFoundException(__('Invalid service package'));
		}
		$options = array('conditions' => array('ServicePackage.' . $this->ServicePackage->primaryKey => $id));
		$this->set('servicePackage', $this->ServicePackage->find('first', $options));
	}

/**
 * admin_add method
 *
 * @param string $service_id
 * @return void
 */
	public function admin_add($service_id) {
		$this->layout="admindefault";
		if ($this->request->is('post')) {
			$this->ServicePackage->create();
			if ($this->ServicePackage->save($this->request->data)) {
				$this->Session->setFlash(__('The service package has been saved.'));
				return $this->redirect(array('action' => 'index'),'default',array('class'=>'success'));
			} else {
				$this->Session->setFlash(__('The service package could not be saved. Please, try again.'));
			}
		}
		$service_cond = array(
			'Service.is_blocked'=>'0',
			'Service.is_deleted'=>'0'
		);
		if($service_id>0){
			$service_cond['Service.id']=$service_id;
		}
		$services = $this->ServicePackage->Service->find('list',array('conditions'=>$service_cond));
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
		if (!$this->ServicePackage->exists($id)) {
			throw new NotFoundException(__('Invalid service package'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServicePackage->save($this->request->data)) {
				$this->Session->setFlash(__('The service package has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service package could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ServicePackage.' . $this->ServicePackage->primaryKey => $id));
			$this->request->data = $this->ServicePackage->find('first', $options);
		}
		$services = $this->ServicePackage->Service->find('list');
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
		$this->ServicePackage->id = $id;
		if (!$this->ServicePackage->exists()) {
			throw new NotFoundException(__('Invalid service package'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ServicePackage->delete()) {
			$this->Session->setFlash(__('The service package has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service package could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
