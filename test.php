<?php 
require_once("includes/simplepie.php");
include_once("includes/config.php");
include_once("includes/connection.php");
require_once("includes/core-functions.php");
require_once("includes/simple_html_dom.php");


$stmt = $db->query('SELECT `post_id` FROM `posts` WHERE `blog_id` = "beirutspringd"');
print_r($stmt->rowCount());
if ($stmt->rowCount() > 0) {
	echo 'yey';
} else {
	echo 'ney';
}

?>