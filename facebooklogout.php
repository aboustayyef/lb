<?php 
require 'init.php';

/*echo 'Session Before:';
echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/

session_unset();
session_destroy();

/*echo 'Session After:';
echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/

header("Location: " . $_SERVER['HTTP_REFERER']);  

/*['user']->$_facebook->destroySession();  // to destroy facebook sesssion*/
?>