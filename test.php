<?php

//prepare
include_once("includes/config.php");
require("includes/core.php");
require("includes/functions.php");

//connect to database
global $db_username, $db_password , $db_host , $db_database;
$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host . '', $db_username, $db_password);

//Find a conversation that is less than 24 hours old

$last24hours = time()-(24*60*60);

$query = "SELECT conv_id FROM conversations WHERE conv_start > $last24hours";
$stmt = $db->query($query, PDO::FETCH_ASSOC);
$posts = $stmt->fetchALL();

$conversation_id = $posts[0]['conv_id'];

$query = "SELECT * FROM posts_in_conversations WHERE conversation_id = '$conversation_id' ORDER BY contribution_kind";
$stmt = $db->query($query, PDO::FETCH_ASSOC);
$posts= $stmt->fetchALL();

$contribution_title ="";
foreach ($posts as $post) 
{

	if ($post['contribution_kind'] <> $contribution_title) 
	{	
		// if contribution title has changed, draw new header
		$contribution_title = $post['contribution_kind'];
		echo "<h2>$contribution_title</h2>";		
	}
	$domain = get_domain($post['post_url']);
	echo '<img src ="img/thumbs/'.$domain.'.jpg" width ="50">';
	echo $post['post_url'], "<br/>";
}

?>