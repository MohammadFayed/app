<?php
function autoload($class) 
{
    // trim class name from the separation mark '\'
    $className = ltrim($class, '\\');
    $nameSpace = '';
    $fileName = '';
    if($lastNsPos = strrpos($className, '\\')) : // check if namespace exists
        // Get the name space to covert directories name
        $nameSpace = substr($className, 0, $lastNsPos);
        // Get the class name to include the file which class is exists in
        $className = substr($className, $lastNsPos + 1);
        // set file name to include the file of class
        $fileName = APP_PATH.$nameSpace .DS. $className.".php";
    endif;
    //check if file class exists
    if(file_exists($fileName)) :
        // include to the file of class 
        require_once $fileName;
    endif;
}
/**
 * This function when you instanciate a new object,
 * it goes to execute a function inside it (autoload function) in order
 * to search for the required class
 */
spl_autoload_register('autoload');
?>