<?php
class DefaultBaseWithoutLayoutController extends DefaultBaseController {
	
	public function postDispatch()
	{
		parent::postDispatch();
		$this->getHelper('layout')->disableLayout();
	}
}
