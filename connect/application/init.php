<?php
include APPLICATION_PATH. '/env.php';

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH).'/Forms',
    realpath(APPLICATION_PATH . '/../library'),
    realpath(APPLICATION_PATH). '/controllers',
   	realpath(APPLICATION_PATH). '/Obj',
    realpath(APPLICATION_PATH). '/layouts',
    realpath(APPLICATION_PATH),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->setFallbackAutoloader(true);

