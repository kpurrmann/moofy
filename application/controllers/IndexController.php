<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new Application_Form_RemindMe();
		$form->setMethod('get')->setAction('remindMe/sign');
		$this->view->form = $form;
    }


}

