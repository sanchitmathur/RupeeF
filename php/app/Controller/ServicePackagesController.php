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
		$this->ServicePackage->recursive = 0;
		$this->set('servicePackages', $this->Paginator->paginate());
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
 * @return void
 */
	public function admin_add() {
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
