<?php

class MailController extends Zend_Controller_Action {

	public function init() {
		/* Initialize action controller here */
	}

	public function indexAction() {

		$mail = new SoundPuzzle_Mail();
		$mail->renderEmail('activation');
		$mail->setFrom('somebody@example.com', 'Ein Versender');
		$mail->addTo('kevin.purrmann@googlemail.com', 'Ein Empfänger');
		$mail->setSubject('Activation');
		$mail->send();
	}

}

