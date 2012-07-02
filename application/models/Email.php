<?php

class Application_Model_Email {

	protected $_id;
	protected $_email;
	protected $_hash;
	protected $_activated;
	protected $_created;

	public function toArray() {
		return array(
		   'id'		=> $this->getId(),
		   'email'	 => $this->getEmail(),
		   'hash'	  => $this->getHash(),
		   'activated' => $this->getActivated(),
		   'created'   => $this->getCreated(),
		);
	}

	public function getId() {
		return $this->_id;
	}

	public function setId($id) {
		$this->_id = $id;
	}

	public function getEmail() {
		return $this->_email;
	}

	public function setEmail($email) {
		$this->_email = $email;
	}

	public function getHash() {
		return $this->_hash;
	}

	public function setHash($hash) {
		$this->_hash = $hash;
	}

	public function getActivated() {
		return $this->_activated;
	}

	public function setActivated($activated) {
		$this->_activated = $activated;
	}

	public function getCreated() {
		return $this->_created;
	}

	public function setCreated($created) {
		$this->_created = $created;
	}

}

