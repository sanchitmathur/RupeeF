<?php
App::uses('MainService', 'Model');

/**
 * MainService Test Case
 *
 */
class MainServiceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.main_service',
		'app.sub_service'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MainService = ClassRegistry::init('MainService');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MainService);

		parent::tearDown();
	}

}
