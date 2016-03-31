<?php
App::uses('AppController', 'Controller');
/**
 * UserDocuments Controller
 *
 * @property UserDocument $UserDocument
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserDocumentsController extends AppController {

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
		$this->UserDocument->recursive = 0;
		$this->set('userDocuments', $this->Paginator->paginate());
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
		if (!$this->UserDocument->exists($id)) {
			throw new NotFoundException(__('Invalid Document Type'));
		}
		$options = array('conditions' => array('UserDocument.' . $this->UserDocument->primaryKey => $id));
		$this->set('documentType', $this->UserDocument->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->layout="admindefault";
		if ($this->request->is('post')) {
			$this->UserDocument->create();
			if ($this->UserDocument->save($this->request->data)) {
				$this->Session->setFlash(__('The User Document has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The User Document could not be saved. Please, try again.'));
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
		if (!$this->UserDocument->exists($id)) {
			throw new NotFoundException(__('Invalid User Document'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserDocument->save($this->request->data)) {
				$this->Session->setFlash(__('The User Document has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The User Document could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserDocument.' . $this->UserDocument->primaryKey => $id));
			$this->request->data = $this->UserDocument->find('first', $options);
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
		$this->UserDocument->id = $id;
		if (!$this->UserDocument->exists()) {
			throw new NotFoundException(__('Invalid User Document'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserDocument->delete()) {
			$this->Session->setFlash(__('The User Document has been deleted.'),'default',array('class'=>'success'));
		} else {
			$this->Session->setFlash(__('The User Document could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
