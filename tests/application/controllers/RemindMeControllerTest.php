<?php

class RemindMeControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {

	public function setUp() {
		$this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
		parent::setUp();
	}

	public function testSetLayout() {
		$params = array('action'	 => 'index', 'controller' => 'RemindMe', 'module'	 => 'default');
		$this->getRequest()->setQuery('layout', 'lightbox');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);

		$this->assertModule($urlParams['module']);
		$this->assertController($urlParams['controller']);
		$this->assertAction($urlParams['action']);
	}

	public function testRedirectIfNoTypeGiven() {
		$params = array('action'	 => 'index', 'controller' => 'RemindMe', 'module'	 => 'default');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);

		$this->assertModule($urlParams['module']);
		$this->assertController($urlParams['controller']);
		$this->assertAction($urlParams['action']);
	}

	public function testInitializeMapperDependingOnType() {
		$params = array('action'	 => 'index', 'controller' => 'RemindMe', 'module'	 => 'default');
		$this->getRequest()->setParam('type', 1);
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);

		$params = array('action'	 => 'index', 'controller' => 'RemindMe', 'module'	 => 'default');
		$this->getRequest()->setParam('type', 2);
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);
	}

	public function testValidateAction() {

		$data['email'] = 'mail@mail.de';
		$data['type']  = 1;
		$this->getRequest()->setParams($data);

		$params = array('action'	 => 'validate', 'controller' => 'RemindMe', 'module'	 => 'default');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);
		$this->assertResponseCode('200');
		$headers	 = $this->_frontController->getResponse()->getHeaders();
		$this->assertEquals('application/json', $headers[0]['value']);
		$this->assertEquals('[]', $this->_frontController->getResponse()->getBody());

		$data['email'] = 'nomail';
		$data['type']  = 1;
		$this->getRequest()->setParams($data);
		$this->dispatch($url);
		$this->assertResponseCode('200');
		$this->assertNotEquals('[]', $this->_frontController->getResponse()->getBody());
	}

	public function testActivateAction() {
		$params = array('action'	 => 'activate', 'controller' => 'RemindMe', 'module'	 => 'default');
		$this->getRequest()->setParam('hash', 'myHash');
		$this->getRequest()->setParam('type', 1);
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);
		$this->assertResponseCode('200');
		$this->assertArrayHasKey('hash', $this->getRequest()->getParams());
		$this->assertNotEmpty($this->getRequest()->getParam('hash'));
	}

	public function testSignAction() {
		$data['email']  = 'mail@mail.de';
		$data['type']   = 1;
		$data['submit'] = 1;
		$this->getRequest()->setPost('email', $data['email']);
		$this->getRequest()->setPost('type', $data['type']);
		$this->getRequest()->setPost('submit', 'Melden Sie sich jetzt an');
		$params		 = array('action'	 => 'sign', 'controller' => 'RemindMe', 'module'	 => 'default');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);
		$this->assertResponseCode('200');
		Zend_Debug::dump($this->_frontController->getResponse()->getBody());
		$this->assertNotEquals('[]', $this->_frontController->getResponse()->getBody());
	}

}

