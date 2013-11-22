<?php 
require_once('init.php');

if (Users::userSignedIn()) {
	$user_id = $_POST['user'];
	$post_url = $_POST['url'];
	Posts::toggleSaved($user_id, $post_url);
}
?>