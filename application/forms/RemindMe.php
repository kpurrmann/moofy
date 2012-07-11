<?php

class Application_Form_RemindMe extends Zend_Form {

	public function init() {


		$email = new Zend_Form_Element_Text('email');
		$email->setRequired(true)
		   ->setFilters(array('StringTrim', 'StringToLower'))
		   ->setAttrib('placeholder', 'Bitte Ihre E-Mail Adresse eingeben.')
		   ->setAttrib('style', 'width:98%')
		   ->addValidator(new Zend_Validate_EmailAddress(array(
				 'messages' => array(
					Zend_Validate_EmailAddress::INVALID_MX_RECORD => 'MX Typ ist nicht korrekt.',
					Zend_Validate_EmailAddress::INVALID		   => 'Falscher Datentyp angegeben.',
					Zend_Validate_EmailAddress::INVALID_FORMAT	=> "Das Format stimmt nicht mit dem einer E-Mailadresse überein",
					Zend_Validate_EmailAddress::INVALID_HOSTNAME  => "Der Hostname von %value% ist nicht korrekt.",
					Zend_Validate_EmailAddress::LENGTH_EXCEEDED   => "Die Länge von %value% stimmt nicht mit den Bestimmungen überein.",
				 )
			  )))
		   ->addValidator(
			  'NotEmpty', false, array('messages' => array(Zend_Validate_NotEmpty::IS_EMPTY => 'Das Feld darf nicht leer sein.'))
		   )->addDecorator('HtmlTag', array(
			  'tag'   => 'div',
			  'class' => 'control-group'
		   ))
		   ->removeDecorator('Label');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setIgnore(true)
		   ->setLabel('Melden Sie sich jetzt an')
		   ->setAttrib('class', 'btn btn-large btn-primary')
		   ->setAttrib('style', 'width:100%')
		   ->removeDecorator('DtDdWrapper')
		   ->addDecorator('HtmlTag', array(
			  'tag'   => 'div',
			  'class' => 'control-group'
		   ));



		// create Form
		$this->setAttrib('class', 'form-horizontal')
		   ->setMethod('post')
		   ->addDecorator('FormElements')
		   ->addDecorator('HtmlTag', array('tag'   => 'div', 'class' => 'zend_form'))
		   ->addDecorator('Form')
		   ->addElement($email)
		   ->addElement($submit);
	}

}
