<?php
namespace lib;
class frontController
{
    const NOT_FOUND_ACTION = 'notfoundAction';
    const NOT_FOUND_CONTROLLER = 'controllers\notfoundController';
    const INVALID_PARAMS = 'invalidparamsAction';
    public $_controller = 'main';
    public $_action = 'default';
    public $_params = array();
    public function __construct()
    {
        $this->handleurl();
        $this->dispatch();
    }
    //Method To Handle URL
    private function handleurl()
    {
        $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), 3);
        if(isset($url[0]) && $url[0] != '') {
            $this->_controller = $url[0];
        }
        if(isset($url[1]) && $url[1] != '') {
            $this->_action = $url[1];
        }
        if(isset($url[2]) && $url[2] != '') {
            $this->_params = explode('/', $url[2]);
        }
    }
    //Method To Dispatch Controller
    public function dispatch()
    {
        $controllerClassName = 'controllers\\' . $this->_controller . 'Controller';
        $actionName = $this->_action . 'Action';
        $validP = '';
        if(!class_exists($controllerClassName) || !method_exists($controllerClassName, $actionName)) {
            $controllerClassName = self::NOT_FOUND_CONTROLLER;
            $this->_action = $actionName = self::NOT_FOUND_ACTION;
        }
        $controller = new $controllerClassName();
        $controller->$actionName($this->_params);
    }
}