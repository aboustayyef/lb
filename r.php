<?php 

require_once("includes/config.php");
require_once("includes/connection.php");

if (isset($_GET["r"])){
	$target_url = urldecode($_GET["r"]);
}

if (isset($target_url)) {
	register_exit($target_url);
	go_to($target_url);
} else {
	go_to("http://lebaneseblogs.com/?bad_redirect_request");
}

function go_to($url){
	header("Location: $url");
}

function register_exit($url){


//prepare and connect to database
global $db;

$query = 'INSERT INTO exit_log (exit_time, exit_url) VALUES ("'.time().'","'.$url.'") ';
$stmt = $db->prepare($query);
$stmt->execute();

$query = 'UPDATE posts SET post_visits = post_visits+1 WHERE post_url = "'.$url.'"';
$stmt = $db->prepare($query);
$stmt->execute();

// enter here code to query post record with specified URL, then add +1 to new post_clicks field.

}

?>