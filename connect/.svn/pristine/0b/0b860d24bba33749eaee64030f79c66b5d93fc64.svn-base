<?php

class Chatroom_ChatController extends DefaultBaseController
{
	public function init() {
		parent::init();
		$this->_helper->layout->setLayout('studentcharts');

	}

	public function indexAction() {
		$this->view->schools = SchoolList::load();

		$this->view->states = Obj_States::getFullStates();
		$tActivity = new Table_Activities();
		$result= $tActivity->getActivity(NULL, NULL, NULL, NULL);
		$tUser = new Table_UsersInfo();
		$output = $result->toArray();



		if(!isset($_GET["sid"]))
		{
			$id=$this->user->school_id;
		}else
		$id=$_GET["sid"];
		$currentSchool1=SchoolList::getcurrent($id);
		$currentSchool=$currentSchool1["name"];
		foreach ( $output as $key => $value)
		{
			$creatorid=$output[$key]["creator_id"];
			$type=$output[$key]["type"];
			$receiverid=$output[$key]["receiver_id"];
			$school=$output[$key]["school_id"];
			if($school==$id)
			{
					
		 	$object1=$output[$key]["object1"];  
		 	$object2=$output[$key]["object2"];
		 	$time=$output[$key]["activity_date"];
		 	$creator='<a href="../profile/profile?uid='.$creatorid.'" >'.$tUser->getUserName($creatorid).'</a>';
		 	$receiver='<a href="../profile/profile?uid='.$receiverid.'" >'.$tUser->getUserName($receiverid).'</a>';

		 		
		 	switch($type){
		 		case 1:
		 			$newphrase=$creator." has registered and requires n sponsors for approval.";break;
		 		case 2:
		 			$newphrase=$creator." has been approved for membership.";break;
		 		case 3:
		 			$newphrase=$creator."'s statement, ".$object1." has been approved for National Totem";break;
		 		case 4:
		 			$newphrase=$creator." liked ".$receiver."'s membership.";break;
		 		case 5:
		 			$newphrase=$creator." liked ".$receiver."'s comment:'".$object1."'.";break;
		 		case 6:
		 			$newphrase=$creator." liked ".$receiver."'s statement:'".$object1."'.";break;
		 		case 7:
		 			$newphrase=$creator." liked ".$receiver."'s profile picture:<img src='".$object1."'/>.";break;
		 		case 8:
		 			$newphrase=$creator." liked the image in :'".$object1."'.";break;
		 		case 9:
		 			$newphrase=$creator." liked ".$receiver."'s lecture notes :'".$object1."'.";break;
		 		case 10:
		 			$newphrase=$creator." liked ".$receiver."'s study aid, titled:'".$object1."'."."<img src='".$object2."'/>";break;
		 		case 11:
		 			$newphrase=$creator." liked ".$receiver."'s event:'".$object1."'.";break;
		 		case 12:
		 			$newphrase=$creator." refined statement '".$object1."' and requires n sponsors for apporval.";break;
		 		case 13:
		 			$newphrase=$creator." proposes'".$object1."' in '".$object2."' and requires n sponsors for approval";break;
		 		case 14:
		 			$newphrase=$creator." proposes'".$object1."' and requires n sponsors for approval";break;
		 		case 15:
		 			$newphrase=$creator." uploaded a new profile picture <img>'".$object1."'";break;
		 		case 16:
		 			$newphrase=$creator." uploaded a new image in '".$object1."' <img> '".$object2."'.";break;
		 		case 17:
		 			$newphrase=$creator." uploaded lecture notes titled:'".$object1."' <img> '".$object2."'.";break;
		 		case 18:
		 			$newphrase=$creator." uploaded a study aid '".$object1."' to the National Stockpile <img> '".$object2."'.";break;
		 		case 19:
		 			$newphrase=$creator." uploaded a study aid '".$object1."' to the ".$object2." <img> '".$object2."'.";break;
		 		case 20:
		 			$newphrase=$creator." uploaded profile.";break;
		 		case 21:
		 			$newphrase=$creator." said :'".$object1."' to ".$receiver.".";break;
		 		case 22 :
		 			$newphrase=$creator." said :'".$object1."' on ".$object2.".";break;
		 		case 23:
		 			$newphrase=$creator." said :'".$object1."' on ".$object2.".";break;
		 		case 24:
		 			$newphrase=$creator." said :'".$object1."' on ".$object2.".";break;
		 		case 25:
		 			$newphrase=$creator." said :'".$object1."' on ".$object2.".";break;
		 		case 26:
		 			$newphrase=$creator." commented on  :".$receiver."'s profile picture.";break;
		 		case 27:
		 			$newphrase=$creator." commented on the image for :".$object1." in ".$object2.".";break;
		 		case 28:
		 			$newphrase=$creator." commented on  :".$receiver."'s profile picture.";break;
		 		case 29:		 			
	 				$tComment= new Table_Comments();
	 				//$comment = $tComment->getComment($object1);
	 		    	$newphrase=$creator." posted : ".$tComment->getComment($object1).".";
	 		    	break;
		 			
		 		default:
		 			break;


		 	}
		 		
		 		
			 $output[$key]["sentence"]="<p class='activity_item'>".$newphrase."</a> ( ".$time." )";
			 // if($this->user->school_id==$id)
			 //$output[$key]["sentence"].=" <button><img src='/image/sponsor.png' height='15px' width='30px'>Sponsor</button>";
			 $output[$key]["sentence"].="</p> ";
			 	
		 }else
		 $output[$key]["sentence"]="";
		}

		$this->view->assign("user",$this->user);
		$this->view->assign("currentschool",$currentSchool);
		$this->view->assign("activity",$output);

	}

	public function addcommentAction() {
		$this->_helper->viewRenderer->setNoRender(true);
		$arResult = array('error' => '');
		
		if($comment = $this->getRequest()->getParam('comments', '')){
			if($comment == '')
			return false;
			else {

				$tComment = new Table_Comments();
				$comment_id=$tComment->createComment($this->user->school_id, $comment);
				if($comment_id > 0){
					$tActivity = new Table_Activities();
				 $tActivity->createActivity($this->user->user_id, 29, $this->user->school_id , $this->user->school_id,$comment_id);
				 
				}
			}
			$tUser = new Table_UsersInfo();
			$creatorid=$this->user->user_id;
			$creator='<a href="../profile/profile?uid='.$creatorid.'" >'.$tUser->getUserName($creatorid).'</a>';
			$arResult['creator'] = $creator;
		}
		else
			$arResult['error'] = "Please enter comment";
		$this->_helper->json($arResult, true, false);
	}
	
	
	
	public function addnumAction() {
		$this->_helper->viewRenderer->setNoRender(true);
		$arResult = array('error' => '');
		$class=3;
		if($school_id = $this->getRequest()->getParam('school_id', '')){
			if($school_id == '')
				return false;
			else {
				 
				$tPop = new Table_Popularity();
				$tPop->createPopularity(1, $school_id, $class, $this->user->school_id);
				$arResult['url'] = "chat?sid=".$school_id;
			}
			
		}
		else
			$arResult['error'] = "Please enter comment";
		
	
		$this->_helper->json($arResult, true, false);
	
	}
	
	
	
	

}
?>