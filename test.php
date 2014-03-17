<?php 
	/* testing */

	require_once('init.php');
	$posts = Posts::get_latest_posts(20, 'columnists');
	echo '<pre>';
	print_r($posts);
	echo '</pre>'


?>