<?php
namespace core;

class frontcontroller
{

    private $_Controller = 'home';
    private $_Method = 'default';
    private $_Params = array();

    /**
     * parse url and Extract controller and method and parametars to call them
     */
    public function __construct()
    {
        // call the parse method to parse url
        $this->_parse();
        // put the controller class name
        $controllerClassName = 'controller\\'.$this->_Controller;
        // check if controller not exists and put controller class name not found controller
        if (!class_exists($controllerClassName)) :
            $controllerClassName = 'controller\notFound';
        endif;
        // create object from the controller
        $class = new $controllerClassName();
        // put action name and check if method not exists and put method not found
        $action = $this->_Method;
        if (!method_exists($class ,$action)) :
            $action = 'notFound';
        endif;
        // create object from the reflection class to check how about the params in method
        $reflection = new \ReflectionMethod($class, $action);
        //get number of parameter in method 
        $numOfParams = $reflection->getNumberOfParameters();
        // check if params exists
        if (!empty($this->_Params)) : // if params exists
            // check number of parameter in method > 0 it meaning that method contain params
            // and passing params to method
            if ($numOfParams > 0) :
                call_user_func_array(array($class,$action), $this->_Params);
            endif;
        else : // if params Not exists
            // check number of parameter in method > 0 it meaning that method contain params
            // and It is necessary to have params so we will desplay action not found 
            if ($numOfParams > 0) :
                $action = 'notFound';
            endif;
            // if number of parameter in method < 0 it meaning that method does not contain params
            // so we will call method directly
            $class->$action();
        endif;
        
    }
    /**
     * get url to parse 
     */
    private function _getUrl()
    {
        // trim url from any separator '/'
       $url = trim($_SERVER['REQUEST_URI'], '/');
       return $url ;
    }
    /**
     * parse url and Extract controller and method and parametars to call them
     */
    private function _parse()
    {
        $url = $this->_getUrl();
        // if not empty >>> explode url to Extract controller and method and params
        if (!empty($url)) :
            $url = explode('/',$url);
        endif;
        // check if array url not empty and extract 
        if (!empty($url)) :
            // check if controller not empty get name
            if (!empty($url[0])) {
                $this->_Controller = $url[0];
                // remove the controller from array url
                unset($url[0]);
            }
            // check if method not empty get name
            if (!empty($url[1])) {
                $this->_Method = $url[1];
                // remove the method from array url
                unset($url[1]);
            }

        endif;
            // check if params not empty and get value in the form of array
            $this->_Params = !empty($url) ? array_values($url) : null;
    }
}



?>