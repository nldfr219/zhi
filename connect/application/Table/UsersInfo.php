<?php
class Table_UsersInfo extends Zend_Db_Table {
	protected $_name = "users_info";
	protected $_primary = "user_id";
	

	public function getUser($id){
		$select = $this->select()->from($this)->where("user_id=?", $id)->setIntegrityCheck(false);
		return $this->fetchRow($select);		
	}
		
	public  function getUserName($id){
		$user = $this->getUser($id);
		return $user["first_name"]." ".$user["last_name"];
			
	}
		
	public function createUser($userinfo){
		return $this->insert($userinfo);
	}
}