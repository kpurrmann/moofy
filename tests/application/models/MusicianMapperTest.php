<?php

//require_once dirname(__FILE__) . '/../../../application/models/EmailMapper.php';
require_once '../library/Ibuildings/Test/PHPUnit/DatabaseTestCase/Abstract.php';

/**
 * Test class for Application_Model_EmailMapper.
 * Generated by PHPUnit on 2012-06-24 at 22:19:00.
 */
class Application_Model_MusicianMapperTest extends Ibuildings_Test_PHPUnit_DatabaseTestCase_Abstract {

	protected $_initialSeedFile = 'emailsSeed.xml';
	protected $_musicianMapper;
	protected $_dataSet;

	public function setUp() {
		$this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
		$this->_musicianMapper = new Application_Model_MusicianMapper();
		$this->_dataSet = new Zend_Test_PHPUnit_Db_DataSet_QueryDataSet($this->getConnection());
		parent::setUp();
	}

	public function testSetEntry() {
		$data = array(
		   'email'	 => 'user3@test.de',
		   'hash'	  => 'myHashInsert',
		   'activated' => 0,
		   'created'   => '2012-06-25 20:55:48');

		$email = $this->_musicianMapper->setEntry($data);
		$this->assertInstanceOf('Application_Model_Musician', $email);
		$this->assertEquals($data['email'], $email->getEmail());
		$this->assertEquals($data['hash'], $email->getHash());
		$this->assertEquals($data['activated'], $email->getActivated());
		$this->assertEquals($data['created'], $email->getCreated());
	}


	public function testGetDbTable(){
		$db = $this->_musicianMapper->getDbTable();
		$this->assertNotEmpty($db);
		$this->assertInstanceOf('Application_Model_DbTable_Musicians', $db);
	}

}

?>
