<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SoundPuzzleMail
 *
 * @author EJA
 */
class SoundPuzzle_Mail extends Zend_Mail {

	protected $_view;

	public function __construct($charset = null) {
		$this->_view = new Zend_View();
		$this->_view->setScriptPath(APPLICATION_PATH . '/views/emails/');
		parent::__construct($charset);
	}

	public function getView() {
		return $this->_view;
	}

	public function assign($name, $value) {
		$this->_view->assign($name, $value);
	}

	public function renderEmail($view){
		$this->setBodyHtml($this->_view->render($view . '.phtml'));
		$this->setBodyText($this->_view->render($view . '.text.phtml'));
	}
}

?>
