<?php
class Zend_View_Helper_SchoolMenu {
	
   	public $view;
   	    
   	public function setView(Zend_View_Interface $view)    
   	{        
   		$this->view = $view;    
   	}
    	
   	public function schoolMenu($schools) 
   	{	
   		$this->view->schools = $schools;   		
 
		$this->view->setScriptPath(APPLICATION_PATH.'/layouts/helpers/school-menu/');		
		$sHTML = $this->view->render('school-menu.phtml');		
		return $sHTML;
	}
	
}

?>