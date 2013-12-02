<?php 


session_start();

//dependencies

include_once("config.php");
include_once("includes_new/connection.php");

// auto load classes
function my_autoloader($class) {
	include 'classes/' . $class . '.php';
}
spl_autoload_register('my_autoloader');

?>