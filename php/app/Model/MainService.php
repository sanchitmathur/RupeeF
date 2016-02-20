<?php
App::uses('AppModel', 'Model');
/**
 * MainService Model
 *
 * @property SubService $SubService
 */
class MainService extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'service_name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'SubService' => array(
			'className' => 'SubService',
			'foreignKey' => 'main_service_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
