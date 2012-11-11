<?php

class Ajax_RegisterController extends Zend_Controller_Action
{
	public function init() {
		parent::init();
        $this->getHelper('layout')->disableLayout();		
	}
	
	public function indexAction() {
		$this->_helper->viewRenderer->setNoRender(true);
		$userinfo['first_name'] = $this->getRequest()->getParam('first_name');	
		$userinfo['last_name'] = $this->getRequest()->getParam('last_name');		
		$userinfo['school_id'] = $this->getRequest()->getParam('school_id');
		$userinfo['school_year'] = $this->getRequest()->getParam('school_year');
		$userinfo['class_year'] = $this->getRequest()->getParam('class_year');
		$userinfo['status'] = 1;	
		
		$userCredentails['email'] = $this->getRequest()->getParam('email');
		$userCredentails['password'] = $this->getRequest()->getParam('password');
		
		$tUsersInfo = new Table_UsersInfo();		
		if($userid = $tUsersInfo->createUser($userinfo)) {
			$userCredentails['userID'] = $userid;
			$tUsers = new Table_Users();
			$tUsers->createUserCredentials($userCredentails);
			
			$tActivity = new Table_Activities();
			$tActivity->createActivity($userid, 1, $userinfo['school_id'], $userinfo['school_id']);
			User::login($userCredentails['email'], $userCredentails['password']);
			$this->_redirect(HTTP_HOST . "/chatroom/chat");
		}		
	}
	
	public function checkEmailAction() {
		
		$email = $this->getRequest()->getParam('email', '');
		$tUser = new Table_Users();
		if($tUser->isEmailExist($email))
			$this->view->result = array('error' => 1);
		else
			$this->view->result = array('error' => 0);
			
		$this->render("ajaxresp", null, true);
	}
	
	
}