<?php
App::uses('AppModel', 'Model');
/**
 * UserDocument Model
 *
 */
class UserDocument extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'doc_name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
/**
 * belongsTo associations
 * @var array
 */
    public $belongsTo=array(
        'DocumentType' => array(
                'className' => 'DocumentType',
                'foreignKey' => 'document_type_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
        ),
        'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
        ),
        
    );
        
}
