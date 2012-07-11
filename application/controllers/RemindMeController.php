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


		$e = $this->_form->getElement('email');
		$e->addValidator(new SoundPuzzle_Validate_Db_NoRecordExists(
			  array(
				 'table'	=> $this->_mapper->getDbTable()->getName(),
				 'field'	=> 'email'
		   )));

		$layout = $this->getRequest()->getParam('layout');
		if ($layout) {
			$this->_helper->layout->setLayout($layout);
		}
	}

	public function indexAction() {
		$this->_form->setAction('/remindMe/sign');
		$this->view->form = $this->_form;
	}

	public function signAction() {

		$request = $this->getRequest();
		if ($this->getRequest()->isPost()) {
			if ($this->_form->isValid($request->getPost())) {
				$email	 = $this->_mapper->setEntry($request->getPost());
				$this->_mapper->save($email);
				$mail	  = new SoundPuzzle_Mail('utf8');
				$mail->assign('link', 'http://www.soundpuzzle.de/remindMe/activate/type/' . $request->getParam('type') . '/hash/' . $email->getHash());
				$mail->assign('email', $email->getEmail());
				$mail->renderEmail('activation');
				$mail->setFrom('kontakt@soundpuzzle.de', 'Soundpuzzle Aktivierung');
				$mail->addTo($email->getEmail(), $email->getEmail());
				$mail->setSubject('Soundpuzzle Aktivierung');
				$mail->send();
				$adminMail = new SoundPuzzle_Mail('utf8');
				$adminMail->assign('type', $request->getParam('type'));
				$adminMail->assign('email', $email->getEmail());
				$adminMail->renderEmail('admin');
				$adminMail->setFrom('kontakt@soundpuzzle.de', 'Soundpuzzle Aktivierung');
				$adminMail->addTo('kontakt@soundpuzzle.de');
				$adminMail->setSubject('Soundpuzzle Aktivierung');
				$adminMail->send();
				$data	  = array(
				   'status' => 'success'
				);
			} else {
				$data		   = $this->_form->getMessages();
				$data['status'] = 'error';
			}
		}
		$this->_helper->json($data);
		$this->view->form = $this->_form;
	}

	/*
	 * @todo: Labels befüllen, Layout setzen
	 */

	public function activateAction() {
		if ($this->getRequest()->getParam('hash')) {
			$hash  = $this->getRequest()->getParam('hash');
			$email = $this->_mapper->findByHash($hash);
			$this->view->headline = 'Es tut uns leid!';
			if ($email) {
				if ($email->getActivated() != 0) {
					$this->view->msg = 'Ihr Account wurde schon aktiviert.';
				} else {
					$email->setActivated(1);
					$this->_mapper->save($email);
					$this->view->headline = 'Herzichen Glückwunsch!';
					$this->view->msg = 'Ihr Account wurde aktiviert. Sie werden nun benachrichtigt, falls es Neuigkeiten zum Projekt Soundpuzzle gibt.';
				}
			} else {
				$this->view->msg = 'Ihr Account konnte nicht gefunden werden.';
			}
		}
	}

}

