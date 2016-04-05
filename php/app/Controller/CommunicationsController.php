<?php
App::uses('AppController', 'Controller');
/**
 * Communications Controller
 *
 * @property Communication $Communications
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CommunicationsController extends AppController {

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
		$this->City->recursive = 0;
		$this->set('cities', $this->Paginator->paginate());
	}
}
