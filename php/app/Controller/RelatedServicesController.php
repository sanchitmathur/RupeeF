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
		$this->layout="admindefault";
		$this->adminsessionchecked();
		$this->loadModel('Service');
		//$this->RelatedService->recursive = 0;
		//bind model
		/*$this->Service->bindmodel(array(
			'hasMany'=>array(
				'RelatedService'=>array(
					'className'=>'RelatedService',
					'foreingKey'=>'service_id'
				)
			)
		));
		
		$this->Service->RelatedService->bindModel(array(
			'belongsTo'=>array(
				'OtherService'=>array(
					'className'=>'Service',
					'foreingKey'=>'other_service_id'
				)
			)
		));
		//unbind section
		$this->Service->unbindModel(array(
			'belongsTo'=>array('SubService'),
			'hasMany'=>array('ServiceAdvantage','ServiceFaq','ServicePackage','ServiceDocument')
		));*/
		/*$this->RelatedService->bindModel(array(
			'belongsTo'=>array(
				'OtherService'=>array(
					'className'=>'Service',
					'foreingKey'=>'other_service_id'
				)
			)
		));*/
		
		$service_id=0;
		if($this->request->is('post')){
			$service_id=$this->request->data['Service']['service_id'];
		}
		//conditions
		$cond=array();
		$groupby=array('RelatedService.service_id');
		
		if($service_id>0){
			$cond=array('RelatedService.service_id'=>$service_id);
			$groupby=array();
		}
		
		$this->set('relatedServices', $this->Paginator->paginate());
		
		$condition = array('Service.is_deleted'=>'0');
		$services = $this->Service->find('list',array('recursive'=>'1','conditions'=>$condition));
		$services['0']="Select Service";
		ksort($services);
		//pr($services);
		
		$this->set(compact('services'));
		$this->set('serviceId',$service_id);
		
	}
	
/**
 * admin_add method
 * @param string $service_id
 */
	public function admin_add($service_id=0){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		$this->loadModel('Service');
		if($this->request->is('post')){
			$posteddata=$this->request->data;
			//pr($posteddata);
			//validate
			
			$service_id=isset($posteddata['RelatedService']['service_id'])?$posteddata['RelatedService']['service_id']:'0';
			$other_service_ids=isset($posteddata['RelatedService']['other_service_id'])?$posteddata['RelatedService']['other_service_id']:array();
			if($service_id==0){
				$this->Session->setFlash(__('Please choose One Service'));
			}
			else{
				if(!is_array($other_service_ids) || count($other_service_ids)==0){
					$this->Session->setFlash(__('Please choose Related Services'));
				}
				else{
					//deletd all prev data
					$this->RelatedService->deleteAll(array('RelatedService.service_id'=>$service_id));
					//saved the data
					foreach($other_service_ids as $other_service_id){
						if($other_service_id!=$service_id){
							$savedata = array(
								'RelatedService'=>array(
									'service_id'=>$service_id,
									'other_service_id'=>$other_service_id
								)
							);
							$this->RelatedService->create();
							if($this->RelatedService->save($savedata)){
								//saved successfully
							}
						}
						else{
							//same id not allowed
						}
					}
					//return to the list sections
					$this->Session->setFlash(__('Related Services added'),'default',array('class'=>'success'));
					return $this->redirect(array('action'=>'index','admin'=>true));
				}
			}
		}
		//
		$condition = array('Service.is_deleted'=>'0');
		$cond2=array('Service.is_deleted'=>'0');
		if($service_id>0){
			$condition['Service.id']=$service_id;
			//$cond2['Service.id !=']=$service_id;
		}
		
		$services = $this->Service->find('list',array('recursive'=>'1','conditions'=>$condition));
		
		if(count($services)>1){
			$services['0']="Select Service";
			ksort($services);
		}
		//get preve saved services
		$prevsavedserviceids=array();
		if($service_id>0){
			$con = array('RelatedService.service_id'=>$service_id);
			$this->RelatedService->displayField="other_service_id";
			$prevsavedserviceids = $this->RelatedService->find('list',array('conditions'=>$con));
			if(count($prevsavedserviceids)>0){
				$prevsavedserviceids = array_values($prevsavedserviceids);
			}
		}
		//other releted services
		if($service_id>0){
			array_push($prevsavedserviceids,$service_id);
		}
		if(is_array($prevsavedserviceids) && count($prevsavedserviceids)>0){
			$cond2['Service.id !=']=$prevsavedserviceids;
		}
		
		$otherServices = $this->Service->find('list',array('recursive'=>'1','conditions'=>$cond2));
		$this->set(compact(array('services','otherServices')));
		$this->set('prevsavedserviceids',$prevsavedserviceids);
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
		$this->RelatedService->id = $id;
		if (!$this->RelatedService->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RelatedService->delete()) {
			$this->Session->setFlash(__('The Related Service has been deleted.'),'default',array('class'=>'success'));
		} else {
			$this->Session->setFlash(__('The Related Service could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


}
