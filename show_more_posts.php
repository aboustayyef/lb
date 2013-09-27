<?php

// deprecated, will start using contr_get_extra_posts.php


	/*******************************************************************
	*	This script handles adding items on the page for infinite scrolling effect
	*
	********************************************************************/ 

$start_from = $_POST['start_from'];
if (isset($_POST['channel']) && !(empty($_POST['channel']))) {
    $channel = $_POST['channel'];
}

if ($channel == "null") {
    unset($channel);
}

require_once("includes/config.php");
require_once("includes/connection.php");
require_once("includes/core-functions.php");

$to = $start_from + 15; // change figure if we want
if (isset($channel)) {
    $posts = get_posts_from_database($start_from+1, $to, $channel);
} else {
    $posts = get_posts_from_database($start_from+1, $to);
}
display_blogs($posts);

?>