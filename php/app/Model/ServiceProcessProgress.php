<?php
App::uses('AppModel', 'Model');
/**
 * ServiceProcessProgress Model
 *
 */
class ServiceProcessProgress extends AppModel {

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
            'UserServicePackage' => array(
                'className' => 'UserServicePackage',
                'foreignKey' => 'user_service_package_id',
                'dependent' => false,
                'conditions' => '',
                'fields' => ''
            )
	);

}
