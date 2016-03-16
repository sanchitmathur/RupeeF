<?php
App::uses('Menu', 'Model');

/**
 * Menu Test Case
 *
 */
class MenuTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menu',
		'app.service',
		'app.sub_service',
		'app.main_service',
		'app.service_advantage',
		'app.service_faq',
		'app.service_package'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Menu = ClassRegistry::init('Menu');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Menu);

		parent::tearDown();
	}

}