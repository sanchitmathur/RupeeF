<?php
App::uses('SubService', 'Model');

/**
 * SubService Test Case
 *
 */
class SubServiceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sub_service',
		'app.main_service',
		'app.service',
		'app.service_package'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SubService = ClassRegistry::init('SubService');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SubService);

		parent::tearDown();
	}

}
