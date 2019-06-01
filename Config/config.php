<?php

define('DEBUG', true);

define('DB_HOST', 'localhost');         //Database Host
define('DB_NAME', 'emlak');              //Database Name
define('DB_USERNAME', 'root');          //Database User
define('DB_PASSWORD', '');              //Database Password

define('DEFAULT_CONTROLLER', 'Home');   //Default Controller(if there is not one defined in the URL
define('DEFAULT_LAYOUT', 'default');    //If no layout set in the controller use this layout.

define('SROOT', '/dinceremlak/');       //Set this to '/' if live server

define('SITE_TITLE', 'MVC');         //Default Site Title is "MVC"

define('CURRENT_USER_SESSION_NAME', 'denemesession');   //session name for logged user
define('REMEMBER_ME_COOKIE_NAME', 'denemerememberme');  //cookie name for logged user in user remember me
define('REMEMBER_ME_COOKIE_EXPIRY', 604800);            //cookie time for logged user in user remember me(30 days)
