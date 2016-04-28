<?php
App::uses('AppModel', 'Model');
/**
 * AskExpertCategory Model
 *
 */
class AskExpertCategory extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'category_name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
/**
 * hasMany associations
 * @var array
 */
    public $hasMany=array(
        'AskExpert' => array(
                'className' => 'AskExpert',
                'foreignKey' => 'ask_expert_category_id',
                'conditions' => array('AskExpert.is_blocked'=>'0','AskExpert.is_deleted'=>'0'),
                'fields' => '',
                'order' => ''
        )
    );
        
}
