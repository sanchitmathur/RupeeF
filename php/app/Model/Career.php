<?php
App::uses('AppModel', 'Model');
/**
 * Career Model
 *
 */
class Career extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'job_title';

/**
 * hasMany association
 */
    public $hasMany = array(
        'JobApplicant'=>array(
            'className'=>'JobApplicant',
            'foreingKey'=>'career_id',
            'conditions'=>''
        )
    );

}
