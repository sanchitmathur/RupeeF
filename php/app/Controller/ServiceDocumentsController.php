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
 * @param string $service_id
 * @return void
 */
	public function admin_add($service_id=null) {
		$this->layout="admindefault";
		//load models
		$this->loadModel('Service');
		$this->loadModel('DocumentType');
		
		if ($this->request->is('post')) {
			//pr($this->request->data);
			//validation section
			$posteddata = $this->request->data;
			$pserviceid=isset($posteddata['ServiceDocument']['service_id'])?$posteddata['ServiceDocument']['service_id']:0;
			$pdocttypeid=isset($posteddata['ServiceDocument']['document_type_id'])?$posteddata['ServiceDocument']['document_type_id']:0;
			//die();
			$message="";
			if($pserviceid<1){
				$message.="Please choose one service";	
			}
			if($pdocttypeid<1){
				if($message!=''){
					$message.=" </br>";
				}
				$message.="Please choose document type";
			}
			if($message==''){
				//go ahead
				/*if(is_array($pdocttypeid) && count($pdocttypeid)>0){
					foreach($pdocttypeid as $key=>$val){
						if($key==0 && count($pdocttypeid)==1){
							
						}
					}
				}*/
				//validaye is allready added or not
				$findcond = array('ServiceDocument.service_id'=>$pserviceid,
						  'ServiceDocument.document_type_id'=>$pdocttypeid,
						  'ServiceDocument.is_blocked'=>'0',
						  'ServiceDocument.is_deleted'=>'0'
						  );
				$iscount = $this->ServiceDocument->find('count',array('constions'=>$findcond));
				if($iscount>0){
					$this->Session->setFlash(__('The Service Document has been saved.'),'default',array('class'=>'success'));
				}
				else{
					$this->ServiceDocument->create();
					if ($this->ServiceDocument->save($this->request->data)) {
						$this->Session->setFlash(__('The Service Document has been saved.'),'default',array('class'=>'success'));
						return $this->redirect(array('action' => 'add'));
					} else {
						$this->Session->setFlash(__('The Service Document could not be saved. Please, try again.'));
					}
				}
			}
			else{
				$this->Session->setFlash(__($message));
			}
			
		}
		//set all service type and the doct type
		$sercond = array('Service.is_blocked'=>'0','Service.is_deleted'=>'0');
		if($service_id>0){
			$sercond['Service.service_id']=$service_id;
		}
		
		$services=$this->Service->find('list',array('conditions'=>$sercond));
		$services['0']="Select Service";
		ksort($services);
		//doct type
		$doctcon = array('DocumentType.is_blocked'=>'0','DocumentType.is_deleted'=>'0');
		$documentTypes = $this->DocumentType->find('list',array('conditions'=>$doctcon));
		$documentTypes['0']="Select Document Type";
		ksort($documentTypes);
		$this->set(compact(array('services','documentTypes')));
		
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
