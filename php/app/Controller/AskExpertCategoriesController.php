<?php
App::uses('AppController', 'Controller');
/**
 * AskExpertCategories Controller
 *
 * @property AskExpertCategory $AskExpertCategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AskExpertCategoriesController extends AppController {

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
		$this->AskExpertCategory->recursive = 0;
		$this->set('askExperts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AskExpertCategory->exists($id)) {
			throw new NotFoundException(__('Invalid Ask Expert'));
		}
		$options = array('conditions' => array('AskExpertCategory.' . $this->AskExpertCategory->primaryKey => $id));
		$this->set('AskExpertCategory', $this->AskExpertCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AskExpertCategory->create();
			if ($this->AskExpertCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The Ask Expert has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ask Expert could not be saved. Please, try again.'));
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
		if (!$this->AskExpertCategory->exists($id)) {
			throw new NotFoundException(__('Invalid Ask Expert'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AskExpertCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The Ask Expert has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ask Expert could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AskExpertCategory.' . $this->AskExpertCategory->primaryKey => $id));
			$this->request->data = $this->AskExpertCategory->find('first', $options);
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
		$this->AskExpertCategory->id = $id;
		if (!$this->AskExpertCategory->exists()) {
			throw new NotFoundException(__('Invalid Ask Expert'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AskExpertCategory->delete()) {
			$this->Session->setFlash(__('The Ask Expert has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Ask Expert could not be deleted. Please, try again.'));
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
		$this->adminsessionchecked();
		$this->AskExpertCategory->recursive = 0;
		$findcond = array(
			'AskExpertCategory.is_deleted'=>'0',
		);
		$this->Paginator->settings=array(
			'conditions'=>$findcond
		);
		$this->set('askExpertCategories', $this->Paginator->paginate());
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
		if (!$this->AskExpertCategory->exists($id)) {
			throw new NotFoundException(__('Invalid Ask Expert Category'));
		}
		$options = array('conditions' => array('AskExpertCategory.' . $this->AskExpertCategory->primaryKey => $id));
		$this->set('askExpertCategory', $this->AskExpertCategory->find('first', $options));
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
			$this->AskExpertCategory->create();
			$this->request->data['AskExpertCategory']['createtime']=time();
			if ($this->AskExpertCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The Ask Expert Category has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ask Expert Category could not be saved. Please, try again.'));
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
		$this->adminsessionchecked();
		if (!$this->AskExpertCategory->exists($id)) {
			throw new NotFoundException(__('Invalid Ask Expert Category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AskExpertCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The Ask Expert Category has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ask Expert Category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AskExpertCategory.' . $this->AskExpertCategory->primaryKey => $id));
			$this->request->data = $this->AskExpertCategory->find('first', $options);
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
		$this->adminsessionchecked();
		$this->AskExpertCategory->id = $id;
		if (!$this->AskExpertCategory->exists()) {
			throw new NotFoundException(__('Invalid Ask Expert Category'));
		}
		$this->request->allowMethod('post', 'delete');
		$this->AskExpertCategory->saveField('is_deleted','1');
		$this->Session->setFlash(__('The Ask Expert Category has been deleted.'),'default',array('class'=>'success'));
		/*if ($this->AskExpertCategory->delete()) {
			$this->Session->setFlash(__('The Ask Expert Category has been deleted.'),'default',array('class'=>'success'));
		} else {
			$this->Session->setFlash(__('The Ask Expert Category could not be deleted. Please, try again.'));
		}*/
		return $this->redirect(array('action' => 'index'));
	}
	
/**
 * admin_askcatblocke method
 * @param string $id
 * @param steing $is_blocked
 */
	public function admin_askcatblocke($id=null,$is_blocked=0){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		$this->AskExpertCategory->id = $id;
		if (!$this->AskExpertCategory->exists()) {
			throw new NotFoundException(__('Invalid Ask Expert Category'));
		}
		$this->AskExpertCategory->saveField('is_blocked',$is_blocked);
		if($is_blocked==1){
			$this->Session->setFlash(__('The Ask Expert Category has been blocked.'),'default',array('class'=>'success'));
		}
		else{
			$this->Session->setFlash(__('The Ask Expert Category has been un blocked.'),'default',array('class'=>'success'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
