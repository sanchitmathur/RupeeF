<?php
App::uses('ServiceFaq', 'Model');

/**
 * ServiceFaq Test Case
 *
 */
class ServiceFaqTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_faq',
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
		$this->ServiceFaq = ClassRegistry::init('ServiceFaq');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServiceFaq);

		parent::tearDown();
	}

}
