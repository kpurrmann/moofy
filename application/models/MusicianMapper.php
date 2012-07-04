<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailsMapper
 *
 * @author EJA
 */
class Application_Model_MusicianMapper extends Application_Model_EmailMapper {

	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable('Application_Model_DbTable_Musicians');
		}
		return $this->_dbTable;
	}

	public function setEntry($data, $email = null) {
		if ($email === null)
			$email = new Application_Model_Musician();
		$email = parent::setEntry($data, $email);
		return $email;
	}

}