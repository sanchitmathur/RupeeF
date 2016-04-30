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
	public function admin_index($user_id=0) {
		$this->layout="admindefault";
		$this->adminsessionchecked();
		$this->UserDocument->recursive = 0;
		
		if($this->request->is('post')){
			$user_id = isset($this->request->data['User']['user_id'])?$this->request->data['User']['user_id']:0;
		}
		if($user_id>0){
			$this->Paginator->settings=array(
				'conditions'=>array('UserDocument.user_id'=>$user_id)
			);	
		}
		$this->set('userDocuments', $this->Paginator->paginate());
		//load all uploaded user ids
		$finduser = array(
			'User.is_blocked'=>'0',
			'User.is_deleted'=>'0'
		);
		$this->UserDocument->User->displayField='name';
		$users = $this->UserDocument->User->find('list',array('conditions'=>$finduser));
		$users['0']="Select User";
		ksort($users);
		$this->set(compact('users'));
		$this->set('userId',$user_id);
		$alltypefilepaths = $this->alltypefilepaths();
		$thumb_filepath = $alltypefilepaths['dic']['userdocument_thumb'];
		$thumb_fileurl = $alltypefilepaths['url']['userdocument_thumb'];
		$this->set('thumb_filepath',$thumb_filepath);
		$this->set('thumb_fileurl',$thumb_fileurl);
		$this->set('allowedimage',$this->allowedimageType);
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
		if (!$this->UserDocument->exists($id)) {
			throw new NotFoundException(__('Invalid Document Type'));
		}
		$options = array('conditions' => array('UserDocument.' . $this->UserDocument->primaryKey => $id));
		$this->set('userDocument', $this->UserDocument->find('first', $options));
		$alltypefilepaths = $this->alltypefilepaths();
		$thumb_filepath = $alltypefilepaths['dic']['userdocument_thumb'];
		$thumb_fileurl = $alltypefilepaths['url']['userdocument_thumb'];
		$this->set('thumb_filepath',$thumb_filepath);
		$this->set('thumb_fileurl',$thumb_fileurl);
		$this->set('allowedimage',$this->allowedimageType);
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
		$this->adminsessionchecked();
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
		$this->adminsessionchecked();
		$this->UserDocument->id = $id;
		if (!$this->UserDocument->exists()) {
			throw new NotFoundException(__('Invalid User Document'));
		}
		$this->request->allowMethod('post', 'delete');
		
		
		/*if ($this->UserDocument->delete()) {
			$this->Session->setFlash(__('The User Document has been deleted.'),'default',array('class'=>'success'));
		} else {
			$this->Session->setFlash(__('The User Document could not be deleted. Please, try again.'));
		}*/
		
		return $this->redirect(array('action' => 'index'));
	}
	
/**
 * admin_docacceptreject method
 * @param string $id
 * @param string $approveReject
 * @return void
 */
	public function admin_docacceptreject($id=null,$approveReject=2){
		//$approveReject  : 2=Reject 1= approved
		$user_id=0;
		if($id>0){
			$upcond=array(
				'UserDocument.is_deleted'=>'0',
				'UserDocument.id'=>$id
			);
			$updata = array(
				'UserDocument.doc_status'=>$approveReject,
				'UserDocument.actiondate'=>"'".date('Y-m-d H:i:s')."'"
			);
			$this->UserDocument->updateAll($updata,$upcond);
			
			//get user information for send notifications
			$userdocument = $this->UserDocument->find('first',array('recursive'=>'0','conditions'=>$upcond));
			//pr($userdocument);
			//die();
			if(is_array($userdocument) && count($userdocument)>0){
				//validate user details
				if(isset($userdocument['User']) && count($userdocument['User'])>0){
					$user_id = $userdocument['User']['id'];
					$user_name = $userdocument['User']['name'];
					$user_email = $userdocument['User']['email'];
					$emaildata=array(
						'reciever_name'=>$user_name,
						'email'=>$user_email
					);
					if($approveReject==1){
						$this->allnotificationsection($this->emailSendAdminApprovedDocument,$user_id,$is_email_send='1',$emaildata);
					}
					else{
						$this->allnotificationsection($this->emailSendAdminRejectDocument,$user_id,$is_email_send='1',$emaildata);
					}
					
				}
			}
			
			if($approveReject==1){
				$message = "You approved that document successfully";
			}
			else{
				$message = "You rejected that document successfully";
			}
			$this->Session->setFlash(__($message),'default',array('class'=>'success'));
		}
		else{
			$this->Session->setFlash(__('Invalid Document details'));	
		}
		
		if($user_id>0){
			return $this->redirect(array('controller'=>'userDocuments','action'=>'index',$user_id));
		}
		else{
			return $this->redirect(array('controller'=>'userDocuments','action'=>'index'));
		}
		
	}
	
}
