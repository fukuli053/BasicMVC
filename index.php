<?php

use Core\Session;
use Core\Cookie;
use Core\Users;
use Core\Router;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

//load configrutaion and helper function
require_once(ROOT . DS . 'Config' . DS . 'config.php');

//Autoload classes
function autoload($className){
  $classAry = explode('\\',$className);
  $class = array_pop($classAry);
  $subPath = strtolower(implode(DS,$classAry));
  $path = ROOT . DS . $subPath . DS . $class . '.php';
  if(file_exists($path)){
    require_once($path);
  }
}

spl_autoload_register('autoload');
session_start();

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

if (!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
    Users::loginUserFromCookie();
}

//Route the request
Router::route($url);
