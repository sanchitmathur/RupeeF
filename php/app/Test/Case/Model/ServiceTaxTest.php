<?php
App::uses('ServiceTax', 'Model');

/**
 * ServiceTax Test Case
 *
 */
class ServiceTaxTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_tax'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ServiceTax = ClassRegistry::init('ServiceTax');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServiceTax);

		parent::tearDown();
	}

}
