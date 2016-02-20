<?php
App::uses('AppController', 'Controller');
/**
 * UserServices Controller
 *
 * @property UserService $UserService
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserServicesController extends AppController {

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
		$this->UserService->recursive = 0;
		$this->set('userServices', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserService->exists($id)) {
			throw new NotFoundException(__('Invalid user service'));
		}
		$options = array('conditions' => array('UserService.' . $this->UserService->primaryKey => $id));
		$this->set('userService', $this->UserService->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserService->create();
			if ($this->UserService->save($this->request->data)) {
				$this->Session->setFlash(__('The user service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user service could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserService->User->find('list');
		$services = $this->UserService->Service->find('list');
		$this->set(compact('users', 'services'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserService->exists($id)) {
			throw new NotFoundException(__('Invalid user service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserService->save($this->request->data)) {
				$this->Session->setFlash(__('The user service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserService.' . $this->UserService->primaryKey => $id));
			$this->request->data = $this->UserService->find('first', $options);
		}
		$users = $this->UserService->User->find('list');
		$services = $this->UserService->Service->find('list');
		$this->set(compact('users', 'services'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserService->id = $id;
		if (!$this->UserService->exists()) {
			throw new NotFoundException(__('Invalid user service'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserService->delete()) {
			$this->Session->setFlash(__('The user service has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user service could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->UserService->recursive = 0;
		$this->set('userServices', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UserService->exists($id)) {
			throw new NotFoundException(__('Invalid user service'));
		}
		$options = array('conditions' => array('UserService.' . $this->UserService->primaryKey => $id));
		$this->set('userService', $this->UserService->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UserService->create();
			if ($this->UserService->save($this->request->data)) {
				$this->Session->setFlash(__('The user service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user service could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserService->User->find('list');
		$services = $this->UserService->Service->find('list');
		$this->set(compact('users', 'services'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->UserService->exists($id)) {
			throw new NotFoundException(__('Invalid user service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserService->save($this->request->data)) {
				$this->Session->setFlash(__('The user service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserService.' . $this->UserService->primaryKey => $id));
			$this->request->data = $this->UserService->find('first', $options);
		}
		$users = $this->UserService->User->find('list');
		$services = $this->UserService->Service->find('list');
		$this->set(compact('users', 'services'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->UserService->id = $id;
		if (!$this->UserService->exists()) {
			throw new NotFoundException(__('Invalid user service'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserService->delete()) {
			$this->Session->setFlash(__('The user service has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user service could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
