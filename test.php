<?php
		include_once("includes/config.php");
		require("classes/Database.php");

		$db = new Database;
		$db->query("SELECT blog_id FROM blogs");
		
		echo "Rows: ", $db->numRows();
		
		$rows = $db->results();
		
		foreach ($rows as $row) {
			echo $row['blog_id']
		}

?>