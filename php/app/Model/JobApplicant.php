<?php
App::uses('AppModel', 'Model');
/**
 * JobApplicant Model
 *
 */
class JobApplicant extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * belongsTo association
 */
    public $belongsTo = array(
        'Career'=>array(
            'className'=>'Career',
            'foreingKey'=>'career_id',
            'conditions'=>''
        )
    );

}
