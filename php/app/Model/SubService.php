<?php
App::uses('AppModel', 'Model');
/**
 * SubService Model
 *
 * @property MainService $MainService
 * @property Service $Service
 */
class SubService extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'service_name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MainService' => array(
			'className' => 'MainService',
			'foreignKey' => 'main_service_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Service' => array(
			'className' => 'Service',
			'foreignKey' => 'sub_service_id',
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
