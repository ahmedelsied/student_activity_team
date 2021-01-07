<?php
if(!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
define('APP_PATH', realpath(dirname(__FILE__)) . DS );
define('TEMPENG' , APP_PATH.'template' . DS);
define('CSS',DS .'css' . DS);
define('JS',DS .'js' . DS);
define('IMG',DS .'images' . DS);