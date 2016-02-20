<?php
App::uses('Language', 'Model');

/**
 * Language Test Case
 *
 */
class LanguageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.language',
		'app.user',
		'app.city',
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
		$this->Language = ClassRegistry::init('Language');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Language);

		parent::tearDown();
	}

}
