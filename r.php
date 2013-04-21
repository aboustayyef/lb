<?php 
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

require_once("includes/config.php");

//prepare and connect to database
global $db_username, $db_password , $db_host , $db_database;
$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host. '', $db_username, $db_password );

// enter here code to query post record with specified URL, then add +1 to new post_clicks field.

}

?>