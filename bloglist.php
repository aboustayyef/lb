<!DOCTYPE html>
<html>
<head>
  <title>List of blogs</title>
</head>

<body>
  <?php display_list() ?>
</body>

</html>

<?php
	function display_list()
	{
		include_once('config.php');
		global $db_username , $db_password , $db_host , $db_database;
		
		$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host. '', $db_username, $db_password);
		//make sure everything is in utf8 for arabic
		$db->query("SET NAMES 'utf8'");
		$db->query("SET CHARACTER SET utf8");
		$db->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");

		$query = "SELECT * FROM blogs ORDER BY blog_name";

		$stmnt = $db->prepare($query);
		$stmnt->execute();
		$blogs = $stmnt->fetchAll();

		foreach ($blogs as $blog) 
		{
			echo '<div style ="height:10px;float:left;padding:10px 5px;">';
			echo '<a href ="'.$blog['blog_url'].'">',$blog['blog_name'],"</a> ";
			echo '( <a href ="http://twitter.com/'.$blog['blog_author_twitter_username'].'">@'.$blog['blog_author_twitter_username'].'</a> )';
			echo '</div>';
		}

	}

?>
