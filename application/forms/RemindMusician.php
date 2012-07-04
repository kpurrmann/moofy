<?php

class Application_Form_RemindMusician extends Zend_Form {

	public function init() {

		$type = new Zend_Form_Element_Hidden('type');
		$type->setValue(1);
		$this->addElement($type);
		parent::init();
	}

}
