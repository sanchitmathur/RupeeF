<?php
App::uses('AppModel', 'Model');
/**
 * ServiceAdvantage Model
 *
 * @property Service $Service
 */
class ServiceAdvantage extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'advantage_heading';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Service' => array(
			'className' => 'Service',
			'foreignKey' => 'service_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
