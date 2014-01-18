<?php 
	/* testing */

	require_once('init.php');
	require ABSPATH.'classes/twitter/twitter.class.php';  // Include facebook SDK file
	$connection = DB::getInstance();

	/* Step 1: Find which posts is currently the top (we will use the 12 hour time frame) */

	$topPosts = Posts::get_Top_Posts(12, 1);
	$topPost = $topPosts[0];
	
	$status = 'This is just a test. Please ignore.';

	$twitter = new Twitter('JFJmBCbVrLfBFu5u0TDdzg', 'QI8jrDWQdXH6TFb8zSYZ8gzWDW5DpSakBlQ7qdHZYI', "1054796604-YlpZJiKXOrGvQAcU6fuzLvUljubIHToUfBRSUgV", "ydm1xxTU1OmA1Nsq3CStrr3CLcXJOAYpagdV7E1Aco1SJ");
	$twitter->send($status);

?>