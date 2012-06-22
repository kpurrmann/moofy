<?php

require_once '../application/controllers/IndexController.php';

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {


	public function setUp() {
		$this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
		parent::setUp();
	}

	public function testIndexAction() {
		$this->dispatch('/');
		$this->assertController('index');
		$this->assertAction('index');
		$this->assertResponseCode(200);
	}

}

