<?php
App::uses('AppModel', 'Model');
/**
 * RelatedService Model
 *
 * @property Service $Service
 */
class RelatedService extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'service_id';


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
			'fields' => '',
		),
                'OtherService'=>array(
                        'className'=>'Service',
                        'foreingKey'=>'other_service_id'
                )
	);
}
