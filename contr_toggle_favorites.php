<?php 
require_once('init.php');

if (Users::userSignedIn()) {
	$user_id = $_POST['user'];
	$blog_id = $_POST['blog'];
	Posts::toggleFavorite($user_id, $blog_id);
}
?>