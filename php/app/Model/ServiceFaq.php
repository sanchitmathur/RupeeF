<?php
App::uses('AppModel', 'Model');
/**
 * ServiceFaq Model
 *
 * @property Service $Service
 */
class ServiceFaq extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'question';


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
