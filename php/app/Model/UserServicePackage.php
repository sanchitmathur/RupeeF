<?php
App::uses('AppModel', 'Model');
/**
 * UserServicePackage Model
 *
 * @property User $User
 * @property ServicePackage $ServicePackage
 */
class UserServicePackage extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ServicePackage' => array(
			'className' => 'ServicePackage',
			'foreignKey' => 'service_package_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
