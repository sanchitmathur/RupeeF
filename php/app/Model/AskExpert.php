<?php
App::uses('AppModel', 'Model');
/**
 * AskExpert Model
 *
 */
class AskExpert extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'question';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
/**
 * belongsTo associations
 * @var array
 */
    public $belongsTo=array(
        'AskExpertCategory' => array(
                'className' => 'AskExpertCategory',
                'foreignKey' => 'ask_expert_category_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
        )
        
    );
        
}
