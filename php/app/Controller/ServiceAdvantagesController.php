<?php
App::uses('AppController', 'Controller');
/**
 * ServiceAdvantages Controller
 *
 * @property ServiceAdvantage $ServiceAdvantage
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ServiceAdvantagesController extends AppController {

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
		$this->ServiceAdvantage->recursive = 0;
		$this->set('serviceAdvantages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ServiceAdvantage->exists($id)) {
			throw new NotFoundException(__('Invalid service advantage'));
		}
		$options = array('conditions' => array('ServiceAdvantage.' . $this->ServiceAdvantage->primaryKey => $id));
		$this->set('serviceAdvantage', $this->ServiceAdvantage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ServiceAdvantage->create();
			if ($this->ServiceAdvantage->save($this->request->data)) {
				$this->Session->setFlash(__('The service advantage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service advantage could not be saved. Please, try again.'));
			}
		}
		$services = $this->ServiceAdvantage->Service->find('list');
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
		if (!$this->ServiceAdvantage->exists($id)) {
			throw new NotFoundException(__('Invalid service advantage'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServiceAdvantage->save($this->request->data)) {
				$this->Session->setFlash(__('The service advantage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service advantage could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ServiceAdvantage.' . $this->ServiceAdvantage->primaryKey => $id));
			$this->request->data = $this->ServiceAdvantage->find('first', $options);
		}
		$services = $this->ServiceAdvantage->Service->find('list');
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
		$this->ServiceAdvantage->id = $id;
		if (!$this->ServiceAdvantage->exists()) {
			throw new NotFoundException(__('Invalid service advantage'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ServiceAdvantage->delete()) {
			$this->Session->setFlash(__('The service advantage has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service advantage could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ServiceAdvantage->recursive = 0;
		$this->set('serviceAdvantages', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ServiceAdvantage->exists($id)) {
			throw new NotFoundException(__('Invalid service advantage'));
		}
		$options = array('conditions' => array('ServiceAdvantage.' . $this->ServiceAdvantage->primaryKey => $id));
		$this->set('serviceAdvantage', $this->ServiceAdvantage->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ServiceAdvantage->create();
			if ($this->ServiceAdvantage->save($this->request->data)) {
				$this->Session->setFlash(__('The service advantage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service advantage could not be saved. Please, try again.'));
			}
		}
		$services = $this->ServiceAdvantage->Service->find('list');
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
		if (!$this->ServiceAdvantage->exists($id)) {
			throw new NotFoundException(__('Invalid service advantage'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServiceAdvantage->save($this->request->data)) {
				$this->Session->setFlash(__('The service advantage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service advantage could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ServiceAdvantage.' . $this->ServiceAdvantage->primaryKey => $id));
			$this->request->data = $this->ServiceAdvantage->find('first', $options);
		}
		$services = $this->ServiceAdvantage->Service->find('list');
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
		$this->ServiceAdvantage->id = $id;
		if (!$this->ServiceAdvantage->exists()) {
			throw new NotFoundException(__('Invalid service advantage'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ServiceAdvantage->delete()) {
			$this->Session->setFlash(__('The service advantage has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service advantage could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
