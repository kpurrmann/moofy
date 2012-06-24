<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailsMapper
 *
 * @author EJA
 */
class EmailsMapper {

	public function save(Application_Model_Guestbook $guestbook);

	public function find($id);

	public function fetchAll();
}