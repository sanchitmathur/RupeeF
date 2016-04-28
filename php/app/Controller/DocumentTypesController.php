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
		$this->adminsessionchecked();
		$this->DocumentType->recursive = 0;
		$this->Paginator->settings=array(
			'conditions'=>array(
				'DocumentType.is_deleted'=>'0'
			)
		);
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
		$this->adminsessionchecked();
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
		$this->adminsessionchecked();
		if ($this->request->is('post')) {
			$this->DocumentType->create();
			if ($this->DocumentType->save($this->request->data)) {
				$this->Session->setFlash(__('The Document Type has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The Document Type could not be saved. Please, try again.'));
			}
		}
		$is_user_provide = array('0'=>'No','1'=>'Yes');
		$this->set('is_user_provide',$is_user_provide);
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
		$this->adminsessionchecked();
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
		$is_user_provide = array('0'=>'No','1'=>'Yes');
		$this->set('is_user_provide',$is_user_provide);
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
		$this->adminsessionchecked();
		$this->DocumentType->id = $id;
		if (!$this->DocumentType->exists()) {
			throw new NotFoundException(__('Invalid Document Type'));
		}
		$this->request->allowMethod('post', 'delete');
		$this->DocumentType->saveField('is_deleted','1');
		
		/*if ($this->DocumentType->delete()) {
			$this->Session->setFlash(__('The Document Type has been deleted.'),'default',array('class'=>'success'));
		} else {
			$this->Session->setFlash(__('The Document Type could not be deleted. Please, try again.'));
		}*/
		
		$this->Session->setFlash(__('The Document Type has been deleted.'),'default',array('class'=>'success'));
		return $this->redirect(array('action' => 'index'));
	}
	
/**
 * admin_blockeunblocked method
 * @param string $id
 * @param string $is_blocked
 */
	public function admin_blockeunblocked($id=0,$is_blocked=0){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		if($id>0){
			$upcond = array('DocumentType.id'=>$id);
			$updata = array('DocumentType.is_blocked'=>$is_blocked);
			$this->DocumentType->updateAll($updata,$upcond);
			if($is_blocked){
				$message = "Successfully blocked the document type";
			}
			else{
				$message = "Successfully unblocked the document type";
			}
			$this->Session->setFlash(__($message),'default',array('class'=>'success'));
		}
		else{
			$message = "Invalid document type detail";
			$this->Session->setFlash(__($message));
		}
		$this->redirect(array('action'=>'index'));
	}
	
}
