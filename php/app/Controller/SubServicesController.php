<?php
App::uses('AppController', 'Controller');
/**
 * SubServices Controller
 *
 * @property SubService $SubService
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SubServicesController extends AppController {

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
		$this->SubService->recursive = 0;
		$this->set('subServices', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SubService->exists($id)) {
			throw new NotFoundException(__('Invalid sub service'));
		}
		$options = array('conditions' => array('SubService.' . $this->SubService->primaryKey => $id));
		$this->set('subService', $this->SubService->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SubService->create();
			if ($this->SubService->save($this->request->data)) {
				$this->Session->setFlash(__('The sub service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sub service could not be saved. Please, try again.'));
			}
		}
		$mainServices = $this->SubService->MainService->find('list');
		$this->set(compact('mainServices'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SubService->exists($id)) {
			throw new NotFoundException(__('Invalid sub service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SubService->save($this->request->data)) {
				$this->Session->setFlash(__('The sub service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sub service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SubService.' . $this->SubService->primaryKey => $id));
			$this->request->data = $this->SubService->find('first', $options);
		}
		$mainServices = $this->SubService->MainService->find('list');
		$this->set(compact('mainServices'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SubService->id = $id;
		if (!$this->SubService->exists()) {
			throw new NotFoundException(__('Invalid sub service'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SubService->delete()) {
			$this->Session->setFlash(__('The sub service has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sub service could not be deleted. Please, try again.'));
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
		$this->SubService->recursive = 0;
		$this->set('subServices', $this->Paginator->paginate());
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
		if (!$this->SubService->exists($id)) {
			throw new NotFoundException(__('Invalid sub service'));
		}
		$options = array('conditions' => array('SubService.' . $this->SubService->primaryKey => $id));
		$this->set('subService', $this->SubService->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->layout="admindefault";
		if ($this->request->is('post')) {
			$this->SubService->create();
			if ($this->SubService->save($this->request->data)) {
				$this->Session->setFlash(__('The sub service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sub service could not be saved. Please, try again.'));
			}
		}
		$mainServices = $this->SubService->MainService->find('list');
		$this->set(compact('mainServices'));
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
		if (!$this->SubService->exists($id)) {
			throw new NotFoundException(__('Invalid sub service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SubService->save($this->request->data)) {
				$this->Session->setFlash(__('The sub service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sub service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SubService.' . $this->SubService->primaryKey => $id));
			$this->request->data = $this->SubService->find('first', $options);
		}
		$mainServices = $this->SubService->MainService->find('list');
		$this->set(compact('mainServices'));
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
		$this->SubService->id = $id;
		if (!$this->SubService->exists()) {
			throw new NotFoundException(__('Invalid sub service'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SubService->delete()) {
			$this->Session->setFlash(__('The sub service has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sub service could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
