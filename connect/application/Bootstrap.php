<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initConfig() 
	{
		Zend_Registry::set('memcached-settings', $this->getOption("memcached"));
		
		$arURLSettings = $this->getOption('url');
		if (isset($arURLSettings['base'])) define('INI_BASE_URL', $arURLSettings['base']);
		else define('INI_BASE_URL', 'error');
		
		define("HTTP_HOST", INI_BASE_URL);		
	} 
	
   	protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_TRANSITIONAL');
    }
}

