<?php

class RemindMusicianTest extends Zend_Test_PHPUnit_ControllerTestCase {

	public function setUp() {
		$this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
		parent::setUp();
	}

	public function testCanCreateForm(){
		$form = new Application_Form_RemindMusician();
		$this->assertInstanceOf('Application_Form_RemindMusician', $form);
	}

	public function testCanCreateTypeElement(){
		$form = new Application_Form_RemindClient();
		$this->assertInstanceOf('Zend_Form_Element_Hidden', $form->getElement('type'));
		$this->assertInstanceOf('Zend_Form_Element_Text', $form->getElement('email'));
		$this->assertInstanceOf('Zend_Form_Element_Submit', $form->getElement('submit'));
	}

	public function testTypeIsValid(){
		$form = new Application_Form_RemindMusician();
		$this->assertEquals(1, $form->getElement('type')->getValue());
	}


}