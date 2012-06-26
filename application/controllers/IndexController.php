<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

		$emailMapper = new Application_Model_EmailMapper();
        $tst = $emailMapper->find(1);
		Zend_Debug::dump($tst);
		exit;
        $form = new Application_Form_RemindMe();
		$form->setAction('remindMe/sign');
		$this->view->form = $form;
    }


}

