<?php
App::uses('UserService', 'Model');

/**
 * UserService Test Case
 *
 */
class UserServiceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_service',
		'app.user',
		'app.service',
		'app.sub_service',
		'app.main_service',
		'app.service_package'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserService = ClassRegistry::init('UserService');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserService);

		parent::tearDown();
	}

}
