<?php

class Application_Model_DbTable_Clients extends Zend_Db_Table_Abstract {

	protected $_name = 'clients';

	public function getName() {
		return $this->_name;
	}

}

