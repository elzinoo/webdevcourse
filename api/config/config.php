<?php

/**
 * Config
 *
 * @author Elli Motazedi W19039439
 */
 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	 
include 'config/exceptionhandler.php';
set_exception_handler('GeneralExceptionHandler::exceptionHandler');
	 
include 'config/errorhandler.php';
set_error_handler('GeneralErrorHandler::errorHandler');
	 
include 'config/autoloader.php';
spl_autoload_register('Autoload::autoloader');

?>