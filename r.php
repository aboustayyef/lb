<?php 

require_once("init.php");

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
$connection = DB::getInstance();

$connection->insert( 'exit_log', array(
		'exit_time'	=> time(),
		'exit_url'	=> $url,
	));


$query = 'UPDATE posts SET post_visits = post_visits+1 WHERE post_url = "'.$url.'"';
$connection->query($query);

// enter here code to query post record with specified URL, then add +1 to new post_clicks field.

}

?>