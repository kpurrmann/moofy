<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UniqueEmail
 *
 * @author EJA
 */
class UniqueEmail extends Zend_Validate_Db_Abstract {

	//put your code here
	public function isValid($value) {

		$valid = true;
		$this->_setValue($value);
		

		return $isValid;
	}

	public function getMessages() {
		;
	}

}

?>
