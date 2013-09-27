<!-- 


Deprecated, now using includes_new folder


 -->
<?php 
	// connect to database
	global $db_username, $db_password , $db_host , $db_database;
	$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host . '', $db_username, $db_password);

	//make sure everything is in utf8 for arabic
	$db->query("SET NAMES 'utf8'");
    $db->query("SET CHARACTER SET utf8");
    $db->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");

?>