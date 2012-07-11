<?php

class Application_Form_RemindMusician extends Application_Form_RemindMe {

	public function init() {

		$type = new Zend_Form_Element_Hidden('type');
		$type->setValue(1)
		   ->removeDecorator('Label')
		   ->addDecorator('HtmlTag', array(
			  'tag'   => 'div',
		   ));
		$this->addElement($type);
		parent::init();
	}

}
