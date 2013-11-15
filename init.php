<?php 


session_start();

//dependencies

include_once("config.php");
include_once("includes_new/connection.php");
/*
include_once("classes/DB.php");
include_once("classes/Posts.php");
include_once("classes/View.php"); 
include_once('classes/Image.php');
include_once('classes/Lb_functions.php');
include_once('classes/Extras.php');
include_once('classes/Users.php');*/

// auto load classes
function my_autoloader($class) {
	include 'classes/' . $class . '.php';
}
spl_autoload_register('my_autoloader');

?>