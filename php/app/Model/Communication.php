<?php
App::uses('AppModel', 'Model');
/**
 * Communication Model
 *
 * @property User $User
 */
class Communication extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'message';


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
                'dependent' => false,
                'conditions' => '',
                'fields' => ''
            )
	);

}
