<?php
class User {
	
	protected $tUsers;
	
	function __construct() {
		$this->tUsers = new Table_Users();
	}
	
	static function getUserInfo($id) {
		if(!($objects = Obj_Cache::read('user_'.$id))){
			$users = new Table_UsersInfo();
			$user = $users->getUserInfo($id);
			Obj_Cache::save('user_'.$id, $user);
			return $user;
		}
		return $objects;
	}	
	
	static function getUser($id){
		$users = new Table_UsersInfo();
		return $users->getUser($id);
		
	}
	public static function login($email, $password) {
    	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$authAdapter = new Zend_Auth_Adapter_DbTable($db);
		$authAdapter->setTableName('users');
		$authAdapter->setIdentityColumn('email');
		$authAdapter->setCredentialColumn('password');
		$authAdapter->setCredentialTreatment('?');
		$authAdapter->setIdentity($email);
		$authAdapter->setCredential($password);
		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($authAdapter);
		if ($result->isValid()) {
			$data = $authAdapter->getResultRowObject(null, 'password');
			$oUser = null;
			$tUserInfo = new Table_UsersInfo();
			$data = $tUserInfo->getUser($data->userID);
			
			$oUser->school_id = $data->school_id;
			$oUser->user_id = $data->user_id; 
			$oUser->email = $email;
			
			if (is_null($oUser)) return false;
			$auth->getStorage()->write($oUser);
			return true;
		}
		return false;
	}
}