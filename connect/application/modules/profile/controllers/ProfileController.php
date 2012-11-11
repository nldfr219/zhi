<?php

class Profile_ProfileController extends DefaultBaseController
{
	public function init() {
		parent::init();
        $this->_helper->layout->setLayout('studentcharts');
				
	}
	
	public function indexAction() {
		$this->view->schools = SchoolList::load();
		$tActivity = new Table_Activities();
		$result= $tActivity->getActivity(NULL, NULL, NULL, NULL);
		$tUser = new Table_UsersInfo();
		$output = $result->toArray();
		
 		if(!isset($_GET["uid"]))
 			$currentuser=$tUser->getUserName($this->user->user_id);
 		else
 			$currentuser=$tUser->getUserName($_GET["uid"]);
 		//echo $_GET["uid"].$currentuser; die;
 		
 		
 		
 		$uinfo = $tUser->getUser($this->user->user_id);
 		
 		
 		$this->view->assign("uinfo",$uinfo);
		$this->view->assign("user",$this->user);
		$this->view->assign("currentuser",$currentuser);
		$this->view->assign("activity",$output);	

	}
	
	
		/*
		$this->view->schools = SchoolList::load();
		$tActivity = new Table_Activities();
		$result= $tActivity->getActivity(NULL, NULL, NULL, NULL);
		$tUser = new Table_UsersInfo();
		$output = $result->toArray();
	
		if(!isset($_GET["uid"]))
			$currentuser=$tUser->getUserName($this->user->user_id);
		else
			$currentuser=$tUser->getUserName($_GET["uid"]);
		//echo $_GET["uid"].$currentuser; die;
			
			
		$this->view->assign("user",$this->user);
		$this->view->assign("currentuser",$currentuser);
		$this->view->assign("activity",$output);
	*/
	public function editAction()
		{
			$form = new Forms_Profile();
			$form->submit->setLabel('Save');
			$this->view->form = $form;
		
			if ($this->getRequest()->isPost()) {
				$formData = $this->getRequest()->getPost();
				if ($form->isValid($formData)) {
					
					$firstname = $form->getValue('first_name');
					$lastname = $form->getValue('last_name');
					$schoolyear = $form->getValue('school_year');
					$classyear = $form->getValue('class_year');
					$phonenumber = $form->getValue('phone_num');
					$facebook = $form->getValue('facebook');
					$linkedin = $form->getValue('linkedin');
					$twitter = $form->getValue('twitter');
					$location = $form->getValue('location');
					$status = $form->getValue('status');
					$altemail = $form->getValue('altemail');
					$summary = $form->getValue('summary');
					$interests = $form->getValue('interests');
					$favstuspot = $form->getValue('favstuspot');
					$favdrink = $form->getValue('favdrink');
					$pet = $form->getValue('pet');
					$petpeeve = $form->getValue('petpeeve');
					
					
					
					$data = array(
					'first_name'=>$firstname,
					'last_name'=>$lastname, 
					'school_year'=>$schoolyear, 
					'class_year'=>$classyear, 
					'phone_num'=>$phonenumber, 
					'facebook'=>$facebook, 
					'linkedin'=>$linkedin, 
					'twitter'=>$twitter, 
					'location'=>$location, 
					'status'=>$status, 
					'altemail'=>$altemail, 
					'summary'=>$summary, 
					'interests'=>$interests, 
					'favstuspot'=>$favstuspot, 
					'favdrink'=>$favdrink, 
					'pet'=>$pet,
					'petpeeve'=>$petpeeve,
					);
					
					
					$tUser = new Table_UsersInfo();
					$tUser->update($data,'user_id='.$this->user->user_id);
					
					/*
					 public function updateAlbum($id, $artist, $title)
						{
			$data = array(
			'artist' => $artist,
			'title' => $title,
			);
				$this->update($data, 'id = '. (int)$id);
					}
					 */
					
					
					
					
		
					$this->_helper->redirector('index');
				} else {
					$form->populate($formData);
				}
			} else {
				$tUser = new Table_UsersInfo();
				$temp=$tUser->getUser($this->user->user_id);
				$row=$temp->toArray();
			   $form->populate($row);
				}
			}
			
			
			
			
			public function uploadAction() {
				if ($this->getRequest()->isPost()) {
					$upload_handler =new UploadHandler();
					
					header('Pragma: no-cache');
					header('Cache-Control: no-store, no-cache, must-revalidate');
					header('Content-Disposition: inline; filename="files.json"');
					header('X-Content-Type-Options: nosniff');
					header('Access-Control-Allow-Origin: *');
					header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
					header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');
					
					switch ($_SERVER['REQUEST_METHOD']) {
						case 'OPTIONS':
							break;
						case 'HEAD':
						case 'GET':
							$upload_handler->get();
							break;
						case 'POST':
							if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
								$upload_handler->delete();
							} else {
								$info = $upload_handler->post();
								$this->_helper->json($info, true, false);
							}
							break;
						case 'DELETE':
							$upload_handler->delete();
							break;
						default:
							header('HTTP/1.1 405 Method Not Allowed');
					}
				}	
			}
}