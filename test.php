<?php 
	require_once("simplepie.php");
    require_once "config.php";
    require_once("functions.php");

	$posts = get_posts_from_database(10,20);
	echo "<pre>",print_r($posts,true),"</pre>";
 ?>