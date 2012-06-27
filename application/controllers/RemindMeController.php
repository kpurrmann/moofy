<?php

class RemindMeController extends Zend_Controller_Action {

	protected $_emailMapper = null;

	public function init() {
		$this->_emailMapper = new Application_Model_EmailMapper();
		$layout = $this->getRequest()->getParam('layout');
		if($layout){
			$this->_helper->layout->setLayout($layout);
		}
	}

	public function indexAction() {
		if ((!$this->getRequest()->getParam('type')) || ($this->getRequest()->getParam('type') > 2)) {
			return $this->_helper->redirector('index', 'index');
		} else {
			$form = new Application_Form_RemindMe($this->getRequest()->getParam('type'));
			$form->setAction($this->getFrontController()->getBaseUrl() . '/remindMe/sign');
			$this->view->form = $form;
		}
	}

	public function signAction() {


		$form	= new Application_Form_RemindMe(0);
		$request = $this->getRequest();
		if ($this->getRequest()->isPost()) {
			if ($form->isValid($request->getPost())) {
				$email = $this->_emailMapper->setEntry($request->getPost());
				$this->_emailMapper->save($email);
				$data  = array(
				   'status' => 'success'
				);

				$this->_helper->json($data);
			}
		}

		$this->view->form = $form;
	}

	public function validateAction() {

		$f = new Application_Form_RemindMe();
		$f->isValid($this->_getAllParams());
		$this->_helper->json($f->getMessages());
	}

	/*
	 * @todo: Labels befüllen, Layout setzen
	 */

	public function activateAction() {
		if ($this->getRequest()->getParam('hash')) {
			$hash  = $this->getRequest()->getParam('hash');
			$email = $this->_emailMapper->findByHash($hash);
			if ($email) {
				if ($email->getActivated() != 0) {
					$this->view->msg = 'Schon aktiv';
				} else {
					$email->setActivated(1);
					$this->_emailMapper->save($email);
					$this->view->msg = 'Ihr Account wurde';
				}
			} else {
				$this->view->msg = 'Es tut uns leid!';
			}
			Zend_Debug::dump($this->getRequest()->getParam('hash'));
		}
	}

}

