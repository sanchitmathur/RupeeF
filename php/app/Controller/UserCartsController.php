<?php
App::uses('AppController', 'Controller');
/**
 * UserCarts Controller
 *
 * @property UserCart $UserCart
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserCartsController extends AppController {

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
	/* public function index() {
		$this->UserCart->recursive = 0;
		$this->set('userCarts', $this->Paginator->paginate());
	} */
	
	public function index() {
		$this->layout = "main";
		
		$user = $this->Session->read('user');
		$user_id = isset($user['user_id'])?$user['user_id']:0;
		
		$this->UserCart->unbindModel(array(
			'belongsTo'=>array('User'),
		));
		$this->UserCart->Service->unbindModel(array(
			'belongsTo'=>array('SubService'),
			'hasMany'=>array('ServiceAdvantage','ServiceFaq'),
		));
		$this->UserCart->ServicePackage->unbindModel(array(
			'belongsTo'=>array('Service'),
		));
		
		$cond = array(
			'UserCart.user_id'=>$user_id,
			'UserCart.is_active'=>1,
			'UserCart.is_deleted'=>0,
		);
		$option = array(
			'conditions'=>$cond,
			'recursive'=>2,
		);
		$userCarts = $this->UserCart->find('all',$option);
		$this->set('userCarts', $userCarts);
		
		$serviceTax = $this->getServiceTax();
		$this->set('serviceTax', $serviceTax);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserCart->exists($id)) {
			throw new NotFoundException(__('Invalid user cart'));
		}
		$options = array('conditions' => array('UserCart.' . $this->UserCart->primaryKey => $id));
		$this->set('userCart', $this->UserCart->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserCart->create();
			if ($this->UserCart->save($this->request->data)) {
				$this->Session->setFlash(__('The user cart has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user cart could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserCart->User->find('list');
		$services = $this->UserCart->Service->find('list');
		$servicePackages = $this->UserCart->ServicePackage->find('list');
		$this->set(compact('users', 'services', 'servicePackages'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserCart->exists($id)) {
			throw new NotFoundException(__('Invalid user cart'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserCart->save($this->request->data)) {
				$this->Session->setFlash(__('The user cart has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user cart could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserCart.' . $this->UserCart->primaryKey => $id));
			$this->request->data = $this->UserCart->find('first', $options);
		}
		$users = $this->UserCart->User->find('list');
		$services = $this->UserCart->Service->find('list');
		$servicePackages = $this->UserCart->ServicePackage->find('list');
		$this->set(compact('users', 'services', 'servicePackages'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserCart->id = $id;
		if (!$this->UserCart->exists()) {
			throw new NotFoundException(__('Invalid user cart'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserCart->delete()) {
			$this->Session->setFlash(__('The user cart has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user cart could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->UserCart->recursive = 0;
		$this->set('userCarts', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UserCart->exists($id)) {
			throw new NotFoundException(__('Invalid user cart'));
		}
		$options = array('conditions' => array('UserCart.' . $this->UserCart->primaryKey => $id));
		$this->set('userCart', $this->UserCart->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UserCart->create();
			if ($this->UserCart->save($this->request->data)) {
				$this->Session->setFlash(__('The user cart has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user cart could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserCart->User->find('list');
		$services = $this->UserCart->Service->find('list');
		$servicePackages = $this->UserCart->ServicePackage->find('list');
		$this->set(compact('users', 'services', 'servicePackages'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->UserCart->exists($id)) {
			throw new NotFoundException(__('Invalid user cart'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserCart->save($this->request->data)) {
				$this->Session->setFlash(__('The user cart has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user cart could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserCart.' . $this->UserCart->primaryKey => $id));
			$this->request->data = $this->UserCart->find('first', $options);
		}
		$users = $this->UserCart->User->find('list');
		$services = $this->UserCart->Service->find('list');
		$servicePackages = $this->UserCart->ServicePackage->find('list');
		$this->set(compact('users', 'services', 'servicePackages'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->UserCart->id = $id;
		if (!$this->UserCart->exists()) {
			throw new NotFoundException(__('Invalid user cart'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserCart->delete()) {
			$this->Session->setFlash(__('The user cart has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user cart could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
}