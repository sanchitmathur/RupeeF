<?php
App::uses('AppController', 'Controller');
/**
 * AskExperts Controller
 *
 * @property AskExpert $AskExpert
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AskExpertsController extends AppController {

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
		$this->AskExpert->recursive = 0;
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
		if (!$this->AskExpert->exists($id)) {
			throw new NotFoundException(__('Invalid Ask Expert'));
		}
		$options = array('conditions' => array('AskExpert.' . $this->AskExpert->primaryKey => $id));
		$this->set('AskExpert', $this->AskExpert->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AskExpert->create();
			if ($this->AskExpert->save($this->request->data)) {
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
		if (!$this->AskExpert->exists($id)) {
			throw new NotFoundException(__('Invalid Ask Expert'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AskExpert->save($this->request->data)) {
				$this->Session->setFlash(__('The Ask Expert has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ask Expert could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AskExpert.' . $this->AskExpert->primaryKey => $id));
			$this->request->data = $this->AskExpert->find('first', $options);
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
		$this->AskExpert->id = $id;
		if (!$this->AskExpert->exists()) {
			throw new NotFoundException(__('Invalid Ask Expert'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AskExpert->delete()) {
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
		$this->AskExpert->recursive = 0;
		$findcond = array(
			'AskExpert.is_deleted'=>'0',
			'AskExpert.ask_expert_category_id >'=>'0',
			'AskExpertCategory.id >'=>'0',
			'AskExpertCategory.is_blocked'=>'0',
			'AskExpertCategory.is_deleted'=>'0',
		);
		$this->Paginator->settings=array(
			'conditions'=>$findcond
		);
		$this->set('askExperts', $this->Paginator->paginate());
		
		$catfidcond = array(
			'AskExpertCategory.is_blocked'=>'0',
			'AskExpertCategory.is_deleted'=>'0',
		);
		
		$askExpertCategories = $this->AskExpert->AskExpertCategory->find('list',array('conditions'=>$catfidcond));
		$askExpertCategories['0']='Select One category';
		ksort($askExpertCategories);
		$this->set(compact('askExpertCategories'));
		$this->set('categoryId','');
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
		if (!$this->AskExpert->exists($id)) {
			throw new NotFoundException(__('Invalid Ask Expert'));
		}
		$options = array('conditions' => array('AskExpert.' . $this->AskExpert->primaryKey => $id));
		$this->set('AskExpert', $this->AskExpert->find('first', $options));
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
			$this->AskExpert->create();
			$this->request->data['AskExpert']['createtime']=time();
			if ($this->AskExpert->save($this->request->data)) {
				$this->Session->setFlash(__('The Ask Expert has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ask Expert could not be saved. Please, try again.'));
			}
		}
		//get all type category
		$this->AskExpert->AskExpertCategory->displayField='category_name';
		$catfidcond = array(
			'AskExpertCategory.is_blocked'=>'0',
			'AskExpertCategory.is_deleted'=>'0'
		);
		$askExpertCategories = $this->AskExpert->AskExpertCategory->find('list',array('conditions'=>$catfidcond));
		$this->set(compact('askExpertCategories'));
		
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
		if (!$this->AskExpert->exists($id)) {
			throw new NotFoundException(__('Invalid Ask Expert'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AskExpert->save($this->request->data)) {
				$this->Session->setFlash(__('The Ask Expert has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ask Expert could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AskExpert.' . $this->AskExpert->primaryKey => $id));
			$this->request->data = $this->AskExpert->find('first', $options);
		}
		$catfidcond = array(
			'AskExpertCategory.is_blocked'=>'0',
			'AskExpertCategory.is_deleted'=>'0'
		);
		$askExpertCategories = $this->AskExpert->AskExpertCategory->find('list',array('conditions'=>$catfidcond));
		$this->set(compact('askExpertCategories'));
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
		$this->AskExpert->id = $id;
		if (!$this->AskExpert->exists()) {
			throw new NotFoundException(__('Invalid Ask Expert'));
		}
		$this->request->allowMethod('post', 'delete');
		$this->AskExpert->saveField('is_deleted','1');
		/*if ($this->AskExpert->delete()) {
			$this->Session->setFlash(__('The Ask Expert has been deleted.'),'default',array('class'=>'success'));
		} else {
			$this->Session->setFlash(__('The Ask Expert could not be deleted. Please, try again.'));
		}*/
		$this->Session->setFlash(__('The Ask Expert has been deleted.'),'default',array('class'=>'success'));
		return $this->redirect(array('action' => 'index'));
	}
	
/**
 * admin_questionenable method
 * @param string $id
 * @param string $is_blocked
 */
	public function admin_questionenable($id=null,$is_blocked=0){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		$this->AskExpert->id = $id;
		if (!$this->AskExpert->exists()) {
			throw new NotFoundException(__('Invalid Ask Expert'));
		}
		$this->AskExpert->saveField('is_blocked',$is_blocked);
		if($is_blocked==1){
			$this->Session->setFlash(__('The Ask Expert has been blocked.'),'default',array('class'=>'success'));
		}
		else{
			$this->Session->setFlash(__('The Ask Expert has been un blocked.'),'default',array('class'=>'success'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
}
