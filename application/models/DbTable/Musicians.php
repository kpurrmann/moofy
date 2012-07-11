<?php

class Application_Model_DbTable_Musicians extends Zend_Db_Table_Abstract
{

    protected $_name = 'musicians';

	public function getName() {
		return $this->_name;
	}


}

