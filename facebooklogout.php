<?php 
require 'config.php';
require 'fbconfig.php';  
$facebook->destroySession();  // to destroy facebook sesssion
header("Location: " .WEBPATH);        // you can enter home page here ( Eg : header("Location: " ."http://demo.krizna.com"); 
?>