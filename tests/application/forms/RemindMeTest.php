<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RemindMeTest
 *
 * @author EJA
 */
class RemindMeTest extends Zend_Test_PHPUnit_ControllerTestCase {

	public function setUp() {
		$this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
		parent::setUp();
	}

	public function testCanCreateForm(){
		$form = new Application_Form_RemindMe();
		$this->assertInstanceOf('Application_Form_RemindMe', $form);
	}

	public function testFormHasElements(){
		$form = new Application_Form_RemindMe();
		$this->assertInstanceOf('Zend_Form_Element_Text', $form->getElement('email'));
		$this->assertInstanceOf('Zend_Form_Element_Submit', $form->getElement('submit'));
	}

}

?>
