<?php
App::uses('AppController', 'Controller');
/**
 * RelatedServices Controller
 *
 * @property RelatedService $RelatedService
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RelatedServicesController extends AppController {

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
		$this->RelatedService->recursive = 0;
		$this->set('relatedServices', $this->Paginator->paginate());
	}
}
