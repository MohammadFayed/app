<?php 


// Short name DIRECTORY_SEPARATOR
define("DS", DIRECTORY_SEPARATOR);
// define path to app folder  
define("APP_PATH", 'app' . DS);
// define path to core folder  
define("CORE", 'app' . DS . 'core' . DS);
// include to autoload function to automaticlly include the file of class 
require_once CORE . 'autoload.php';
// instanciate front controller to redirect to call controler and call method
$route = new core\frontcontroller();
?>