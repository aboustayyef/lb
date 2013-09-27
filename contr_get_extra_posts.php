<?php 
session_start();
/* 	
	This controller is called by javascript (AJAX) to load more posts where infinite scrolling is needed, 
	it fetches extra posts using the posts class (model) then loads a view to display them	
*/

// 	Assets are included because controller is independently called from Javascript and does not carry forward data;
	include_once("config.php"); 
	include_once("includes_new/connection.php");
	include_once("classes/Posts.php");
	include_once("classes/View.php");

// 	prepare class
	$posts = new Posts($db);

// 	data from $.post() 
	$start_from = $_SESSION['posts_displayed']; 
	$channel= $_SESSION['channel'];
//	model
	$data = $posts->get_interval_posts($start_from+1,POSTS_PER_REFRESH, $channel);

// 	load the view
	$viewposts = new View();
	$viewposts->display_posts($data);
?>
