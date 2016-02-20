<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
/**
 * getCityList method
 *
 * @return array
 */
	public function getCityList(){
		$this->loadModel('City');
		$cities = array();
		
		$cond = array(
			'City.is_blocked'=>'0',
			'City.is_deleted'=>'0',
		);
		
		$option = array(
			'conditions'=>$cond
		);
		
		$cities = $this->City->find('list',$option);
		
		return $cities;
	}
	
/**
 * getLanguageList method
 *
 * @return array
 */
	public function getLanguageList(){
		$this->loadModel('Language');
		$languages = array();
		
		$cond = array(
			'Language.is_blocked'=>'0',
			'Language.is_deleted'=>'0',
		);
		
		$option = array(
			'conditions'=>$cond
		);
		
		$languages = $this->Language->find('list',$option);
		
		return $languages;
	}
	
/**
 * numberOfItemInCart method
 *
 * @return int
 */
	public function numberOfItemInCart(){
		$this->loadModel('UserCart');
		
		$user = $this->Session->read('user');
		$user_id = isset($user['user_id'])?$user['user_id']:0;
		
		$cond = array(
			'UserCart.user_id'=>$user_id,
			'UserCart.is_active'=>1,
			'UserCart.is_deleted'=>0,
		);
		$option = array(
			'conditions'=>$cond
		);
		$cartItemNo = $this->UserCart->find('count',$option);
		//$this->set('cartItemNo',$cartItemNo);
		//return $cartItemNo;
		$this->Session->write('cartItemNo',$cartItemNo);
	}
	
/**
 * getServiceTax method
 *
 * @return void
 */
	public function getServiceTax(){
		$this->loadModel('ServiceTax');
		
		$cond = array(
			'ServiceTax.is_active'=>1,
			'ServiceTax.is_deleted'=>0
		);
		$option = array(
			'conditions'=>$cond
		);
		$serviceTax = $this->ServiceTax->find('first',$option);
		return $serviceTax;
	}
	
}
