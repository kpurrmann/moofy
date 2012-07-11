<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

	protected function _initDoctype() {
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('HTML5');
	}

	public function _initRouter() {
		$front  = Zend_Controller_Front::getInstance();
		$router = $front->getRouter();

		// Add some routes
		$router->addRoute('contactInLightbox', new Zend_Controller_Router_Route('/kontakt/layout/:layout',
		   array('controller' => 'index', 'action' => 'contact')));
		$router->addRoute('contact', new Zend_Controller_Router_Route('/kontakt',
		   array('controller' => 'index', 'action' => 'contact')));
		$router->addRoute('imprintInLightbox', new Zend_Controller_Router_Route('/impressum/layout/:layout',
		   array('controller' => 'index', 'action' => 'imprint')));
		$router->addRoute('imprint', new Zend_Controller_Router_Route('/impressum',
		   array('controller' => 'index', 'action' => 'imprint')));
		//...
		// Returns the router resource to bootstrap resource registry
		return $router;
	}

}

