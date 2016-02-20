<?php
App::uses('AppController', 'Controller');
/**
 * ServiceTaxes Controller
 *
 * @property ServiceTax $ServiceTax
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ServiceTaxesController extends AppController {

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
		$this->ServiceTax->recursive = 0;
		$this->set('serviceTaxes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ServiceTax->exists($id)) {
			throw new NotFoundException(__('Invalid service tax'));
		}
		$options = array('conditions' => array('ServiceTax.' . $this->ServiceTax->primaryKey => $id));
		$this->set('serviceTax', $this->ServiceTax->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ServiceTax->create();
			if ($this->ServiceTax->save($this->request->data)) {
				$this->Session->setFlash(__('The service tax has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service tax could not be saved. Please, try again.'));
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
		if (!$this->ServiceTax->exists($id)) {
			throw new NotFoundException(__('Invalid service tax'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServiceTax->save($this->request->data)) {
				$this->Session->setFlash(__('The service tax has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service tax could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ServiceTax.' . $this->ServiceTax->primaryKey => $id));
			$this->request->data = $this->ServiceTax->find('first', $options);
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
		$this->ServiceTax->id = $id;
		if (!$this->ServiceTax->exists()) {
			throw new NotFoundException(__('Invalid service tax'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ServiceTax->delete()) {
			$this->Session->setFlash(__('The service tax has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service tax could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ServiceTax->recursive = 0;
		$this->set('serviceTaxes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ServiceTax->exists($id)) {
			throw new NotFoundException(__('Invalid service tax'));
		}
		$options = array('conditions' => array('ServiceTax.' . $this->ServiceTax->primaryKey => $id));
		$this->set('serviceTax', $this->ServiceTax->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ServiceTax->create();
			if ($this->ServiceTax->save($this->request->data)) {
				$this->Session->setFlash(__('The service tax has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service tax could not be saved. Please, try again.'));
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
		if (!$this->ServiceTax->exists($id)) {
			throw new NotFoundException(__('Invalid service tax'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServiceTax->save($this->request->data)) {
				$this->Session->setFlash(__('The service tax has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service tax could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ServiceTax.' . $this->ServiceTax->primaryKey => $id));
			$this->request->data = $this->ServiceTax->find('first', $options);
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
		$this->ServiceTax->id = $id;
		if (!$this->ServiceTax->exists()) {
			throw new NotFoundException(__('Invalid service tax'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ServiceTax->delete()) {
			$this->Session->setFlash(__('The service tax has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service tax could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
