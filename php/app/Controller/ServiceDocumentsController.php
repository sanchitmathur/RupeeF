<?php
App::uses('AppController', 'Controller');
/**
 * ServiceDocuments Controller
 *
 * @property ServiceDocument $ServiceDocument
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ServiceDocumentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->layout="admindefault";
		$this->ServiceDocument->recursive = 0;
		$this->set('serviceDocuments', $this->Paginator->paginate());
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
		if (!$this->ServiceDocument->exists($id)) {
			throw new NotFoundException(__('Invalid Service Document'));
		}
		$options = array('conditions' => array('ServiceDocument.' . $this->ServiceDocument->primaryKey => $id));
		$this->set('serviceDocument', $this->ServiceDocument->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->layout="admindefault";
		if ($this->request->is('post')) {
			$this->ServiceDocument->create();
			if ($this->ServiceDocument->save($this->request->data)) {
				$this->Session->setFlash(__('The Service Document has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The Service Document could not be saved. Please, try again.'));
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
		if (!$this->ServiceDocument->exists($id)) {
			throw new NotFoundException(__('Invalid Service Document'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServiceDocument->save($this->request->data)) {
				$this->Session->setFlash(__('The Service Document has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Service Document could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ServiceDocument.' . $this->ServiceDocument->primaryKey => $id));
			$this->request->data = $this->ServiceDocument->find('first', $options);
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
		$this->ServiceDocument->id = $id;
		if (!$this->ServiceDocument->exists()) {
			throw new NotFoundException(__('Invalid Service Document'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ServiceDocument->delete()) {
			$this->Session->setFlash(__('The Service Document has been deleted.'),'default',array('class'=>'success'));
		} else {
			$this->Session->setFlash(__('The Service Document could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
