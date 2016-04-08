<?php
App::uses('AppModel', 'Model');
/**
 * ServiceProgresStep Model
 *
 * @property Service $Service
 */
class ServiceProgresStep extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = '';


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
                'dependent' => false,
                'conditions' => '',
                'fields' => ''
            )
	);

}
