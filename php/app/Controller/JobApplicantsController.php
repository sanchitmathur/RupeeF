<?php
App::uses('AppController', 'Controller');
/**
 * JobApplicants Controller
 *
 * @property JobApplicant $JobApplicant
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class JobApplicantsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Thumb');

/**
 * admin_index method
 * 
 */
	public function admin_index(){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		$this->JobApplicant->recursive=0;
		$this->Paginator->settings=array(
			'conditions'=>array(
				'JobApplicant.is_deleted'=>'0',
				'Career.id >'=>'0',
				'Career.is_deleted'=>'0'
			)
		);
		$this->set('careers', $this->Paginator->paginate());
		$this->set('jobtypes',$this->careerjobtypes());
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
		if (!$this->JobApplicant->exists($id)) {
			throw new NotFoundException(__('Invalid JobApplicant'));
		}
		$options = array('conditions' => array('JobApplicant.' . $this->JobApplicant->primaryKey => $id));
		$this->set('jobApplicant', $this->JobApplicant->find('first', $options));
	}
	
	
/**
 * admin_add
 * 
 */
	public function admin_add(){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		if($this->request->is('post')){
			//pr($this->request->data);
			//all fields mentatory
			$message="";
			if(isset($this->request->data['JobApplicant'])){
				foreach($this->request->data['JobApplicant'] as $key=>$val){
					if($val==''){
						switch($key){
							case "job_type":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please choose job type.";
								break;
							case "job_title":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide a job title.";
								break;
							case "job_role":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide a job role.";
								break;
							case "monthly_salary":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide monthly salary.";
								break;
							case "city":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide the job city.";
								break;
							case "job_description":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide job description.";
								break;
							case "vacancy":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide the number of vacancy.";
								break;
							default:
								break;
						}
					}
				}
			}
			//
			if($message==''){
				//valied go ahead
				$this->JobApplicant->create();
				$this->request->data['JobApplicant']['create_date']=date("Y-m-d H:i:s");
				if($this->JobApplicant->save($this->request->data)){
					$this->Session->setFlash(__('JobApplicant has been save successfully'),'default',array('class'=>'success'));
				}
				else{
					$this->Session->setFlash(__('JobApplicant could not saved'));
				}
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__($message));
		}
		$jobTypes = $this->careerjobtypes();
		$this->set(compact('jobTypes'));
	}

/**
 * admin_edit method
 * @param string $id
 * 
 */
	public function admin_edit($id=null){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		$this->JobApplicant->id=$id;
		if (!$this->JobApplicant->exists($id)) {
			throw new NotFoundException(__('Invalid JobApplicant'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			$message="";
			if(isset($this->request->data['JobApplicant'])){
				foreach($this->request->data['JobApplicant'] as $key=>$val){
					
					if($val==''){
						switch($key){
							case "job_type":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please choose job type.";
								break;
							case "job_title":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide a job title.";
								break;
							case "job_role":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide a job role.";
								break;
							case "monthly_salary":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide monthly salary.";
								break;
							case "city":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide the job city.";
								break;
							case "job_description":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide job description.";
								break;
							case "vacancy":
								if($message!=""){
									$message.="</br>";
								}
								$message.="Please provide the number of vacancy.";
								break;
							default:
								break;
						}
					}
				}
			}
			
			if($message==''){
				//valied go ahead
				$this->JobApplicant->create();
				
				if($this->JobApplicant->save($this->request->data)){
					$this->Session->setFlash(__('JobApplicant has been save successfully'),'default',array('class'=>'success'));
				}
				else{
					$this->Session->setFlash(__('JobApplicant could not be saved'));
				}
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__($message));
			
			/*if ($this->JobApplicant->save($this->request->data)) {
				$this->Session->setFlash(__('The user cart has been saved.'),'default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user cart could not be saved. Please, try again.'));
			}*/
			
		} else {
			$options = array('conditions' => array('JobApplicant.' . $this->JobApplicant->primaryKey => $id));
			$this->request->data = $this->JobApplicant->find('first', $options);
		}
		$jobTypes = $this->careerjobtypes();
		$this->set(compact('jobTypes'));
	}
	
/**
 * admin_blockunblock method
 * @param string $id
 * @param string $bockunblock
 */
	public function admin_blockunblock($id=null, $bockunblock=0){
		$this->layout="admindefault";
		$this->adminsessionchecked();
		$this->JobApplicant->id=$id;
		if (!$this->JobApplicant->exists($id)) {
			throw new NotFoundException(__('Invalid JobApplicant'));
		}
		
		$this->JobApplicant->saveField('is_blocked',$bockunblock);
		if($bockunblock){
			$message="The JobApplicant has been blocked.";	
		}
		else{
			$message="The JobApplicant has been un blocked.";
		}
		$this->Session->setFlash(__($message),'default',array('class'=>'success'));
		return $this->redirect(array('action'=>'index'));
	}
	
/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->JobApplicant->id = $id;
		if (!$this->JobApplicant->exists()) {
			throw new NotFoundException(__('Invalid JobApplicant'));
		}
		$this->request->allowMethod('post', 'delete');
		/*if ($this->UserCart->delete()) {
			$this->Session->setFlash(__('The user cart has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user cart could not be deleted. Please, try again.'));
		}*/
		$this->JobApplicant->saveField('is_deleted','1');
		
		$this->Session->setFlash(__('The JobApplicant has been deleted'),'default',array('class'=>'success'));
		return $this->redirect(array('action' => 'index'));
	}
 
}
