<?php
App::uses('AppController', 'Controller');
/**
 * UserServicePackages Controller
 *
 * @property UserServicePackage $UserServicePackage
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserServicePackagesController extends AppController {

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
		$this->UserServicePackage->recursive = 0;
		$this->set('userServicePackages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserServicePackage->exists($id)) {
			throw new NotFoundException(__('Invalid user service package'));
		}
		$options = array('conditions' => array('UserServicePackage.' . $this->UserServicePackage->primaryKey => $id));
		$this->set('userServicePackage', $this->UserServicePackage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserServicePackage->create();
			if ($this->UserServicePackage->save($this->request->data)) {
				$this->Session->setFlash(__('The user service package has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user service package could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserServicePackage->User->find('list');
		$servicePackages = $this->UserServicePackage->ServicePackage->find('list');
		$this->set(compact('users', 'servicePackages'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserServicePackage->exists($id)) {
			throw new NotFoundException(__('Invalid user service package'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserServicePackage->save($this->request->data)) {
				$this->Session->setFlash(__('The user service package has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user service package could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserServicePackage.' . $this->UserServicePackage->primaryKey => $id));
			$this->request->data = $this->UserServicePackage->find('first', $options);
		}
		$users = $this->UserServicePackage->User->find('list');
		$servicePackages = $this->UserServicePackage->ServicePackage->find('list');
		$this->set(compact('users', 'servicePackages'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserServicePackage->id = $id;
		if (!$this->UserServicePackage->exists()) {
			throw new NotFoundException(__('Invalid user service package'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserServicePackage->delete()) {
			$this->Session->setFlash(__('The user service package has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user service package could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->UserServicePackage->recursive = 0;
		$this->set('userServicePackages', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UserServicePackage->exists($id)) {
			throw new NotFoundException(__('Invalid user service package'));
		}
		$options = array('conditions' => array('UserServicePackage.' . $this->UserServicePackage->primaryKey => $id));
		$this->set('userServicePackage', $this->UserServicePackage->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UserServicePackage->create();
			if ($this->UserServicePackage->save($this->request->data)) {
				$this->Session->setFlash(__('The user service package has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user service package could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserServicePackage->User->find('list');
		$servicePackages = $this->UserServicePackage->ServicePackage->find('list');
		$this->set(compact('users', 'servicePackages'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->UserServicePackage->exists($id)) {
			throw new NotFoundException(__('Invalid user service package'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserServicePackage->save($this->request->data)) {
				$this->Session->setFlash(__('The user service package has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user service package could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserServicePackage.' . $this->UserServicePackage->primaryKey => $id));
			$this->request->data = $this->UserServicePackage->find('first', $options);
		}
		$users = $this->UserServicePackage->User->find('list');
		$servicePackages = $this->UserServicePackage->ServicePackage->find('list');
		$this->set(compact('users', 'servicePackages'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->UserServicePackage->id = $id;
		if (!$this->UserServicePackage->exists()) {
			throw new NotFoundException(__('Invalid user service package'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserServicePackage->delete()) {
			$this->Session->setFlash(__('The user service package has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user service package could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
