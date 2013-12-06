<?php 

	$db = new PDO('mysql:dbname='.LBDB_DBASE.';dbhost='.LBDB_HOST . '', LBDB_USER, LBDB_PASS);
	//make sure everything is in utf8 for arabic
	$db->query("SET NAMES 'utf8'");
    $db->query("SET CHARACTER SET utf8");
    $db->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");

?>