<?php

class Application_Form_RemindMe extends Zend_Form {

	protected $_type;

	function __construct($type = null) {
		$this->_type = $type;
		parent::__construct();
	}

	public function init() {

		$type = new Zend_Form_Element_Hidden('type');
		$type->setValue($this->_type);


		/*
		 * @todo Labels
		 */

		$email = new Zend_Form_Element_Text('email');
		$email->setRequired(true)
		   ->setFilters(array('StringTrim', 'StringToLower'))
		   ->setAttrib('placeholder', 'Geben Sie ihre Email')
		   ->addValidator(new Zend_Validate_EmailAddress(array(
				 'messages' => array(
					Zend_Validate_EmailAddress::INVALID		=> 'Falscher Datentyp angegeben',
					Zend_Validate_EmailAddress::INVALID_FORMAT => "Das Format stimmt nicht mit dem einer E-Mailadresse überein"
				 )
			  )))
		   ->removeDecorator('DtDdWrapper')->removeDecorator('HtmlTag')
		   ->addDecorator('HtmlTag', '<div class="control-group">');

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

	public function isValid($data) {
		$this->getElement('email')
		   ->addValidator('Db_NoRecordExists', false, array(
			  'table'   => 'emails',
			  'field'   => 'email',
			  'exclude' => array(
				 'field' => 'type',
				 'value' => (int) $this->_type)
			  )
		);
		parent::isValid($data);
	}

}
