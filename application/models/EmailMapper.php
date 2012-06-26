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
class Application_Model_EmailMapper {

	protected $_dbTable;

	public function setDbTable($dbTable) {
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}

	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable('Application_Model_DbTable_Emails');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_Email $email) {
		$data = array(
		   'id'		=> $email->getId(),
		   'email'	 => $email->getEmail(),
		   'type'	  => $email->getEmail_type(),
		   'hash'	  => $email->getHash(),
		   'activated' => $email->getActivated(),
		   'created'   => $email->getCreated(),
		);

		if (null === ($id = $email->getId())) {
			unset($data['id']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
	}

	public function setEntry($data) {

		$email = new Application_Model_Email();
		if (!empty($data)) {
			if (isset($data['id']))
				$email->setId($data['id']);

			if (isset($data['email']))
				$email->setEmail($data['email']);

			if (isset($data['type']))
				$email->setEmail_type($data['type']);

			if (isset($data['hash']))
				$email->setHash($data['hash']);

			if (isset($data['activated']))
				$email->setActivated($data['activated']);

			if (isset($data['created']))
				$email->setCreated($data['created']);
			else
				$email->setCreated(date('Y-m-d H:i:s'));
		}

		return $email;
	}

	public function find($id) {
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return;
		}
		$row   = $result->current();
		$email = $this->setEntry($row);
		return $email;
	}

	public function findByHash($hash) {
		$result = $this->getDbTable()->fetchRow($this->getDbTable()->select()->where('hash = ?', $hash));
		if (0 == count($result)) {
			return;
		}
		$email = $this->setEntry($result);

		return $email;
	}

}