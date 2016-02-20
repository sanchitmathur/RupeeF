<?php
App::uses('UserCart', 'Model');

/**
 * UserCart Test Case
 *
 */
class UserCartTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_cart',
		'app.user',
		'app.city',
		'app.language',
		'app.user_service_package',
		'app.service_package',
		'app.service',
		'app.sub_service',
		'app.main_service',
		'app.service_advantage',
		'app.service_faq',
		'app.user_service'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserCart = ClassRegistry::init('UserCart');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserCart);

		parent::tearDown();
	}

}
