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
		$router->addRoute('privacyInLightbox', new Zend_Controller_Router_Route('/datenschutz/layout/:layout',
		   array('controller' => 'index', 'action' => 'privacy')));
		$router->addRoute('', new Zend_Controller_Router_Route('/datenschutz',
		   array('controller' => 'index', 'action' => 'privacy')));
		$router->addRoute('imprintInLightbox', new Zend_Controller_Router_Route('/impressum/layout/:layout',
		   array('controller' => 'index', 'action' => 'imprint')));
		$router->addRoute('imprint', new Zend_Controller_Router_Route('/impressum',
		   array('controller' => 'index', 'action' => 'imprint')));
		$router->addRoute('remindMeInLightbox', new Zend_Controller_Router_Route('/reminder/type/:type/layout/:layout',
		   array('controller' => 'reminder', 'action' => 'index')));
		$router->addRoute('remindMe', new Zend_Controller_Router_Route('/reminder/type/:type',
		   array('controller' => 'reminder', 'action' => 'index')));
		//...
		// Returns the router resource to bootstrap resource registry
		return $router;
	}

}

