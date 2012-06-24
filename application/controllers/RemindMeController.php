<?php

class RemindMeController extends Zend_Controller_Action {

	public function init() {
		/* Initialize action controller here */
	}

	public function indexAction() {
		// action body
	}

	public function signAction() {
		$form = new Application_Form_RemindMe();
		$request = $this->getRequest();
		if ($this->getRequest()->isPost()) {
			if ($form->isValid($request->getPost())) {
//				$comment = new Application_Model_Guestbook($form->getValues());
//				$mapper  = new Application_Model_GuestbookMapper();
//				$mapper->save($comment);
				return $this->_helper->redirector('index');
			}
		}
		
		$this->view->form = $form;
	}

}

