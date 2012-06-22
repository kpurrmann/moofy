<?php

class Application_Form_RemindMe extends Zend_Form {

	public function init() {
		// Set the method for the display form to POST
		$this->setMethod('post');

		// Add an email element
		$this->addElement('text', 'email', array(
		   'label'	=> 'Your email address:',
		   'required' => true,
		   'filters'  => array('StringTrim'),
		   'validators' => array(
			  'EmailAddress',
		   )
		));

		// Add the submit button
		$this->addElement('submit', 'submit', array(
		   'ignore' => true,
		   'label'  => 'Sign Guestbook',
		));

	}

}

