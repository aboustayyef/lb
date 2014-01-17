<?php 

/*This script checks the top post, and if it's new, publishes it to twitter and facebook*/

require_once('init.php');
require ABSPATH.'classes/facebook/src/facebook.php';  // Include facebook SDK file

$connection = DB::getInstance();

/* Step 1: Find which posts is currently the top (we will use the 12 hour time frame) */

$topPosts = Posts::get_Top_Posts(12, 1);
$topPost = $topPosts[0];

/* Step 2: Is the post already in the database?*/
$results = $connection->query('SELECT * FROM top_posts WHERE top_post_url = "'.$topPost->post_url.'"')->results();
echo count($results);
if (count($results) > 0) { // post already exists
	# do nothing
}else{ //new post
	// add post to database
	add_post_to_db($topPost->post_url);

	// add post to facebook
	add_post_to_facebook($topPost);

	// add post to twitter
//	add_post_to_twitter($topPost);
}


function add_post_to_db($url){
	$connection = DB::getInstance();
	$connection->insert('top_posts', array(
		'top_post_url'				=>	$url,
		'top_post_timestamp_added'	=> time()
	));
}

function add_post_to_facebook($postObject){
/*
	Reference: http://www.pontikis.net/blog/auto_post_on_facebook_with_php
	postObject has the following attributes: post_image , post_timestamp , post_image_width , post_image_height , post_url , post_title , blog_name , blog_id , col_name
*/


}

/* Step 4: Add post to facebook 
	page ID: 625974710801501
*/

/* Step 5: Add post to twitter 
	Reference: http://www.pontikis.net/blog/auto_post_on_twitter_with_php
*/

?>