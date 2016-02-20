<?php
App::uses('AppController', 'Controller');
/**
 * ServiceFaqs Controller
 *
 * @property ServiceFaq $ServiceFaq
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ServiceFaqsController extends AppController {

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
		$this->ServiceFaq->recursive = 0;
		$this->set('serviceFaqs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ServiceFaq->exists($id)) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		$options = array('conditions' => array('ServiceFaq.' . $this->ServiceFaq->primaryKey => $id));
		$this->set('serviceFaq', $this->ServiceFaq->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ServiceFaq->create();
			if ($this->ServiceFaq->save($this->request->data)) {
				$this->Session->setFlash(__('The service faq has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service faq could not be saved. Please, try again.'));
			}
		}
		$services = $this->ServiceFaq->Service->find('list');
		$this->set(compact('services'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ServiceFaq->exists($id)) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServiceFaq->save($this->request->data)) {
				$this->Session->setFlash(__('The service faq has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service faq could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ServiceFaq.' . $this->ServiceFaq->primaryKey => $id));
			$this->request->data = $this->ServiceFaq->find('first', $options);
		}
		$services = $this->ServiceFaq->Service->find('list');
		$this->set(compact('services'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ServiceFaq->id = $id;
		if (!$this->ServiceFaq->exists()) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ServiceFaq->delete()) {
			$this->Session->setFlash(__('The service faq has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service faq could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ServiceFaq->recursive = 0;
		$this->set('serviceFaqs', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ServiceFaq->exists($id)) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		$options = array('conditions' => array('ServiceFaq.' . $this->ServiceFaq->primaryKey => $id));
		$this->set('serviceFaq', $this->ServiceFaq->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ServiceFaq->create();
			if ($this->ServiceFaq->save($this->request->data)) {
				$this->Session->setFlash(__('The service faq has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service faq could not be saved. Please, try again.'));
			}
		}
		$services = $this->ServiceFaq->Service->find('list');
		$this->set(compact('services'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ServiceFaq->exists($id)) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServiceFaq->save($this->request->data)) {
				$this->Session->setFlash(__('The service faq has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service faq could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ServiceFaq.' . $this->ServiceFaq->primaryKey => $id));
			$this->request->data = $this->ServiceFaq->find('first', $options);
		}
		$services = $this->ServiceFaq->Service->find('list');
		$this->set(compact('services'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ServiceFaq->id = $id;
		if (!$this->ServiceFaq->exists()) {
			throw new NotFoundException(__('Invalid service faq'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ServiceFaq->delete()) {
			$this->Session->setFlash(__('The service faq has been deleted.'));
		} else {
			$this->Session->setFlash(__('The service faq could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
