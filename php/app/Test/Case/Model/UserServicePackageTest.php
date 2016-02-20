<?php
App::uses('UserServicePackage', 'Model');

/**
 * UserServicePackage Test Case
 *
 */
class UserServicePackageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_service_package',
		'app.user',
		'app.service_package',
		'app.service',
		'app.sub_service',
		'app.main_service'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserServicePackage = ClassRegistry::init('UserServicePackage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserServicePackage);

		parent::tearDown();
	}

}
