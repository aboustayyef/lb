<?php 

// populate_posts2.php

echo "<!-- Memory used before process: ", memory_get_usage(), " -->";
require "simplepie.php";
require "config.php";
require "functions.php"; // functions here will eventually be merged in the functions.php file

$posts = get_posts_from_database_feeds(0, 5);
echo "<pre>", print_r($posts,true), "</pre>";
echo "<br/><!-- Memory used after process: ", memory_get_usage(), " -->";

?>