<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
include APPLICATION_PATH. '/init.php';


$config = new Zend_Config_Ini('../application/configs/application.ini', null, array('allowModifications' => true));

$config->{APPLICATION_ENV}->bootstrap->path = APPLICATION_PATH . "/Bootstrap.php";
$config->{APPLICATION_ENV}->resources->frontController->controllerDirectory = APPLICATION_PATH . "/controllers";
$config->{APPLICATION_ENV}->resources->frontController->moduleDirectory = APPLICATION_PATH . "/modules";
$config->{APPLICATION_ENV}->resources->layout->layoutPath = APPLICATION_PATH . "/layouts/scripts/";
$config->{APPLICATION_ENV}->resources->view->helperPath =  APPLICATION_PATH . "/modules/default/views/helpers";

$zconfig = $config->toArray();

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    $zconfig[APPLICATION_ENV]
);
$application->bootstrap()
            ->run();