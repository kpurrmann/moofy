<?php

class Application_Form_RemindMe extends Zend_Form {

	public function init() {
		// Set the method for the display form to POST
		$this->setMethod('post');

		// Add an email element
		$this->addElement('text', 'email', array(
		   'label'	=> 'Type your email address:',
		   'required' => true,
		   'filters'  => array('StringTrim', 'StringToLower'),
		   'validators' => array(
			  'EmailAddress',
		   ),
		   'placeholder' => 'Type your email address',
		));


		// Add the submit button
		$this->addElement('submit', 'submit', array(
		   'ignore' => true,
		   'label'  => 'Sign',
		   'class' => 'btn btn-large btn-primary'
		));

		$this->addAttribs(array(
		   'class' => 'well form-horizontal'
		));

	}

}

