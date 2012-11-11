<?php
class Table_Users extends Zend_Db_Table {
	protected $_name = "users";
	protected $_primary = "id";
		
	public function isEmailExist($eamil) {
		$select = $this->select()->from($this, 'COUNT(*)')->where("email=?", $eamil)->setIntegrityCheck(false);
		$result = $this->fetchRow($select)->toArray();
		return $result['COUNT(*)'];
	}
		
	public function createUserCredentials($userCredentails){
		return $this->insert($userCredentails);
	}
}