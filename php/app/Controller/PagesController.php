<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
	
	public function contactus(){
		$this->layout="main";
	}
	public function aboutus(){
		$this->layout="main";
	}
	public function career(){
		$this->layout="main";
	}
	public function newsroom(){
		$this->layout="main";
	}
	public function legaltermscondition(){
		$this->layout="main";
	}
	
	public function findcity($shoert_name=''){
		$this->layout="main";
		$this->loadModel('City');
		$findcond = array(
			'City.is_blocked'=>'0',
			'City.is_deleted'=>'0'
		);
		if($shoert_name!=''){
			$findcond['City.state_name']=$shoert_name;
		}
		//get the gerion code
		$this->City->displayField='region';
		$city = $this->City->find('list',array('conditions'=>$findcond));
		$region='0';
		if(is_array($city) && count($city)>0){
			$regions = array_values($city);
			
			$region = $regions['0'];
		}
		if($region>0 && isset($findcond['City.state_name'])){
			unset($findcond['City.state_name']);
			$findcond['City.region']=$region;
		}
		$order = array('City.city_name'=>'ASC');
		$groupby = array('City.state_name');
		//unbind model
		$this->City->unbindModel(array(
			'hasMany'=>array('User')
		));
		$fields = array(
			'group_concat(City.city_name) AS city_name',
			'group_concat(City.lati)'
		);
		$cities = $this->City->find('all',array('recursive'=>'0',
							'conditions'=>$findcond,
							'order'=>$order));
		$satatename = "";
		if(is_array($cities) && count($cities)>0 && $shoert_name!=''){
			$satatename = $cities[0]['City']['long_state_name'];
			$regionnames = $this->cityregion();
			$satatename = isset($regionnames[$region])?$regionnames[$region]:$satatename;
		}
		
		//pr($cities);
		
		$this->set('cities',$cities);
		$this->set('satatename',$satatename);
		$this->set('short_name',$shoert_name);
		
		$this->set('google_api_key',$this->google_mape_user_api_key);
		$this->set('basepath',$this->sitebasepath());
		
	}
	public function cfo(){
		$this->layout="main";
	}
	public function mobileapp(){
		$this->layout="main";
	}
	public function safty(){
		$this->layout="main";
	}
	public function businesspartner(){
		$this->layout="main";
	}
	public function ourservices(){
		$this->layout="main";
		$mainServices=array();
		$this->loadModel('MainService');
		$this->MainService->recursive = 2;
		//bind the other models
		$this->MainService->bindModel(array(
			'hasMany'=>array(
				'SubService'=>array(
					'className'=>'SubService',
					'foreingKey'=>'main_service_id',
					'conditions'=>array('SubService.is_blocked'=>'0','SubService.is_deleted'=>'0')
				)
			)
		));
		$this->MainService->SubService->bindModel(array(
			'hasMany'=>array(
				'Service'=>array(
					'className'=>'Service',
					'foreingKey'=>'sub_service_id',
					'conditions'=>array('Service.is_blocked'=>'0','Service.is_deleted'=>'0')
				)
			)
		));
		$findcond = array(
				'MainService.is_blocked'=>'0',
				'MainService.is_deleted'=>'0'
			);
		$mainServices = $this->MainService->find('all',array('conditions'=>$findcond));
		//$this->set('mainServices', $this->Paginator->paginate());
		$this->set('mainServices',$mainServices);
	}
}
