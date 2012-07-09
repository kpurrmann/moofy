<?php

class RemindMeController extends Zend_Controller_Action {

	protected $_mapper = null;
	protected $_form   = null;

	public function init() {
		if ((!$this->getRequest()->getParam('type')) || ($this->getRequest()->getParam('type') > 2)) {
			return $this->_helper->redirector('index', 'Index', 'default');
		} else {
			if (1 == $this->getRequest()->getParam('type')) {
				$this->_form = new Application_Form_RemindMusician();
				$this->_mapper = new Application_Model_MusicianMapper();
			} else {
				$this->_form = new Application_Form_RemindClient();
				$this->_mapper = new Application_Model_ClientMapper();
			}
		}

		$layout = $this->getRequest()->getParam('layout');
		if ($layout) {
			$this->_helper->layout->setLayout($layout);
		}
	}

	public function indexAction() {
		$this->_form->setAction($this->getFrontController()->getBaseUrl() . '/remindMe/sign');
		$this->view->form = $this->_form;
	}

	public function signAction() {

		$request = $this->getRequest();
		if ($this->getRequest()->isPost()) {
			if ($this->_form->isValid($request->getPost())) {
//				$email = $this->_mapper->setEntry($request->getPost());
//				$this->_mapper->save($email);
//				$mail  = new SoundPuzzle_Mail();
//				$mail->assign('hash', $email->getHash());
//				$mail->renderEmail('activation');
//				$mail->setFrom('activation@soundpuzzle.de', 'Soundpuzzle Aktivierung');
//				$mail->addTo($email->getEmail(), $email->getEmail());
//				$mail->setSubject('Soundpuzzle Aktivierung');
//				$mail->send();
				$data  = array(
				   'status' => 'success'
				);

				$this->_helper->json($data);
			}
		}
		$this->view->form = $this->_form;
	}

	public function validateAction() {

		$this->_form->isValid($this->_getAllParams());
		$this->_helper->json($this->_form->getMessages());
	}

	/*
	 * @todo: Labels befüllen, Layout setzen
	 */

	public function activateAction() {
		if ($this->getRequest()->getParam('hash')) {
			$hash  = $this->getRequest()->getParam('hash');
			$email = $this->_mapper->findByHash($hash);
			if ($email) {
				if ($email->getActivated() != 0) {
					$this->view->msg = 'Schon aktiv';
				} else {
					$email->setActivated(1);
					$this->_mapper->save($email);
					$this->view->msg = 'Ihr Account wurde';
				}
			} else {
				$this->view->msg = 'Es tut uns leid!';
			}
		}
	}

}

