<?php

class RemindMeControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testIndexAction()
    {
        $params = array('action' => 'index', 'controller' => 'RemindMe', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
    }

    public function testSignAction()
    {
        $params = array('action' => 'sign', 'controller' => 'RemindMe', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

		$type = $this->getRequest()->getQuery('type');
        
		// assertions

		if($type == 1 || $type = 2) {
			$this->assertModule($urlParams['module']);
			$this->assertController($urlParams['controller']);
			$this->assertAction($urlParams['action']);
		} else {
			$this->assertModule($urlParams['module']);
			$this->assertController('Index');
			$this->assertAction('index');
		}


    }

    public function testActivateAction()
    {
        $params = array('action' => 'activate', 'controller' => 'RemindMe', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains(
            'div#view-content p',
            'Danke'
            );
    }


}







