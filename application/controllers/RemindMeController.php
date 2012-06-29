<?php

class RemindMeController extends Zend_Controller_Action {

	protected $_emailMapper = null;

	public function init() {
		$this->_emailMapper = new Application_Model_EmailMapper();
		$layout = $this->getRequest()->getParam('layout');
		if ($layout) {
			$this->_helper->layout->setLayout($layout);
		}
	}

	public function indexAction() {
		if ((!$this->getRequest()->getParam('type')) || ($this->getRequest()->getParam('type') > 2)) {
			return $this->_helper->redirector('index', 'index');
		} else {
			$form = new Application_Form_RemindMe();
			$form->setAction($this->getFrontController()->getBaseUrl() . '/remindMe/sign');
			$form->getElement('type')->setValue((int)$this->getRequest()->getParam('type'));
			$this->view->form = $form;
		}
	}

	public function signAction() {

		$form	= new Application_Form_RemindMe();
		$request = $this->getRequest();
		if ($this->getRequest()->isPost()) {
			if ($form->isValid($request->getPost())) {
				$email = $this->_emailMapper->setEntry($request->getPost());
				$this->_emailMapper->save($email);
				$mail  = new SoundPuzzle_Mail();
				$mail->assign('hash', $email->getHash());
				$mail->renderEmail('activation');
				$mail->setFrom('activation@soundpuzzle.de', 'Soundpuzzle Aktivierung');
				$mail->addTo($email->getEmail(), $email->getEmail());
				$mail->setSubject('Soundpuzzle Aktivierung');
				$mail->send();
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

