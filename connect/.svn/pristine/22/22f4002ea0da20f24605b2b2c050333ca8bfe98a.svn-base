<?php

class IndexController extends DefaultBaseController
{
	
    public function indexAction(){
		$this->view->schools = SchoolList::load();
    	$this->view->min_year = date("Y")-10;
    	$this->view->max_year = date("Y")+4;    	
	}
	
	public function postDispatch()
	{
		$this->_helper->layout()->setLayout('default');		
	}

}