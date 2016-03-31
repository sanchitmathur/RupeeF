<?php
App::uses('AppController', 'Controller');
/**
 * DocumentTypes Controller
 *
 * @property DocumentType $DocumentType
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DocumentTypesController extends AppController {

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
		$this->DocumentType->recursive = 0;
		$this->set('documentTypes', $this->Paginator->paginate());
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
		if (!$this->DocumentType->exists($id)) {
			throw new NotFoundException(__('Invalid Document Type'));
		}
		$options = array('conditions' => array('DocumentType.' . $this->DocumentType->primaryKey => $id));
		$this->set('documentType', $this->DocumentType->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->layout="admindefault";
		if ($this->request->is('post')) {
			$this->DocumentType->create();
			if ($this->DocumentType->save($this->request->data)) {
				$this->Session->setFlash(__('The Document Type has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The Document Type could not be saved. Please, try again.'));
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
		if (!$this->DocumentType->exists($id)) {
			throw new NotFoundException(__('Invalid Document Type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DocumentType->save($this->request->data)) {
				$this->Session->setFlash(__('The Document Type has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Document Type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DocumentType.' . $this->DocumentType->primaryKey => $id));
			$this->request->data = $this->DocumentType->find('first', $options);
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
		$this->DocumentType->id = $id;
		if (!$this->DocumentType->exists()) {
			throw new NotFoundException(__('Invalid Document Type'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->DocumentType->delete()) {
			$this->Session->setFlash(__('The Document Type has been deleted.'),'default',array('class'=>'success'));
		} else {
			$this->Session->setFlash(__('The Document Type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
