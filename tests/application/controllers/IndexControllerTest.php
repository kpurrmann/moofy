<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {

	public function setUp() {
		$this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
		parent::setUp();
	}

	public function testInit() {
		$params = array('action'	 => 'index', 'controller' => 'Index', 'module'	 => 'default');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->getRequest()->setParam('layout', 'lightbox');
		$this->dispatch($url);
		$this->assertQueryCount('body#lightbox', 1);
	}

	public function testIndexAction() {
		$params = array('action'	 => 'index', 'controller' => 'Index', 'module'	 => 'default');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);

		// assertions
		$this->assertModule($urlParams['module']);
		$this->assertController($urlParams['controller']);
		$this->assertAction($urlParams['action']);
	}

	public function testSolutionAction() {
		$params = array('action'	 => 'solution', 'controller' => 'Index', 'module'	 => 'default');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);

		// assertions
		$this->assertModule($urlParams['module']);
		$this->assertController($urlParams['controller']);
		$this->assertAction($urlParams['action']);
	}

}

