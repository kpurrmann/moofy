<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoRecordExists
 *
 * @author KPU
 */
class SoundPuzzle_Validate_Db_NoRecordExists extends Zend_Validate_Db_NoRecordExists {

	/**
	 * @var array Message templates
	 */
	protected $_messageTemplates = array(
	   self::ERROR_NO_RECORD_FOUND => "Es wurde kein Datensatz gefunden.",
	   self::ERROR_RECORD_FOUND	=> "Es gibt bereits einen Datensatz mit der E-Mail '%value%'.",
	);

}

?>
