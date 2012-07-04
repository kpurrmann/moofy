<?php

class RemindClientTest extends Zend_Test_PHPUnit_ControllerTestCase {

	public function setUp() {
		$this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
		parent::setUp();
	}

	public function testCanCreateForm(){
		$form = new Application_Form_RemindClient();
		$this->assertInstanceOf('Application_Form_RemindClient', $form);
	}

	public function testCanCreateTypeElement(){
		$form = new Application_Form_RemindClient();
		$this->assertInstanceOf('Zend_Form_Element_Hidden', $form->getElement('type'));
	}

	public function testTypeIsValid(){
		$form = new Application_Form_RemindClient();
		$this->assertEquals(2, $form->getElement('type')->getValue());
	}


}