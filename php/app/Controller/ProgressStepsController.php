<?php
App::uses('AppController', 'Controller');
/**
 * ProgressSteps Controller
 *
 * @property ProgressStep $ProgressStep
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProgressStepsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Thumb');
	
//ADMIN SECTIONS

/**
 * admin_index method
 */
	public function admin_index(){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		$this->ProgressStep->recursive=0;
		$this->Paginator->settings=array(
			'conditions'=>array(
				'ProgressStep.is_deleted'=>'0'
			)
		);
		$this->set('progressSteps',$this->Paginator->paginate());
	}
	
/**
 * admin_add method
 * 
 */
	public function admin_add(){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		if($this->request->is('post')){
			//pr($this->request->data);
			$posteddata = isset($this->request->data['ProgressStep'])?$this->request->data['ProgressStep']:array();
			if(is_array($posteddata) && count($posteddata)>0){
				//validate section
				$name = isset($posteddata['name'])?$posteddata['name']:'';
				if($name!=''){
					//data base validate
					$findlogic = array(
						'LOWER(ProgressStep.name)'=>strtolower($name),
						'ProgressStep.is_deleted'=>'0'
					);
					$is_present = $this->ProgressStep->find('count',array('conditions'=>$findlogic));
					if($is_present==0){
						if($this->ProgressStep->save($this->request->data)){
							$this->Session->setFlash(__('The progress step has been saved.'),'default',array('class'=>'success'));
							return $this->redirect(array('action'=>'add'));
						}
						else{
							$this->Session->setFlash(__('The progress step could not be saved. Please, try again.'));
						}
					}
					else{
						$this->Session->setFlash(__('This name already presents, Please try with another one'));
					}
				}
				else{
					$this->Session->setFlash(__('Please provide the step name'));
				}
			}
			else{
				$this->Session->setFlash(__('Data formate not proper'));
			}
			
		}
	}
	
/**
 * admin_edit method
 * @param string $id
 * 
 */
	public function admin_edit($id=null){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		if (!$this->ProgressStep->exists($id)) {
			throw new NotFoundException(__('Invalid Progress Step'));
		}
		if($this->request->is(array('put','post'))){
			//pr($this->request->data);
			$posteddata = isset($this->request->data['ProgressStep'])?$this->request->data['ProgressStep']:array();
			if(is_array($posteddata) && count($posteddata)>0){
				//validate section
				$name = isset($posteddata['name'])?$posteddata['name']:'';
				if($name!=''){
					//data base validate
					$findlogic = array(
						'LOWER(ProgressStep.name)'=>strtolower($name),
						'ProgressStep.is_deleted'=>'0'
					);
					$is_present = $this->ProgressStep->find('count',array('conditions'=>$findlogic));
					if($is_present==0){
						if($this->ProgressStep->save($this->request->data)){
							$this->Session->setFlash(__('The progress step has been saved.'),'default',array('class'=>'success'));
						}
						else{
							$this->Session->setFlash(__('The progress step could not be saved. Please, try again.'));
						}
					}
					else{
						$this->Session->setFlash(__('This name already presents, Please try with another one'));
					}
				}
				else{
					$this->Session->setFlash(__('Please provide the step name'));
				}
			}
			else{
				$this->Session->setFlash(__('Data formate not proper'));
			}
			return $this->redirect(array('action'=>'index'));
		}
		else{
			$cond = array('ProgressStep.'.$this->ProgressStep->primaryKey=>$id);
			$this->request->data = $this->ProgressStep->find('first',array('conditions'=>$cond));
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
		$this->ProgressStep->id = $id;
		if (!$this->ProgressStep->exists()) {
			throw new NotFoundException(__('Invalid Progress Step'));
		}
		$this->request->allowMethod('post', 'delete');
		//now update that table
		$this->ProgressStep->saveField('is_deleted','1');
		$this->Session->setFlash(__('The Progress Step has been deleted.'),'default',array('class'=>'success'));
		
		/*if ($this->ProgressStep->delete()) {
			$this->Session->setFlash(__('The Progress Step has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Progress Step could not be deleted. Please, try again.'));
		}*/
		
		return $this->redirect(array('action' => 'index'));
	}
	
}
