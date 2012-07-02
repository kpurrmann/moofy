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

	public function setEntry($data) {
		$email = new Application_Model_Musician();

		if (!empty($data)) {
			if (isset($data['id']))
				$email->setId($data['id']);

			if (isset($data['email']))
				$email->setEmail($data['email']);

			if (isset($data['hash']))
				$email->setHash($data['hash']);
			else
				$email->setHash($this->generateHash($data['email']));

			if (isset($data['activated']))
				$email->setActivated($data['activated']);
			else
				$email->setActivated('0');

			if (isset($data['created']))
				$email->setCreated($data['created']);
			else
				$email->setCreated(date('Y-m-d H:i:s'));
		}
		return $email;
	}

}