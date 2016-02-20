<?php
/**
 * UserServiceFixture
 *
 */
class UserServiceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'service_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'purchase_datetime' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'is_blocked' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '1=Blocked'),
		'is_deleted' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '1=Deleted'),
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
			'user_id' => 1,
			'service_id' => 1,
			'purchase_datetime' => '2016-01-25 13:41:41',
			'is_blocked' => 1,
			'is_deleted' => 1
		),
	);

}
