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
        // action body
    }

    public function problemAction()
    {
        // action body
    }

    public function solutionAction()
    {
        // action body
    }

    public function howtoAction()
    {
        // action body
    }


}







