<?php 

	session_start();
	include "config.php";

	// auto load classes
	function my_autoloader($class) {
    	include 'classes/' . $class . '.php';
	}
	spl_autoload_register('my_autoloader');

?>