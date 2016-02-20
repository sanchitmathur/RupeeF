<?php
App::uses('ServiceAdvantage', 'Model');

/**
 * ServiceAdvantage Test Case
 *
 */
class ServiceAdvantageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_advantage',
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
		$this->ServiceAdvantage = ClassRegistry::init('ServiceAdvantage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServiceAdvantage);

		parent::tearDown();
	}

}
