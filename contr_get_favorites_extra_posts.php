<?php 
/* 	
	This controller is called by javascript (AJAX) to load more posts where infinite scrolling is needed, 
	it fetches extra posts using the posts class (model) then loads a view to display them	
*/

// 	Assets are included because controller is independently called from Javascript and does not carry forward data;
	include_once("init.php"); 

// 	data from $.post() 
	$start_from = $_SESSION['posts_displayed']; 
	$channel= $_SESSION['channel'];
//	model
	
	if ($_SESSION['viewtype'] =='compact') {
		$posts_per_refresh = 50;
	} else {
		$posts_per_refresh = 20;
	}

	$data = Posts::get_favorite_bloggers_posts($_SESSION['LebaneseBlogs_Facebook_User_ID'], $_SESSION['posts_displayed'], $posts_per_refresh);

// 	load the view
	$viewposts = new View();
	$viewposts->display_posts($data);
?>