<?php 
require_once('includes/config.php');
require_once('includes/connection.php');
require_once('classes/Blog_Details.php');
global $db;

echo ROOT;

/* 

$blog_at_hand = new Blog_Details($db, "blogbaladi");
$rows = $blog_at_hand->list_Posts(200, 'post_timestamp');
foreach ($rows as $key => $row) {
    echo $row['post_title'], "<br>";
} 
*/



