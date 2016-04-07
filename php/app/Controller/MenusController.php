<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MenusController extends AppController {

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
		$this->Menu->recursive = 0;
		$this->set('menus', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
		$this->set('menu', $this->Menu->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
			}
		}
		$services = $this->Menu->Service->find('list');
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
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
			$this->request->data = $this->Menu->find('first', $options);
		}
		$services = $this->Menu->Service->find('list');
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
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Menu->delete()) {
			$this->Session->setFlash(__('The menu has been deleted.'));
		} else {
			$this->Session->setFlash(__('The menu could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @param string $id
 * @return void
 */
	public function admin_index($id=0) {
		$this->layout="admindefault";
		
		$this->Menu->recursive = 0;
		$conditions = array('Menu.is_blocked'=>'0','Menu.is_deleted'=>'0');
		$conditions1=$conditions;
		if($this->request->is('post')){
			$id=$this->request->data['Menu']['parent_menu_id'];
		}
		if($id>0){
			$conditions['OR']['Menu.parent_menu_id']=$id;
			$conditions['OR']['Menu.id']=$id;
			
			$conditions1['Menu.parent_menu_id']=$id;
		}
		else{
			$conditions['Menu.parent_menu_id']='0';
			$conditions1['Menu.parent_menu_id']='0';
		}
		
		$this->set('menus', $this->Paginator->paginate($conditions1));
		
		
		$parentMenus = $this->Menu->find('list',array('conditions'=>$conditions));
		$parentMenus['0']='Select menu';
		ksort($parentMenus);
		$this->set(compact('parentMenus'));
		$this->set('parentMenuId',$id);
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
		$this->set('menu', $this->Menu->find('first', $options));
	}

/**
 * admin_add method
 *
 * @param string $parent_menu_id
 * @return void
 */
	public function admin_add($parent_menu_id=0) {
		$this->layout="admindefault";
		if ($this->request->is('post')) {
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
			}
		}
		$services = $this->Menu->Service->find('list');
		$services['0']="Select Service";
		ksort($services);
		$parentMenus = $this->Menu->find('list',array('conditions'=>array('Menu.is_blocked'=>'0','Menu.is_deleted'=>'0')));
		$this->set(compact(array('services','parentMenus')));
		$this->set('parent_menu_id',$parent_menu_id);
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
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
			$this->request->data = $this->Menu->find('first', $options);
		}
		$services = $this->Menu->Service->find('list');
		//$this->set(compact('services'));*/
		
		$services['0']="Select Service";
		ksort($services);
		$parentMenus = $this->Menu->find('list',array('conditions'=>array('Menu.is_blocked'=>'0','Menu.is_deleted'=>'0')));
		$this->set(compact(array('services','parentMenus')));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Menu->delete()) {
			$this->Session->setFlash(__('The menu has been deleted.'));
		} else {
			$this->Session->setFlash(__('The menu could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
/**
 * menus method
 *
 * @return json
 */
	public function menus(){
		$cond = array(
			'Menu.is_blocked'=>'0',
			'Menu.is_deleted'=>'0',
		);
		$option = array(
			'conditions'=>$cond
		);
		$menuData = $this->Menu->find('all',$option);
		//pr($menuData);
		
		$menus = array();
		foreach($menuData as $menu){
			$menu_id = isset($menu['Menu']['id'])?$menu['Menu']['id']:0;
			$parent_menu_id = isset($menu['Menu']['parent_menu_id'])?$menu['Menu']['parent_menu_id']:0;
			$menu_name = isset($menu['Menu']['name'])?$menu['Menu']['name']:'';
			$heading = isset($menu['Menu']['heading'])?$menu['Menu']['heading']:'';
			$description = isset($menu['Menu']['description'])?$menu['Menu']['description']:'';
			
			$data = array(
				'menu_id'=>$menu_id,
				'parent_menu_id'=>$parent_menu_id,
				'menu_name'=>$menu_name,
				'menu_description'=>array(
					'heading'=>$heading,
					'description'=>$description,
				)
			);
			array_push($menus,$data);
		}
		die(json_encode($menus));
	}
	
}
