<?php
App::uses('AppController', 'Controller');
/**
 * ServiceProgresSteps Controller
 *
 * @property ServiceProgresStep $ServiceProgresSteps
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ServiceProgresStepsController extends AppController {

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
		$this->ServiceProgresStep->recursive = 0;
		$this->set('serviceProgresSteps', $this->Paginator->paginate());
	}
	
/**
 * admin_add method
 * @param string $service_id
 */
	public function admin_add($service_id=0){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		$this->loadModel('Service');
		$this->loadModel('ProgressStep');
		if($this->request->is('post')){
			$posteddata=isset($this->request->data['ServiceProgresStep'])?$this->request->data['ServiceProgresStep']:array();
			//pr($posteddata);
			//die();
			
			if(!is_array($posteddata) || count($posteddata)==0){
				return $this->redirect(array('action'=>'add',$service_id));
			}
			$service_id=isset($posteddata['service_id'])?$posteddata['service_id']:$service_id;
			$progress_step_ids=isset($posteddata['progress_step_id'])?$posteddata['progress_step_id']:array();
			if($service_id>0){
				if(is_array($progress_step_ids) && count($progress_step_ids)>0){
					//deleted all the prev
					$this->ServiceProgresStep->deleteAll(array('ServiceProgresStep.service_id'=>$service_id));
					
					foreach($progress_step_ids as $progress_step_id){
						$steporder = isset($posteddata[$progress_step_id])?$posteddata[$progress_step_id]:'0';
						//
						$savedata = array(
							'ServiceProgresStep'=>array(
								'service_id'=>$service_id,
								'progress_step_id'=>$progress_step_id,
								'step_order'=>$steporder
							)
						);
						$this->ServiceProgresStep->create();
						$this->ServiceProgresStep->save($savedata);
						//pr($savedata);
					}
					$this->Session->setFlash(__('Successfully saved the data'),'default',array('class'=>'success'));
					$this->redirect(array('controller'=>'Services','action'=>'index'));
				}
				else{
					
				}
			}
			else{
				$this->Session->setFlash(__('Please provide all valied data'));
			}
			//return $this->redirect(array('action'=>'add',$service_id));
		}
		
		$opt = array(
			//'Service.is_blocked'=>'0',
			'Service.is_deleted'=>'0'
		);
		if($service_id>0){
			$opt['Service.id']=$service_id;
		}
		$services = $this->Service->find('list',array('conditions'=>$opt));
		//pr($services);
		$pstep = array(
			'ProgressStep.is_deleted'=>'0'
		);
		$progressSteps=$this->ProgressStep->find('list',array('conditions'=>$pstep));
		$this->set(compact(array('services','progressSteps')));
		$this->set('serviceId',$service_id);
	}
}
