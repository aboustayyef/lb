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

// initialize Facebook class using Facebook App credentials
// see: https://developers.facebook.com/docs/php/gettingstarted/#install

// page ID: 625974710801501

$config = array();
$config['appId'] = '1419973148218767';
$config['secret'] = '16a49abb2d49c364d06b72eae7c79c1a';
$config['fileUpload'] = false; // optional

// to avoid monotony, we prepare several possible wordings for the facebook message
$attribution = '"'.$postObject->post_title.'" by '.$postObject->blog_name;
$variety_of_messages = array(
	'A new post made it to the top on Lebanese blogs: '.$attribution.'. Find more top posts at Lebanese Blogs', 
	'The post '.$attribution.' is now the top post on Lebanese Blogs. Find more top posts at Lebanese Blogs ',
	'The latest post to make it to the top of our list is '.$attribution.'. Find more top posts at Lebanese Blogs ');

$messageToShare = $variety_of_messages[rand(0,count($variety_of_messages)-1)];

print_r($page);


$fb = new Facebook($config);

// define your POST parameters (replace with your own values)
$params = array(
  "access_token" => "CAAULdUMXFY8BACTf0C8kyvE8409AHRtDtT93ADiZAjZA0ZCQvEGj3emtjuJ0ZCyhIlBbRfQk0o9tl9KemDnkM7FNyv1Jentz8Uq1dh7CimyRmZCme3nM1ZCrBRgnsXk8vYdmFSHLeFvudI0twlnOfqGobEPnW3M0XDWJwNM64CLKqRlccURMLz", // see: https://developers.facebook.com/docs/facebook-login/access-tokens/
  "message" => $messageToShare,
  "link" => $postObject->post_url,
  //"picture" => "http://i.imgur.com/lHkOsiH.png",
  //"name" => "How to Auto Post on Facebook with PHP",
  //"caption" => "www.pontikis.net",
  //"description" => "Automatically post on Facebook with PHP using Facebook PHP SDK. How to create a Facebook app. Obtain and extend Facebook access tokens. Cron automation."
);

// post to Facebook
// see: https://developers.facebook.com/docs/reference/php/facebook-api/
try {
  $ret = $fb->api('/625974710801501/feed', 'POST', $params);
  echo 'Successfully posted to Facebook';
} catch(Exception $e) {
  echo $e->getMessage();
}

}

/* Step 5: Add post to twitter 
	Reference: http://www.pontikis.net/blog/auto_post_on_twitter_with_php
*/

?>