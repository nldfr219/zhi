<?php
class Zend_View_Helper_SchoolTreeMenu {
	
   	public $view;
   	    
   	public function setView(Zend_View_Interface $view)    
   	{        
   		$this->view = $view;    
   	}
    	
   	public function schoolTreeMenu($states,$user) 
   	{	
    		
 		$output="";
   		$School = new Table_Schools();
   		$Pop = new Table_Popularity();
   		$tUser = new Table_UsersInfo();
   		$class_year = $tUser->getUser($user->user_id)->class_year;
   		
   		//print_r($class_year);die;
   		foreach ($states as $key => $state)
   		{
   				
   			if($schoollist=$School->getSchoolByState($key))
   			{
   				$count=count($schoollist);
   				$output.= "<li class='expandable'><div class='hitarea expandable-hitarea'></div>".$state;
   				$output.= "<ul  class='ulhide' style='display:none;'>";
   				foreach ($schoollist as $num=>$s)
   				{
   					$popnum=$Pop->getPopularity(1, $s["school_id"], $class_year , $user->school_id );
 
   					if(strlen( $s["name"])>30)
   					$name = substr( $s["name"] ,0,30)."...";
   					else $name = $s["name"];
   					$output.= "<li";
   					if($count==$num+1) $output.= " class='last' ";
   					$output.= ">
   							<span class='popularity'   name='".$s["school_id"]."'>". $name ."(".$popnum.")</span>
   		  
   							</li>";
   				}
   		
   				$output.= "	</ul></li>";
   			}
   			else
   			$output.= "<li>".$state."</li>";
   		}
   		
   		
   		
   		$this->view->output = $output;
		$this->view->setScriptPath(APPLICATION_PATH.'/layouts/helpers/school-menu/');		
		$sHTML = $this->view->render('school-tree-menu.phtml');		
		return $sHTML;
	}
	
}

?>