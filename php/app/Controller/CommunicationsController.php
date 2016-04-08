<?php
App::uses('AppController', 'Controller');
/**
 * Communications Controller
 *
 * @property Communication $Communication
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
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->layout="admindefault";
		$user_id=0;
		$this->Communication->recursive = 0;
		$cons=array(
			'Communication.is_deleted'=>'0',
			'Communication.reciever_id >'=>'0'
		);
		if($this->request->is('post')){
			$user_id=$this->request->data['User']['user_id'];
			if($user_id>0){
				$cons['Communication.reciever_id']=$user_id;
			}
		}
		$this->Paginator->settings=$cons;
		$this->set('communications', $this->Paginator->paginate());
		
		//get the communicate all users
		$usercondcomm=array(
			'Communication.is_deleted'=>'0',
			'Communication.reciever_id >'=>'0'
		);
		$this->Communication->displayField='reciever_id';
		$communicateusers = $this->Communication->find('list',array('conditions'=>$usercondcomm));
		$users=array();
		if(count($communicateusers)>0){
			$usercond=array(
				'User.id'=>array_values($communicateusers)
			);
			$users = $this->Communication->User->find('list',array('conditions'=>$usercond));
		}
		$users['0']="Select user";
		$this->set(compact('users'));
		$this->set('userId',$user_id);
	}
	
/**
 * admin_add method
 * @param string $user_id
 */
	public function admin_add($user_id=0){
		$this->layout="admindefault";
		if($this->request->is('post')){
			$posteddata = $this->request->data;
			//pr($posteddata);
			
			$user_id = isset($posteddata['Communication']['user_id'])?$posteddata['Communication']['user_id']:$user_id;
			$maeeage = isset($posteddata['Communication']['message'])?$posteddata['Communication']['message']:'';
			
			if($user_id==0){
				$this->Session->setFlash(__('Please choose a user for communication'));
			}
			else{
				if($maeeage==''){
					$this->Session->setFlash(__('Please enter your message'));
				}
				else{
					//now saved the data
					$savedata = array(
						'Communication'=>array(
							'user_id'=>'0',
							'reciever_id'=>$user_id,
							'admin_user_id'=>'0',
							'is_user_post'=>'0',
							'create_date'=>date("Y-m-d G:i:s"),
							'message'=>$maeeage
						)
					);
					$this->Communication->create();
					if($this->Communication->save($savedata)){
						$this->Session->setFlash(__('Your communication massage saved'),'default',array('class'=>'success'));
						return $this->redirect(array('action'=>'index'));
					}
					else{
						$this->Session->setFlash(__('Communication message saved error'));
					}
				}
			}
		}
		else{
			if($user_id==0){
				$this->Session->setFlash(__('Please choose a user for communication'));
				return $this->redirect(array('action'=>'index'));
			}
			else{
				$usercond=array(
					'User.id'=>$user_id
				);
				$users = $this->Communication->User->find('list',array('conditions'=>$usercond));
				$this->set(compact('users'));
			}
			
		}
	}
	
}
