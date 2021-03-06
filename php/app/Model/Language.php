<?php
App::uses('AppModel', 'Model');
/**
 * Language Model
 *
 * @property User $User
 */
class Language extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'language';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'language_id',
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
