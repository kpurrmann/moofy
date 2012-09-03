<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
		
        $layout = $this->getRequest()->getParam('layout');
		if($layout){
			$this->_helper->layout->setLayout($layout);
		}
    }

    public function indexAction()
    {
        
    }

    public function solutionAction()
    {
        $this->view->step = $this->getRequest()->getParam('step');
    }

    public function privacyAction()
    {
    }

    public function imprintAction()
    {
        // action body
    }


}











