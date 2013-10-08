<?php 
//echo '<pre>',var_dump($_SERVER),'</pre>';

/*******************************************************************
*	Database Configuration and functions file
*
********************************************************************/ 

define('ABSPATH', dirname(__FILE__).'/');

// Find web root of app
$url = 'http://'.$_SERVER['HTTP_HOST']; // example: http://localhost or http://lebaneseblogs.com
$self = explode('/', $_SERVER['PHP_SELF']);
array_pop($self); // removes last item from the array, which is config.php in this case
$root_directory = implode('/', $self); 
$url = $url . $root_directory . '/';

define('WEBPATH', $url); 
define('LBDB_USER', 'mustapha');
define('LBDB_PASS', 'mm000741');
define('LBDB_HOST', 'localhost');
define('LBDB_DBASE', 'lebanese_blogs');


$channel_descriptions = array(
        "fashion"   => "Fashion &amp; Style",
        "society"   => "Society &amp; Fun News",
        "media"     => "Music, TV &amp; Film",
        "tech"      => "Business &amp Tech",
        "politics"  => "Politics &amp; Current Affairs",
        "design"    => "Advertising &amp; Design",
        "food"      => "Food &amp; Health"
);

/**
*   Environment
*/ 

define('POSTS_PER_REFRESH', 14); // posts added for infinite scrolling. reduce if loading is slow


/* for online use

$db_username = "beirut7_lbblogs";
$db_password = "mm000741";
$db_host ="localhost";
$db_database="beirut7_lebanese_blogs_database";

*/

 ?>