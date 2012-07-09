<?php

class Application_Form_RemindClient extends Application_Form_RemindMe {

	public function init() {

		$type = new Zend_Form_Element_Hidden('type');
		$type->setValue(2);
		$this->addElement($type);
		parent::init();
	}
}
