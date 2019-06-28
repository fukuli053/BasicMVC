<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

//load configrutaion and helper function
require_once(ROOT . DS . 'Config' . DS . 'config.php');

//Autoload classes
function autoload($className) {
    if(file_exists(ROOT . DS . 'Core' . DS . $className . '.php')) {
      require_once(ROOT . DS . 'Core' . DS . $className . '.php');
    } elseif (file_exists(ROOT . DS . 'App' . DS . 'Controllers' . DS . $className . '.php')) {
      require_once(ROOT . DS . 'App' . DS . 'Controllers' . DS . $className . '.php');
    } elseif (file_exists(ROOT . DS . 'App' . DS . 'Models' . DS . $className . '.php')) {
      require_once(ROOT . DS . 'App' . DS . 'Models' . DS . $className . '.php');
    } elseif (file_exists(ROOT . DS . 'Core'. DS . 'Validators'. DS . $className . '.php')){
      require_once(ROOT . DS . 'Core'. DS . 'Validators'. DS . $className . '.php');
    }
  }
// function autoload($className){
//     $classArray = explode('\\',$className);
//     $class = array_pop($classArray);
//     $subPath = strtolower(implode(DS,$classArray));
//     $path = ROOT . DS . $subPath . DS . $class . '.php';
//     if(file_exists($path)){
//         require_once($path);
//     }
// }

spl_autoload_register('autoload');
session_start();

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

if (!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
    Users::loginUserFromCookie();
}

//Route the request
Router::route($url);
