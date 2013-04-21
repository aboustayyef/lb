<?php
		include_once("includes/config.php");
  		global $db_username, $db_password , $db_host , $db_database;
		$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host. '', $db_username, $db_password );

		//make sure everything is in utf8 for arabic
		$db->query("SET NAMES 'utf8'");
		$db->query("SET CHARACTER SET utf8");
		$db->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");	

		$stmt = $db->query("SELECT * FROM blogs ORDER BY blog_name",PDO::FETCH_ASSOC);
		$rows = $stmt->fetchAll();
		foreach ($rows as $row) {
		 	echo $row['blog_name'],"<br/>";
		 } ;
?>