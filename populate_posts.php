<?php 
	header('Content-Type: text/html; charset=utf-8' );
    require_once("simplepie.php");
    require_once "config.php";
    require_once("functions.php");

    if ($mysqli = mysqli_connect($db_host, $db_username, $db_password, $db_database)){
    	echo "<p>Connection Successful <p>";
    } else {
    	echo "<p>could'nt establish database connection</p>";
    }
    $mysqli->query("SET NAMES 'utf8'");
    $mysqli->query("SET CHARACTER SET utf8");
    $mysqli->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");
    $latestpost = $mysqli->query("SELECT * FROM `posts` ORDER BY `post_timestamp` DESC LIMIT 1");
    $latest_post_details = $latestpost->fetch_array(MYSQLI_ASSOC);
    $latest_post_timestamp = $latest_post_details['post_timestamp'];
    $posts_added_in_this_session = 0;

    $posts = get_posts_from_greader($_GET["from"],$_GET["to"]);
    
    foreach ($posts as $post) {

   	    $blogname = $post['blogname'];
   	    $domain = $post['domain'];
   	    $url =$post['url'];
   	    $title =$post['title'];
   	    $timestamp =$post['timestamp'];
   	    $image_url =$post['image-url'];
   	    $excerpt = $post['excerpt'];
   	    $content =$post['content'];
   	    if ($timestamp > $latest_post_timestamp) { //only add to table posts that were not already there
   	    	$query = "INSERT into posts (
			    		post_url,
			    		post_title,
			    		post_image,
			    		post_excerpt,
			    		blog_id,
			    		post_timestamp,
			    		post_content ) 
					VALUES (
						'$url',
						'$title',
						'$image_url',
						'$excerpt',
						'$domain',
						'$timestamp',
						'$content' )";
			$result = $mysqli->query($query);
			$posts_added_in_this_session++;
		echo $title,"<br/>";
   	    } else {
   	    	break;
   	    }
    	
    }
echo "<p>Done! Posts added: ", $posts_added_in_this_session, "</p>";

/*

	$posts[]= 	array (
				"blogname"	=> $blog_name,
				"domain"	=> $domain,
				"url"		=> $blog_post_link,
				"title"		=> $blog_post_title,
				"timestamp" => $blog_post_timestamp,
				"image-url"	=> $blog_post_image,
				"excerpt"	=> $blog_post_excerpt,
				"content"	=> $blog_post_content,
				"thumb"		=> $blog_post_thumb
				);

*/


?>