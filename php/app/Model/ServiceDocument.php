<?php
App::uses('AppModel', 'Model');
/**
 * ServiceDocument Model
 *
 */
class ServiceDocument extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'service_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
/**
 * belongsTo association
 * @var array
 */
    public $belongsTo=array(
        'DocumentType'=>array(
            'className'=>'DocumentType',
            'foreingKey'=>'document_type_id'
        ),
        'Service'=>array(
            'className'=>'Service',
            'foreingKey'=>'service_id'
        )
    );

}
