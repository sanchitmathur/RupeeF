<?php
/**
 * SubServiceFixture
 *
 */
class SubServiceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'service_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'main_service_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'is_blocked' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => '1=Blocked'),
		'is_deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => '1=Deleted'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'service_name' => 'Lorem ipsum dolor sit amet',
			'main_service_id' => 1,
			'is_blocked' => 1,
			'is_deleted' => 1
		),
	);

}