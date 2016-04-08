<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Thumb');
	public $user_page_limit=30;

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->layout="user_inner_main";
		//validation
		$this->usersessionchecked();
		$user_id = $this->Session->read('user.user_id');
		//get all byed service data og the user
		$this->loadModel('UserServicePackage');
		$findcond = array(
			'UserServicePackage.user_id'=>$user_id,
			'UserServicePackage.transaction_id >'=>'0',
			'UserServicePackage.is_blocked'=>'0',
			'UserServicePackage.is_deleted'=>'0',
			'Transaction.id >'=>'0',
			'Transaction.is_completed'=>'1',
			'UserServicePackage.is_completed'=>'0'
		);
		//unbind models
		$this->UserServicePackage->unbindModel(array(
			'belongsTo'=>array('User','ServicePackage')
		));
		$this->UserServicePackage->ServicePackage->unbindModel(array(
			'belongsTo'=>array('Service')
		));
		$this->UserServicePackage->Service->unbindModel(array(
			'hasMany'=>array('ServiceAdvantage','ServiceFaq','ServicePackage')
		));
		$this->UserServicePackage->Service->SubService->unbindModel(array(
			'belongsTo'=>array('MainService'),
			'hasMany'=>array('Service')
		));
		$this->UserServicePackage->Transaction->unbindModel(array(
			'hasMany'=>array('UserServicePackage')
		));
		//
		//now bind the service doct
		
		$userservicepackages = $this->UserServicePackage->find('all',array('recursive'=>'3','conditions'=>$findcond));
		//all uploaded doc of the user
		$uploaddocfindcond = array('UserDocument.user_id'=>$user_id,'UserDocument.doc_status'=>array('0','1'),'UserDocument.is_deleted'=>'0');
		$this->User->UserDocument->displayField="document_type_id";
		$userdocuments = $this->User->UserDocument->find('list',array('conditions'=>$uploaddocfindcond));
		if(is_array($userdocuments) && count($userdocuments)>0){
			$userdocuments = array_keys($userdocuments);
		}
		else{
			$userdocuments=array();
		}
		//others related services
		$relatedServices = array();
		if(count($userservicepackages)>0){
			$this->UserServicePackage->displayField="service_id";
			$findcond = array(
				'UserServicePackage.user_id'=>$user_id,
				'UserServicePackage.transaction_id >'=>'0',
				'UserServicePackage.is_blocked'=>'0',
				'UserServicePackage.is_deleted'=>'0',
				'UserServicePackage.is_completed'=>'0'
			);
			$userbyeservicelist = $this->UserServicePackage->find('list',array('conditions'=>$findcond));
			if(count($userbyeservicelist)>0){
				$this->loadModel('RelatedService');
				$buyed_service_ids = array_values($userbyeservicelist);
				//get the service details
				$cond=array('RelatedService.service_id'=>$buyed_service_ids,'RelatedService.other_service_id !='=>$buyed_service_ids);
				//unbind model
				$this->RelatedService->displayField='other_service_id';
				$relatedServices=$this->RelatedService->find('list',array('conditions'=>$cond));
				//pr($relatedServices);
				//die();
			}
		}
		//
		$servicefind=array(
			'Service.is_blocked'=>'0',
			'Service.is_deleted'=>'0'
		);
		if(count($relatedServices)>0){
			$service_ids = array_values($relatedServices);
			$servicefind['Service.id']=$service_ids;
		}
		//unbind section
		$this->RelatedService->Service->unbindModel(array(
			'belongsTo'=>array('SubService'),
			'hasMany'=>array('ServiceAdvantage','ServiceFaq','ServiceDocument')
		));
		
		//bind the servicepackage details
		/*$this->RelatedService->Service->bindModel(array(
			'hasMany'=>array(
				'ServicePackage'=>array(
					'className'=>'ServicePackage',
					'foreingKey'=>'service_id',
					//'conditions'=>array('ServicePackage.package_name'=>'Basic')
					'limit'
				)
			)
		));*/
		$relatedServices = $this->RelatedService->Service->find('all',array('recurcive'=>'1','conditions'=>$servicefind));
		//valued set to the page
		$this->set('userdocuments',$userdocuments);
		$this->set('userservicepackages',$userservicepackages);
		$this->set('relatedServices',$relatedServices);
	}
/**
 * documents method
 * @return void
 */
	public function documents(){
		$this->layout="user_inner_main";
		//validation
		$this->usersessionchecked();
		//get all the documents and
		$user_id = $this->Session->read('user.user_id');
		$findcod=array('UserDocument.user_id'=>$user_id,'UserDocument.is_deleted'=>'0');
		$userdocumens = $this->User->UserDocument->find('all',array('recursive'=>'1','conditions'=>$findcod,'limit'=>$this->user_page_limit));
		
		$this->set('userdocumens',$userdocumens);
	}
	
/**
 * documentupload method
 * @param string $id
 * @return void
 */
	public function documentupload($id=null){
		$this->layout="user_inner_main";
		//load model
		$this->loadModel('DocumentType');
		//validation
		$this->usersessionchecked();
		$user=$this->Session->read('user');
		$user_id=$user['user_id'];
		
		if($this->request->is(array('post','put'))){
			$posteddata = $this->request->data;
			$doctypeid = isset($posteddata['UserDocument']['document_type_id'])?$posteddata['UserDocument']['document_type_id']:0;
			$doctfile = isset($posteddata['UserDocument']['doc_name'])?$posteddata['UserDocument']['doc_name']:array();
			$olddoctfile = isset($posteddata['UserDocument']['old_doc_name'])?$posteddata['UserDocument']['old_doc_name']:'';
			$doc_id = isset($posteddata['UserDocument']['id'])?$posteddata['UserDocument']['id']:'0';
			//pr($posteddata);
			//die();
			
			//validation
			$message="";
			if($doctypeid<1){
				$message.="Please choose one document type";
			}
			else{
				//file validation
				if(isset($doctfile['size']) && $doctfile['size']>0){
					$filename = time()."_".$this->replacespecialcharacter($doctfile['name']);
					$alltypefilepaths = $this->alltypefilepaths();
					$basepath = $alltypefilepaths['dic']['userdocument'];
					$isImage=true;
					if(!in_array(strtolower($doctfile['type']),$this->allowedimageType)){
						$isImage=false;
					}
					
					if(move_uploaded_file($doctfile['tmp_name'],$basepath.$filename)){
						//after upload create thum nail
						if($isImage){
							$soucepath=$basepath.$filename;
							$destination = $alltypefilepaths['dic']['userdocument_thumb'].$filename;
							$this->Thumb->createthumb( $soucepath, $destination, $this->thu , $height = 0 ) ;
						}
						
						//old doct file should remove from the
						if($olddoctfile!=''){
							$bgfls=$basepath.$olddoctfile;
							$thmbfls=$alltypefilepaths['dic']['userdocument_thumb'].$olddoctfile;
							if(file_exists($bgfls)){
								unlink($bgfls);
							}
							if(file_exists($thmbfls)){
								unlink($thmbfls);
							}
						}
						//now save the data into db
						$posteddata['UserDocument']['doc_name']=$filename;
						$posteddata['UserDocument']['user_id']=$user_id;
						$posteddata['UserDocument']['doc_status']='0';
						
						if($this->User->UserDocument->save($posteddata)){
							//saved the doc
							
						}
					}
					else{
						$filename="";
						if($message!=''){
							$message.="</br>";
						}
						$message.="Please upload a file";
					}
				}
				else{
					if($doc_id==0){
						if($message!=''){
							$message.="</br>";
						}
						$message.="Please upload a file";
					}
					else{
						$posteddata['UserDocument']['doc_name']=$olddoctfile;
					}
				}
				
			}
			
			//redirect
			if($message!=''){
				
				$this->Session->setFlash(__($message),'default',array('class'=>'error'));
			}
			else{
				$this->Session->setFlash(__('The user document has been saved.'));
			}
			if($id>0){
				return $this->redirect(array('action'=>'documents'));
			}
			else{
				return $this->redirect(array('action'=>'documentupload'));
			}
			
		}
		else{
			if($id>0){
				$doccond=array('UserDocument.id'=>$id,'UserDocument.user_id'=>$user_id,'UserDocument.is_deleted'=>'0');
				$userDocument = $this->User->UserDocument->find('first',array('recursive'=>'0','conditions'=>$doccond));
				if(isset($userDocument['UserDocument'])){
					$userDocument['UserDocument']['old_doc_name']=$userDocument['UserDocument']['doc_name'];
				}
				$this->request->data=$userDocument;
			}
		}
		//get all type of document
		//doct type
		$doctcon = array('DocumentType.is_blocked'=>'0','DocumentType.is_deleted'=>'0','DocumentType.is_user_provide'=>'1');
		$documentTypes = $this->DocumentType->find('list',array('conditions'=>$doctcon));
		$documentTypes['0']="Select Document Type";
		ksort($documentTypes);
		$this->set(compact(array('documentTypes')));
	}

/**
 * downloaddoc method
 * @param string $filename
 * 
 */
	public function downloaddoc($filename=''){
		$this->usersessionchecked();
		$alltypefilepaths = $this->alltypefilepaths();
		$basepath = $alltypefilepaths['dic']['userdocument'];
		$file=$basepath.$filename;
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
		}
		else{
			//$this->Session->setFlash(__('Invalid re'),'default',array('class'=>'error'));
			return $this->redirect(array('action'=>'documents'));
		}
	}
	
/**
 * deletedoc method
 * @param string $id
 */
	public function deletedoc($id=null){
		$this->usersessionchecked();
		if($id>0){
			$user_id=$this->Session->read('user.user_id');
			$findcond = array('UserDocument.id'=>$id,'UserDocument.is_deleted'=>'0','UserDocument.user_id'=>$user_id);
			$doccount= $this->User->UserDocument->find('count',array('conditions'=>$findcond));
			if($doccount==1){
				//update the the soc as deleted
				$upcond = array('UserDocument.is_deleted'=>'1');
				$this->User->UserDocument->updateAll($upcond,$findcond);
				$this->Session->setFlash(__('Document delete successfully'));
			}
			else{
				$this->Session->setFlash(__('Request not found'),'default',array('class'=>'error'));
			}
		}
		else{
			$this->Session->setFlash(__('Request not found'),'default',array('class'=>'error'));
		}
		return $this->redirect(array('action'=>'documents'));
	}
	
/**
 * notificaions method
 *
 * @return void
 */
	public function notifications(){
		$this->layout="user_inner_main";
		//validation
		$this->usersessionchecked();
		$user=$this->Session->read('user');
		$user_id=$user['user_id'];
		
		$findcond = array('Notification.is_user_deleted'=>'0','Notification.user_id'=>$user_id);
		$notifications = $this->User->Notification->find('all',array('recursive'=>'0','conditions'=>$findcond,'limit'=>$this->user_page_limit));
		$this->set('notifications',$notifications);
	}
/**
 * notificationdelete method
 * @param string $notification_id
 */
	public function notificationdelete($notification_id=null){
		$this->layout="user_inner_main";
		//validation
		$this->usersessionchecked();
		if($notification_id>0){
			$user=$this->Session->read('user');
			$user_id = isset($user['user_id'])?$user['user_id']:'0';
			$findcond = array('Notification.id'=>$notification_id,'Notification.user_id'=>$user_id);
			$notification = $this->User->Notification->find('count',array('conditions'=>$findcond));
			if($notification>0){
				$updata = array('Notification.is_user_deleted'=>'1');
				$this->User->Notification->updateAll($updata,$findcond);
				$this->Session->setFlash(__('Notification removed successfully'));
			}
			else{
				$this->Session->setFlash(__('Invalid Notification selection'),'default',array('class'=>'error'));
			}
			
		}
		else{
			$this->Session->setFlash(__('Invalid notification'),'default',array('class'=>'error'));
		}
		return $this->redirect(array('action'=>'notifications'));
	}
	

/**
 * orderhistory method
 *
 * @return void
 */
	public function orderhistory(){
		$this->layout="user_inner_main";
		//validation
		$this->usersessionchecked();
		
	}
	
/**
 * askexpert method
 *
 * @return void
 */
	public function askexpert(){
		$this->layout="user_inner_main";
		//validation
		$this->usersessionchecked();
	}
	
/**
 * communication method
 *
 * @return void
 */
	public function communication(){
		$this->layout="user_inner_main";
		//validation
		$this->usersessionchecked();
		//load the communication desing
		$this->loadModel('Communication');
		$user_id = $this->Session->read('user.user_id');
		
		$findcond = array('Communication.reciever_id'=>$user_id,'Communication.is_deleted'=>'0');
		//load last paginate data
		$total_rec = $this->Communication->find('count',array('conditions'=>$findcond,'limit'=>$this->user_page_limit));
		$offset=0;
		if($total_rec>$this->user_page_limit){
			$offset=$total_rec-$this->user_page_limit;
		}
		$communications = $this->Communication->find('all',array('recursive'=>'1','conditions'=>$findcond,'offset'=>$offset,'limit'=>$this->user_page_limit));
		
		$this->set('communications',$communications);
	}
	
/**
 * postmessage method
 * 
 */
	public function postmessage(){
		$this->usersessionchecked();
		$message_id=0;
		$status="0";
		$message="";
		if($this->request->is('post')){
			$user_id=$this->Session->read('user.user_id');
			$posteddata=$this->request->data;
			$messagetext=(isset($posteddata['messagetext']) && $posteddata['messagetext']!='')?$posteddata['messagetext']:'';
			$is_ajax_post=(isset($posteddata['is_ajax_post']))?'1':'0';
			if($user_id>0 && $messagetext!=''){
				//now post section
				$this->loadModel('Communication');
				
				$postdata = array(
					'Communication'=>array(
						'user_id'=>$user_id,
						'admin_user_id'=>'0',
						'reciever_id'=>$user_id,
						'message'=>"'".$messagetext."'",
						'create_date'=>date("Y-m-d G:i:s"),
						'is_user_post'=>'1',
					)
				);
				if($this->Communication->save($postdata)){
					$message_id=$this->Communication->id;
					$status='1';
				}
			}
		}
		if($is_ajax_post==1){
			die(json_encode(array('status'=>$status,'message'=>$message,'communication_id'=>$message_id)));
		}
		else{
			return $this->redirect(array('action'=>'communication'));
		}
	}
	
/**
 * getoldmessages method
 */
	public function getoldmessages(){
		$this->usersessionchecked();
		$communications=array();
		$status="0";
		$message="";
		if($this->request->is('post')){
			$user_id=$this->Session->read('user.user_id');
			$posteddata=$this->request->data;
			$communication_id=(isset($posteddata['communication_id']) )?$posteddata['communication_id']:'0';
			if($user_id>0 && $communication_id >0){
				$this->loadModel('Communication');
				$findcond = array('Communication.reciever_id'=>$user_id,'Communication.is_deleted'=>'0','Communication.id <'=>$communication_id);
				//load last paginate data
				$total_rec = $this->Communication->find('count',array('conditions'=>$findcond,'limit'=>$this->user_page_limit));
				$offset=0;
				if($total_rec>$this->user_page_limit){
					$offset=$total_rec-$this->user_page_limit;
				}
				$status='1';
				$communications = $this->Communication->find('all',array('recursive'=>'1','conditions'=>$findcond,'offset'=>$offset,'limit'=>$this->user_page_limit));
			}
		}
		die(json_encode(array('status'=>$status,'message'=>$message,'communications'=>$communications)));
	}
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * registration method
 *
 * @return void
 */
	public function registration(){
		$this->layout = "main";
		$this->loggeduserredirect();
		
		$service = array();
		if($this->request->is('post','put')){
			$reqdata = $this->request->data;
			
			$service_ids = isset($reqdata['service_ids'])?$reqdata['service_ids']:"";
			$service_package_ids = isset($reqdata['service_package_ids'])?$reqdata['service_package_ids']:"";
			
			$service_id = isset($reqdata['service_id'])?$reqdata['service_id']:0;
			$service_package_id = isset($reqdata['service_package_id'])?$reqdata['service_package_id']:0;
			$service = array(
				'service_ids'=>$service_ids,
				'service_package_ids'=>$service_package_ids,
			);
			$this->Session->write('service',$service);
		}
		$cities = $this->getCityList();
		$this->set(compact('cities'));
		
		$languages = $this->getLanguageList();
		$this->set(compact('languages'));
		
		//$this->set('service',$service);
	}
	
/**
 * signUp method
 *
 * @return void
 */
	public function signUp(){
		
		$this->loggeduserredirect();
		
		if($this->request->is('post','put')){
			$reqdata = $this->request->data;
			// pr($reqdata);
			// die();
			$registration = isset($reqdata['registration'])?$reqdata['registration']:0;
			$name = isset($reqdata['name'])?$reqdata['name']:"";
			$email = isset($reqdata['email'])?$reqdata['email']:"";
			$password = isset($reqdata['password'])?$reqdata['password']:"";
			$confpassword = isset($reqdata['confpassword'])?$reqdata['confpassword']:"";
			$phone_no = isset($reqdata['phone_no'])?$reqdata['phone_no']:"";
			$address = isset($reqdata['address'])?$reqdata['address']:"";
			$city_id = isset($reqdata['city'])?$reqdata['city']:0;
			$language_id = isset($reqdata['language'])?$reqdata['language']:0;
			
			if($name == ""){
				$this->Session->setFlash(__("Please enter name."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($email == ""){
				$this->Session->setFlash(__("Please enter email."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			$cond = array(
				'User.email'=>$email
			);
			$option = array(
				'conditions'=>$cond,
			);
			$userDataCount = $this->User->find('count',$option);
			if($userDataCount > 0){
				$this->Session->setFlash(__("Email already exist."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$this->Session->setFlash(__("Please enter valid email."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($password == ""){
				$this->Session->setFlash(__("Please enter password."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($confpassword == ""){
				$this->Session->setFlash(__("Please confirm password."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($password != $confpassword){
				$this->Session->setFlash(__("Password and confirm password doesn't match."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($address == ""){
				$this->Session->setFlash(__("Please enter address."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($city_id == 0){
				$this->Session->setFlash(__("Please select city."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			if($language_id == 0){
				$this->Session->setFlash(__("Please select language."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
			
			$saveData = array(
				'User'=>array(
					'name'=>$name,
					'email'=>$email,
					'password'=>md5($password),
					'phone_no'=>$phone_no,
					'address'=>$address,
					'city_id'=>$city_id,
					'language_id'=>$language_id,
				)
			);
			$this->User->create();
			if($this->User->save($saveData)){
				$user_id = $this->User->id;
				$user = array(
					'user_id'=>$user_id,
					'name'=>$name,
					'email'=>$email,
					'phone_no'=>$phone_no
				);
				$this->Session->write('user',$user);
				
				$this->Session->setFlash(__("Sign up successfully."));
				
				//update the cart item user data
				$isupdate = $this->updatecartitemwithuser();
				
				/* $service = $this->Session->read('service');
				$service_id = isset($service['service_id'])?$service['service_id']:0;
				$service_package_id = isset($service['service_package_id'])?$service['service_package_id']:0; */
				
				/* $service_id = isset($reqdata['service_id'])?$reqdata['service_id']:0;
				$service_package_id = isset($reqdata['service_package_id'])?$reqdata['service_package_id']:0;
				
				if($service_id == 0){
					$this->Session->setFlash(__('Please select a service.'));
					return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
				}else{
					if($service_package_id == 0){
						$this->Session->setFlash(__('Please select a package.'));
						return $this->redirect(array('controller'=>'Services','action'=>'bussiness_service/'.$service_id));
					}else{
						return $this->redirect(array('controller'=>'Services','action'=>'addToCart'));
					}
				} */
				if($registration == 1){
					return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
				}else{
					return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
				}
			}else{
				$this->Session->setFlash(__("Error occured while sign up."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'signUp'));
				}
			}
		}else{
			$this->layout = "main";
			
			$cities = $this->getCityList();
			$this->set(compact('cities'));
			
			$languages = $this->getLanguageList();
			$this->set(compact('languages'));
		}
	}
	
/**
 * login method
 *
 * @return void
 */
	public function logIn(){
		$this->layout = "main";
		$this->loggeduserredirect();
		
		if($this->request->is('post','put')){
			$reqdata = $this->request->data;
			//pr($reqdata);
			//die();
			$registration = isset($reqdata['registration'])?$reqdata['registration']:0;
			$email = isset($reqdata['email'])?$reqdata['email']:"";
			$password = isset($reqdata['password'])?$reqdata['password']:"";
			
			if($email == ""){
				$this->Session->setFlash(__("Please enter email."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'logIn'));
				}
			}
			else{
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$this->Session->setFlash(__("Please enter valid email."));
					if($registration == 1){
						return $this->redirect(array('action'=>'registration'));
					}else{
						return $this->redirect(array('action'=>'logIn'));
					}
				}
			}
			
			if($password == ""){
				$this->Session->setFlash(__("Please enter password."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'logIn'));
				}
			}
			
			$cond = array(
				'User.email'=>$email,
				'User.password'=>md5($password),
			);
			$option = array(
				'conditions'=>$cond,
			);
			$userData = $this->User->find('first',$option);
			// pr($userData);
			// die();
			
			if(is_array($userData) && count($userData)>0){
				$user_id = isset($userData['User']['id'])?$userData['User']['id']:0;
				$name = isset($userData['User']['name'])?$userData['User']['name']:"";
				$email = isset($userData['User']['email'])?$userData['User']['email']:"";
				$phone_no = isset($userData['User']['phone_no'])?$userData['User']['phone_no']:"";
				$user = array(
					'user_id'=>$user_id,
					'name'=>$name,
					'email'=>$email,
					'phone_no'=>$phone_no
				);
				$this->Session->write('user',$user);
				
				//update the cart item user data
				$isupdate = $this->updatecartitemwithuser();
				
				/* $service = $this->Session->read('service');
				$service_id = isset($service['service_id'])?$service['service_id']:0;
				$service_package_id = isset($service['service_package_id'])?$service['service_package_id']:0; */
				
				/* $service_id = isset($reqdata['service_id'])?$reqdata['service_id']:0;
				$service_package_id = isset($reqdata['service_package_id'])?$reqdata['service_package_id']:0;
				
				if($service_id == 0){
					//$this->Session->setFlash(__('Please select a service.'));
					return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
				}else{
					if($service_package_id == 0){
						$this->Session->setFlash(__('Please select a package.'));
						return $this->redirect(array('controller'=>'Services','action'=>'bussiness_service/'.$service_id));
					}else{
						//return $this->redirect(array('controller'=>'Services','action'=>'addToCart'));
						return $this->redirect(array('controller'=>'Services','action'=>'saveToCart/'.$service_id.'/'.$service_package_id));
					}
				} */
				if($registration == 1){
					return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
				}else{
					return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
				}
			}
			else{
				$this->Session->setFlash(__("Invalid Email Or Password."));
				if($registration == 1){
					return $this->redirect(array('action'=>'registration'));
				}else{
					return $this->redirect(array('action'=>'logIn'));
				}
			}
		}
	}
	
/**
 * facebookLogIn methohd
 *
 * @return void
 */
	public function facebookLogIn($registration=0){
		
		$client_id = $this->APP_ID;
		$client_secret = $this->APP_SECRET;
		
		$reqdata = $this->request->data;
		$code = isset($_REQUEST["code"])?$_REQUEST["code"]:null;
		$error_code = isset($_REQUEST["error_code"])?$_REQUEST["error_code"]:null;
		$state = md5(uniqid(rand(), TRUE)); // CSRF protection
		
		if(!empty($error_code) && $error_code==200){
			return $this->redirect(array('controller'=>'Users','action'=>'logIn'));
		}
		
		//$redirect_uri = "http://mindscale.co.in/demo/RupeeForadian/Users/facebookLogIn/$registration";
		
		$redirect_uri = FULL_BASE_URL.$this->base."/Users/facebookLogIn/".$registration;

		if(empty($code)){
			
			$oauth_url = "https://www.facebook.com/dialog/oauth?client_id=$client_id&redirect_uri=".urlencode($redirect_uri)."&state=$state&scope=publish_actions,public_profile,email";
			//die();
			print("<script>window.location='$oauth_url'</script>");
			exit();
		}else{
			$token_url = "https://graph.facebook.com/oauth/access_token?client_id=$client_id&redirect_uri=".urlencode($redirect_uri)."&client_secret=$client_secret&code=$code";
			
			$response = file_get_contents($token_url);
			$params = null;
			parse_str($response,$params);
			//pr($params);
			
			$access_token = $params['access_token'];
			
			if($access_token == ''){
				$this->Session->setFlash(__("Some error occured while log in with Facebook."));
				return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
			}
			
			$graph_url = "https://graph.facebook.com/me?access_token=".$access_token."&fields=first_name,last_name,name,id,email";
			$userDetails = json_decode(file_get_contents($graph_url));
			//pr($userDetails);
			// die();
			
			$fb_id = $userDetails->id;
			$fb_email = $userDetails->email;
			$fb_name = $userDetails->name;
			$fb_first_name = $userDetails->first_name;
			$fb_last_name = $userDetails->last_name;
			
			$graph_url2 = "https://graph.facebook.com/".$fb_id."/picture?access_token=".$access_token."&redirect=false&type=large";
			$userPicture = json_decode(file_get_contents($graph_url2));
			// pr($userPicture);
			// die();
			$fb_image = isset($userPicture->data->url)?$userPicture->data->url:'';
			
			//Check user exist or not
			$cond = array(
				'OR'=>array(
					'User.email'=>$fb_email,
					'User.fb_id'=>$fb_id
				)
			);
			$option = array(
				'conditions'=>$cond
			);
			$userData = $this->User->find('first',$option);
			if(isset($userData) && is_array($userData) && count($userData)>0){ //User exist
				$user_id = $userData['User']['id'];
				$name = $userData['User']['name'];
				$email = $userData['User']['email'];
				$fb_id = $userData['User']['fb_id'];
				$image = $userData['User']['fb_image'];
				$phone_no = $userData['User']['phone_no'];
				
				$this->User->id = $user_id;
				if($email == ''){
					$this->User->saveField('email',$fb_email);
					$email = $fb_email;
				}
				if($fb_id == ''){
					$this->User->saveField('fb_id',$fb_id);
				}
				if($fb_image != ''){
					$this->User->saveField('fb_image',$fb_image);
					$image = $fb_image;
				}
			}else{
				$saveData = array(
					'User'=>array(
						'name'=>$fb_name,
						'email'=>$fb_email,
						'fb_id'=>$fb_id,
					)
				);
				$this->User->create();
				$this->User->save($saveData);
				
				$user_id = $this->User->id;
				$name = $fb_name;
				$email = $fb_email;
				$phone_no='';
			}
			
			//Set session
			$user = array(
				'user_id'=>$user_id,
				'name'=>$name,
				'email'=>$email,
				'phone_no'=>$phone_no
			);
			
			$this->Session->write('user',$user);
			
			//update the cart item user data
			$isupdate = $this->updatecartitemwithuser();
			
			if($registration == 1){
				return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
			}else{
				return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
			}
		}
	}
	
/**
 * googlePlusLogIn method
 *
 * @return void
 */
	public function googlePlusLogIn($registration=0){
		$this->layout="main";
		
		$client_id = $this->CLIENT_ID;
		$client_secret = $this->CLIENT_SECRET;
		
		$code = isset($_REQUEST["code"])?$_REQUEST["code"]:null;
		$state = md5(uniqid(rand(), TRUE)); // CSRF protection
		//$state = 'rupeeforadian'; 
		
		//$redirect_uri = "http://mindscale.co.in/demo/RupeeForadian/Users/googlePlusLogIn/$registration";
		
		$redirect_uri = FULL_BASE_URL.$this->base."/Users/googlePlusLogIn/".$registration;
		$url = 'https://accounts.google.com/o/oauth2/';
		
		if(empty($code)){
			$oauth_url = $url."auth?response_type=code&client_id=".$client_id."&redirect_uri=".$redirect_uri."&scope=email%20profile&access_type=online&state=".$state;
			print("<script>window.location='$oauth_url'</script>");
			exit();
		}else{
			$token_url = $url.'token';
			$params = array(
			    "code" => $code,
			    "client_id" => $client_id,
			    "client_secret" => $client_secret,
			    "redirect_uri" => $redirect_uri,
			    "grant_type" => "authorization_code"
			);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$token_url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output 
			$result = curl_exec($ch);
			curl_close ($ch);
			
			$responseObj = json_decode($result);
			// pr($responseObj);
			
			$access_token = $responseObj->access_token;
			if($access_token == ''){
				$this->Session->setFlash(__("Some error occured while log in with Google+."));
				return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
			}
			
			$graph_url = "https://www.googleapis.com/oauth2/v1/userinfo?access_token=".$access_token;
			$userDetails = json_decode(file_get_contents($graph_url));
			// pr($userDetails);
			// die();
			
			$google_id = $userDetails->id;
			$google_email = $userDetails->email;
			$google_name = $userDetails->name;
			$google_first_name = $userDetails->given_name;
			$google_last_name = $userDetails->family_name;
			$google_picture = $userDetails->picture;
			
			//Check user exist or not
			$cond = array(
				'OR'=>array(
					'User.email'=>$google_email,
					'User.google_id'=>$google_id
				)
			);
			$option = array(
				'conditions'=>$cond
			);
			$userData = $this->User->find('first',$option);
			if(isset($userData) && is_array($userData) && count($userData)>0){ //User exist
				$user_id = $userData['User']['id'];
				$name = $userData['User']['name'];
				$email = $userData['User']['email'];
				$google_id = $userData['User']['google_id'];
				$image = $userData['User']['google_image'];
				$phone_no = $userData['User']['phone_no'];
				$this->User->id = $user_id;
				if($email == ''){
					$this->User->saveField('email',$google_email);
					$email = $google_email;
				}
				if($google_id == ''){
					$this->User->saveField('google_id',$google_id);
				}
				if($google_picture != ''){
					$this->User->saveField('google_image',$google_picture);
					$image = $google_picture;
				}
			}else{
				$saveData = array(
					'User'=>array(
						'name'=>$google_name,
						'email'=>$google_email,
						'google_id'=>$google_id,
						'google_image'=>$google_picture,
					)
				);
				$this->User->create();
				$this->User->save($saveData);
				
				$user_id = $this->User->id;
				$name = $google_name;
				$email = $google_email;
				$image = $google_picture;
				$phone_no='';
			}
			
			//Set session
			$user = array(
				'user_id'=>$user_id,
				'name'=>$name,
				'email'=>$email,
				'image'=>$image,
				'phone_no'=>$phone_no
			);
			$this->Session->write('user',$user);
			
			//update the cart item user data
			$isupdate = $this->updatecartitemwithuser();
				
			if($registration == 1){
				return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
			}else{
				return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
			}
		}
	}
	
/**
 * logout method
 *
 * @return void
 */
	public function logout(){
		$this->Session->destroy();
		$this->Session->setFlash(__("Logged out successfully."));
		return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
	}
	
/**
 * proceedToCheckout method
 *
 * @return void
 */
	public function proceedToCheckout(){
		
		if($this->request->is('post','put')){
			$reqdata = $this->request->data;
			// pr($reqdata);
			// die();
			$service_ids = isset($reqdata['service_ids'])?$reqdata['service_ids']:"";
			$service_package_ids = isset($reqdata['service_package_ids'])?$reqdata['service_package_ids']:"";
			
			$user = $this->Session->read('user');
			
			$user_id = isset($user['user_id'])?$user['user_id']:0;
			$user_name=isset($user['name'])?$user['name']:'';
			$user_email=isset($user['email'])?$user['email']:'';
			$user_phone = isset($user['phone_no'])?$user['phone_no']:'';
			
			$session_id = $this->Session->read('session_id');
			
			$this->loadModel('ServicePackage');
			$this->loadModel('UserService');
			$this->loadModel('UserServicePackage');
			$this->loadModel('UserCart');
			$this->loadModel('Transaction');
			
			$service_ids = explode(',',$service_ids);
			$service_package_ids = explode(',',$service_package_ids);
			$purchase_datetime = date('Y-m-d H:i:s');
			$purchasehaxcode = $this->generatepurchasehax($user_id);
			//create t transaction recored
			$total_service = count($service_ids);
			if($total_service>0){
				$transdata = array(
					'Transaction'=>array(
						'user_id'=>$user_id,
						'is_completed'=>'0',
						'total_service'=>$total_service
					)
				);
				$this->Transaction->create();
				if($this->Transaction->save($transdata)){
					$transaction_id = $this->Transaction->id;
					$totalpayingcost=0;
					for($i=0; $i<$total_service; $i++){
						$service_id = $service_ids[$i];
						$service_package_id = $service_package_ids[$i];
						
						$this->ServicePackage->unbindModel(array(
							'belongsTo'=>array('Service'),
						));
						$servicePackageData = $this->ServicePackage->findById($service_package_id);
						
						$package_name = isset($servicePackageData['ServicePackage']['package_name'])?$servicePackageData['ServicePackage']['package_name']:"";
						$description = isset($servicePackageData['ServicePackage']['description'])?$servicePackageData['ServicePackage']['description']:"";
						$amount = isset($servicePackageData['ServicePackage']['amount'])?$servicePackageData['ServicePackage']['amount']:0;
						$currency = isset($servicePackageData['ServicePackage']['currency'])?$servicePackageData['ServicePackage']['currency']:"";
						
						$totalpayingcost+=$amount;
						
						$saveServicePackage = array(
							'UserServicePackage'=>array(
								'user_id'=>$user_id,
								'service_id'=>$service_id,
								'service_package_id'=>$service_package_id,
								'transaction_id'=>$transaction_id,
								'package_name'=>$package_name,
								'description'=>$description,
								'amount'=>$amount,
								'currency'=>$currency,
								'purchase_datetime'=>$purchase_datetime,
							)
						);
						$this->UserServicePackage->create();
						$this->UserServicePackage->save($saveServicePackage);
					}
					//now update the transaction with the total paying cost amount
					$upcond= array('Transaction.id'=>$transaction_id,'Transaction.is_completed'=>'0');
					$updata = array('Transaction.total_service_cost'=>$totalpayingcost);
					$this->Transaction->updateAll($updata,$upcond);
					
					$postdata = array(
						'amount'=>$totalpayingcost,
						'trnsid'=>$transaction_id,
						'productinfo'=>'Service Enable payment',
						'firstname'=>$user_name,
						'email'=>$user_email,
						'phone'=>$user_phone
					);
					
					$this->Session->write('postdata',$postdata);
					
					return $this->redirect(array('action'=>'payupaymentsecondstep'));
					//$this->set('posted',$postdata);
				}
				else{
					$this->Session->setFlash(__("Please try again"));
					return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
				}
			}
			else{
				//
				$this->Session->setFlash(__("No item in the cart"));
				return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
			}
			
			/*for($i=0; $i<count($service_ids); $i++){
				$service_id = $service_ids[$i];
				$service_package_id = $service_package_ids[$i];
				
				$saveService = array(
					'UserService'=>array(
						'user_id'=>$user_id,
						'service_id'=>$service_id,
						'purchase_datetime'=>$purchase_datetime,
						'purchase_hax'=>$purchasehaxcode,
						'transactionid'=>'0'
					)
				);
				// pr($saveService);
				$this->UserService->create();
				$this->UserService->save($saveService);
				
				//move this portion after make payment
				
				$this->ServicePackage->unbindModel(array(
					'belongsTo'=>array('Service'),
				));
				$servicePackageData = $this->ServicePackage->findById($service_package_id);
				// pr($servicePackageData);
				// die();
				$package_name = isset($servicePackageData['ServicePackage']['package_name'])?$servicePackageData['ServicePackage']['package_name']:"";
				$description = isset($servicePackageData['ServicePackage']['description'])?$servicePackageData['ServicePackage']['description']:"";
				$amount = isset($servicePackageData['ServicePackage']['amount'])?$servicePackageData['ServicePackage']['amount']:0;
				$currency = isset($servicePackageData['ServicePackage']['currency'])?$servicePackageData['ServicePackage']['currency']:"";
				$saveServicePackage = array(
					'UserServicePackage'=>array(
						'user_id'=>$user_id,
						'service_package_id'=>$service_package_id,
						'package_name'=>$package_name,
						'description'=>$description,
						'amount'=>$amount,
						'currency'=>$currency,
						'purchase_datetime'=>$purchase_datetime,
					)
				);
				// pr($saveServicePackage);
				// die();
				$this->UserServicePackage->create();
				$this->UserServicePackage->save($saveServicePackage);
			}  */
			
			/*$updateCartData = array(
				'UserCart.is_active'=>'0',
				'UserCart.is_deleted'=>'1',
			);
			$updateCartCond = array(
				//'UserCart.user_id'=>$user_id,
				'OR'=>array(
					'UserCart.user_id'=>$user_id,
					'UserCart.session_id'=>$session_id,
				),
				'UserCart.is_active'=>'1',
				'UserCart.is_deleted'=>'0',
			);
			
			$this->UserCart->updateAll($updateCartData,$updateCartCond);
			
			$this->Session->setFlash(__("Services checked out successfully."));
			
			$this->numberOfItemInCart();*/
			
			
		}
		else{
			return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
		}
		//return $this->redirect(array('controller'=>'MainServices','action'=>'services'));
	}
	
	public function payupaymentsecondstep(){
		$this->layout="blank";
		
		$formError=0;
		$islive=false;
		if($islive){
			//foodlure data
			$MERCHANT_KEY = "hP998IyL";
			$SALT = "yyiuhOJdWv";
			$PAYU_BASE_URL = "https://secure.payu.in";
		}
		else{
			$MERCHANT_KEY = "Vw997n";
			$SALT = "4womTBoq";
			$PAYU_BASE_URL = "https://test.payu.in";
		}
		
		$surl=FULL_BASE_URL.$this->base."/Users/paymentsuccess";
		$furl=FULL_BASE_URL.$this->base."/Users/paymenterror";
		$action='';
		
		if($this->request->is('post')){
			$posteddata = $this->request->data;
			$transaction_id = isset($posteddata['udf1'])?$posteddata['udf1']:'';
			$amount = isset($posteddata['amount'])?$posteddata['amount']:'0';
			$email = isset($posteddata['email'])?$posteddata['email']:'';
			$phone = isset($posteddata['phone'])?$posteddata['phone']:'';
			$firstname = isset($posteddata['firstname'])?$posteddata['firstname']:'';
			$productinfo='Service Enable payment';
			$txnid = isset($posteddata['txnid'])?$posteddata['txnid']:'';
			$hash = isset($posteddata['hash'])?$posteddata['hash']:'';
			$hash='';
			//validate all mendatory fields
			/*if($firstname==''){
				
			}*/
			
			
			
			//now go to payu payment section
			$posted = array(
				'surl'=>$surl,
				'furl'=>$furl,
				'amount'=>$amount,
				'productinfo'=>$productinfo,
				'txnid'=>$txnid,
				'hash'=>$hash,
				'marchant_key'=>$MERCHANT_KEY,
				'salt'=>$SALT,
				'payu_base_url'=>$PAYU_BASE_URL,
				'service_provider'=>'payu_paisa',
				'phone'=>$phone,
				'email'=>$email,
				'firstname'=>$firstname,
				'key'=>$MERCHANT_KEY,
				'udf1'=>$transaction_id,
				'trnsid'=>$transaction_id
			);
			//pr($posted);
			
			$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
			if(empty($posted['hash']) && sizeof($posted) > 0) {
				if(
				  empty($posted['key'])
				  || empty($posted['txnid'])
				  || empty($posted['amount'])
				  || empty($posted['firstname'])
				  || empty($posted['email'])
				  || empty($posted['phone'])
				  || empty($posted['productinfo'])
				  || empty($posted['surl'])
				  || empty($posted['furl'])
				  || empty($posted['service_provider'])
				) {
					$formError = 1;
				}
				else{
					$hashVarsSeq = explode('|', $hashSequence);
					$hash_string = '';	
					foreach($hashVarsSeq as $hash_var) {
						$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
						$hash_string .= '|';
					}
				    
					$hash_string .= $SALT;
					$hash = strtolower(hash('sha512', $hash_string));
					$action = $PAYU_BASE_URL . '/_payment';
					$posted['hash']=$hash;
				}
			}
			elseif(!empty($posted['hash'])) {
			  $hash = $posted['hash'];
			  $action = $PAYU_BASE_URL . '/_payment';
			  $posted['hash']=$hash;
			}
			else{
				//error
				$formError=2;
			}
			//echo $action;
			//echo $formError;
			//die();
			$this->set('action',$action);
			$this->set('posted',$posted);
			$this->set('formError',$formError);
			$this->set('hash',$hash);
		}
		else{
			$postdata = $this->Session->read('postdata');
			$hash='';
			$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
			//now go to payu payment section
			$posted = array(
				'surl'=>$surl,
				'furl'=>$furl,
				'txnid'=>$txnid,
				'hash'=>$hash,
				'marchant_key'=>$MERCHANT_KEY,
				'salt'=>$SALT,
				'payu_base_url'=>$PAYU_BASE_URL,
				'service_provider'=>'payu_paisa',
				'key'=>$MERCHANT_KEY,
			);
			if(is_array($postdata) && count($postdata)>0){
				$postdata = array_merge($postdata,$posted);
			}
			else{
				return $this->redirect(array('controller'=>'UserCarts','action'=>'index'));
			}
			
			
			$posteddata = $postdata;
			$transaction_id = isset($posteddata['trnsid'])?$posteddata['trnsid']:'';
			$amount = isset($posteddata['amount'])?$posteddata['amount']:'0';
			$email = isset($posteddata['email'])?$posteddata['email']:'';
			$phone = isset($posteddata['phone'])?$posteddata['phone']:'';
			$firstname = isset($posteddata['firstname'])?$posteddata['firstname']:'';
			$productinfo='Service Enable payment';
			$txnid = isset($posteddata['txnid'])?$posteddata['txnid']:'';
			$hash = isset($posteddata['hash'])?$posteddata['hash']:'';
			$hash='';
			//validate all mendatory fields
			
			//now go to payu payment section
			$posted = array(
				'surl'=>$surl,
				'furl'=>$furl,
				'amount'=>$amount,
				'productinfo'=>$productinfo,
				'txnid'=>$txnid,
				'hash'=>$hash,
				'marchant_key'=>$MERCHANT_KEY,
				'salt'=>$SALT,
				'payu_base_url'=>$PAYU_BASE_URL,
				'service_provider'=>'payu_paisa',
				'phone'=>$phone,
				'email'=>$email,
				'firstname'=>$firstname,
				'key'=>$MERCHANT_KEY,
				'udf1'=>$transaction_id,
				'trnsid'=>$transaction_id
			);
			//pr($posted);
			
			$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
			if(empty($posted['hash']) && sizeof($posted) > 0) {
				if(
				  empty($posted['key'])
				  || empty($posted['txnid'])
				  || empty($posted['amount'])
				  || empty($posted['firstname'])
				  || empty($posted['email'])
				  || empty($posted['phone'])
				  || empty($posted['productinfo'])
				  || empty($posted['surl'])
				  || empty($posted['furl'])
				  || empty($posted['service_provider'])
				) {
					$formError = 1;
				}
				else{
					$hashVarsSeq = explode('|', $hashSequence);
					$hash_string = '';	
					foreach($hashVarsSeq as $hash_var) {
						$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
						$hash_string .= '|';
					}
				    
					$hash_string .= $SALT;
					$hash = strtolower(hash('sha512', $hash_string));
					$action = $PAYU_BASE_URL . '/_payment';
					$posted['hash']=$hash;
				}
			}
			elseif(!empty($posted['hash'])) {
			  $hash = $posted['hash'];
			  $action = $PAYU_BASE_URL . '/_payment';
			  $posted['hash']=$hash;
			}
			else{
				//error
				$formError=2;
			}
			
			//pr($postdata);
			$this->set('action',$action);
			$this->set('posted',$posted);
			$this->set('formError',$formError);
			$this->set('hash',$hash);
		}
	}
	
	public function paymentsuccess(){
		if($this->request->is('post')){
			$payureturnsdata = $this->request->data;
		}
		else{
			$payureturnsdata=isset($_POST)?$_POST:array();
		}
		//main sections
		$succees=false;
		$transid='';
		if(is_array($payureturnsdata) && count($payureturnsdata)>0){
			$status = isset($payureturnsdata['status'])?$payureturnsdata['status']:'';
			if($status=="success"){
				$transaction_id = isset($payureturnsdata['udf1'])?$payureturnsdata['udf1']:'0';
				$paying_amount = isset($payureturnsdata['amount'])?$payureturnsdata['amount']:'0';
				$transid = $payureturnsdata['mihpayid'];
				if($transaction_id>0){
					$this->loadModel('Transaction');
					$finscond = array('Transaction.id'=>$transaction_id,'Transaction.is_completed'=>'0');
					$transaction = $this->Transaction->find('first',array('recursive'=>'1','conditions'=>$finscond));
					if(is_array($transaction) && count($transaction)>0){
						$amount = $transaction['Transaction']['total_service_cost'];
						if($amount==$paying_amount){
							//now update the table
							$updata = array('Transaction.is_completed'=>'1');
							$this->Transaction->updateAll($updata,$finscond);
							$succees=true;
							$this->Session->write('cartItemNo','0');
						}
					}
					else{
						//recored not found
					}
				}
			}
			else{
					
			}
			
		}
		/*$this->set('transid',$transid);
		$this->set('success',$succees);*/
		
		return $this->redirect(array('controller'=>'users','action'=>'index'));
		
	}
	
	public function paymenterror(){
		
		if($this->request->is('post')){
			$payureturnsdata = $this->request->data;
		}
		else{
			echo "norm post";
			$payureturnsdata=isset($_POST)?$_POST:array();
		}
		//pr($payureturnsdata);
		//die();
	}
}
