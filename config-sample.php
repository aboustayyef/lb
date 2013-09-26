<?php 
/*******************************************************************
*	Database Configuration and functions file
*
********************************************************************/ 

define('ABSPATH', dirname(__FILE__).'/');

define('LBDB_USER', '');
define('LBDB_PASS', '');
define('LBDB_HOST', '');
define('LBDB_DBASE', '');


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

define('POSTS_PER_REFRESH', 10); // posts added for infinite scrolling. reduce if loading is slow


/* for online use

$db_username = "beirut7_lbblogs";
$db_password = "mm000741";
$db_host ="localhost";
$db_database="beirut7_lebanese_blogs_database";

*/

 ?>