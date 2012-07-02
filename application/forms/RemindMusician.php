<?php

class Application_Form_RemindMusician extends Zend_Form {

	public function init() {

		$type = new Zend_Form_Element_Hidden('type');
		$type->setValue(1);

		$email = new Zend_Form_Element_Text('email');
		$email->setRequired(true)
		   ->setFilters(array('StringTrim', 'StringToLower'))
		   ->setAttrib('placeholder', 'Geben Sie ihre Email')
		   ->addValidator(new Zend_Validate_EmailAddress(array(
				 'messages' => array(
					Zend_Validate_EmailAddress::INVALID		=> 'Falscher Datentyp angegeben',
					Zend_Validate_EmailAddress::INVALID_FORMAT => "Das Format stimmt nicht mit dem einer E-Mailadresse überein"
				 ))))
		   ->addValidator('Db_NoRecordExists', true, array(
			  'table' => 'musicians',
			  'field' => 'email'));

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setIgnore(true)
		   ->setLabel('Melden Sie sich jetzt an')
		   ->setAttrib('class', 'btn btn-large btn-primary');



		// create Form
		$this->setAttrib('class', 'well form-horizontal')
		   ->setMethod('post')
		   ->addElement($email)
		   ->addElement($type)
		   ->addElement($submit);
	}

}
