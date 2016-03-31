<?php
App::uses('AppController', 'Controller');
/**
 * MainServices Controller
 *
 * @property MainService $MainService
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MainServicesController extends AppController {

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
		$this->MainService->recursive = 0;
		$this->set('mainServices', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MainService->exists($id)) {
			throw new NotFoundException(__('Invalid main service'));
		}
		$options = array('conditions' => array('MainService.' . $this->MainService->primaryKey => $id));
		$this->set('mainService', $this->MainService->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MainService->create();
			if ($this->MainService->save($this->request->data)) {
				$this->Session->setFlash(__('The main service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The main service could not be saved. Please, try again.'));
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
		if (!$this->MainService->exists($id)) {
			throw new NotFoundException(__('Invalid main service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MainService->save($this->request->data)) {
				$this->Session->setFlash(__('The main service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The main service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MainService.' . $this->MainService->primaryKey => $id));
			$this->request->data = $this->MainService->find('first', $options);
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
		$this->MainService->id = $id;
		if (!$this->MainService->exists()) {
			throw new NotFoundException(__('Invalid main service'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MainService->delete()) {
			$this->Session->setFlash(__('The main service has been deleted.'));
		} else {
			$this->Session->setFlash(__('The main service could not be deleted. Please, try again.'));
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
		$this->MainService->recursive = 0;
		$this->set('mainServices', $this->Paginator->paginate());
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
		if (!$this->MainService->exists($id)) {
			throw new NotFoundException(__('Invalid main service'));
		}
		$options = array('conditions' => array('MainService.' . $this->MainService->primaryKey => $id));
		$this->set('mainService', $this->MainService->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->layout="admindefault";
		if ($this->request->is('post')) {
			$this->MainService->create();
			if ($this->MainService->save($this->request->data)) {
				$this->Session->setFlash(__('The main service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The main service could not be saved. Please, try again.'));
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
		$this->layout="admindefault";
		if (!$this->MainService->exists($id)) {
			throw new NotFoundException(__('Invalid main service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MainService->save($this->request->data)) {
				$this->Session->setFlash(__('The main service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The main service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MainService.' . $this->MainService->primaryKey => $id));
			$this->request->data = $this->MainService->find('first', $options);
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
		$this->layout="admindefault";
		$this->MainService->id = $id;
		if (!$this->MainService->exists()) {
			throw new NotFoundException(__('Invalid main service'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MainService->delete()) {
			$this->Session->setFlash(__('The main service has been deleted.'));
		} else {
			$this->Session->setFlash(__('The main service could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
/**
 * services method
 *
 * @return void
 */
	public function services(){
		$this->layout = "main";
		
		$this->MainService->recursive = 2;
		$this->set('mainServices', $this->Paginator->paginate());
		
		$session_id = $this->Session->read('session_id');
		
		if(empty($session_id)){
			$session_id = $this->Session->id();
			//$this->set('session_id',$session_id);
			$this->Session->write('session_id',$session_id);
		}
		
		$this->numberOfItemInCart();
	}
	
}
