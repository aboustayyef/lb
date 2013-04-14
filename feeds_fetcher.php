<?php 

/*******************************************************************
*	This script handles the Cron Job for adding feeds into the database
*
********************************************************************/ 

require_once("simplepie.php");
require_once "config.php";
require_once("functions.php");
require_once("views.php");

$maxitems = 3;

//prepare and connect to database
global $db_username, $db_password , $db_host , $db_database;
$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host. '', $db_username, $db_password );


//error handling
if (!($db)) {
	echo "Error in connection";
	die();
}

// get all feeds
$query = $db->query('SELECT blog_rss_feed FROM blogs');

/*echo "<pre>",print_r($list_of_posts,true),"</pre>"; */

//make sure everything is in utf8 for arabic
$db->query("SET NAMES 'utf8'");
$db->query("SET CHARACTER SET utf8");
$db->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");

$feeds = $query->fetchAll();

// loop through feeds
foreach ($feeds as $feed) 
{	
	$workingfeed = $feed['blog_rss_feed'];
	echo "<b>",$workingfeed,"</b><br/>";

	$sp_feed = new SimplePie(); // We'll process this feed with all of the default options.
	$sp_feed->set_feed_url($workingfeed); // Set which feed to process.
	$sp_feed->set_cache_duration(600); // Set cache to 10 mins
	$sp_feed->strip_htmltags(false);
	$sp_feed->init(); // Run SimplePie. 
	$sp_feed->handle_content_type(); // This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).

	// loop through feed items
	foreach($sp_feed->get_items(0, $maxitems) as $item) 
		{
			// post link
			$blog_post_link = $item->get_permalink();
			$canonical_resource = $item->get_item_tags("http://rssnamespace.org/feedburner/ext/1.0",'origLink');
			if (isset($canonical_resource[0]['data'])) { //resolves feedburner proxies
				$blog_post_link = $canonical_resource[0]['data'];
			}

			echo $blog_post_link,"<br/>";
			$domain = get_domain($blog_post_link); //get_domain() is a function from functions.php. It fetches the url's domain. Example: beirutspring
			$blog_post_timestamp =  strtotime($item->get_date()); // get post's timestamp;	

			// check if this post is in the database
			$query2 = $db->query('SELECT post_url FROM posts WHERE blog_id ="'.$domain.'"', PDO::FETCH_NUM);
			$posts = $query2->fetchAll();
			$list_of_posts = array();
			foreach ($posts as $post) {
				$list_of_posts[] = $post[0]; 
			}

			echo "<pre>",print_r($list_of_posts,true),"</pre>";

			if (in_array($blog_post_link, $list_of_posts)) {
				echo '<span style ="color:blue">post is already in the database</span></br>';
				echo "<hr>";
				break;
				
			} else if ((time()-$blog_post_timestamp) > 2629740) { //post is more than one month old ;
				echo '<span style ="color:red">post is more than one month old</span></br>';
				echo "<hr>";
				break;
			} else {
				$blog_post_title = clean_up($item->get_title(), 120);
				$temp_content = $item->get_content();
				$blog_post_content = html_entity_decode($temp_content, ENT_COMPAT, 'utf-8');
				$blog_post_image = @dig_suitable_image($blog_post_content) ;
				$blog_post_excerpt = get_blog_post_excerpt($blog_post_content, 120);

				$stmt = $db->prepare ('INSERT INTO posts 
					(
					post_url,
		    		post_title,
		    		post_image,
		    		post_excerpt,
		    		blog_id,
		    		post_timestamp,
		    		post_content 
		    		) 
					VALUES
					(
					:url,
					:title,
					:image,
					:excerpt,
					:id,
					:post_timestamp,
					:content

					)');

				  $stmt->execute(array(
				        ':url' => $blog_post_link,
				        ':title' => $blog_post_title,
				        ':image' => $blog_post_image,
				        ':excerpt' => $blog_post_excerpt,
				        ':id'	=> $domain,
				        ':post_timestamp' => $blog_post_timestamp,
				        ':content' => $blog_post_content
				  ));
				
				if ($stmt->rowCount()) {
					Echo "<-- ok --><br/>";
				}
				echo "Timestamp: <em>$blog_post_timestamp</em><br/>";
				echo "Title: <em>$blog_post_title</em><br/>";
				echo "image source: $blog_post_image><br/>";
				echo "Excerpt: <em>$blog_post_excerpt</em><br/>";
				echo "<hr>";

				/*
				$stmt = $pdo->prepare('INSERT INTO table01
				  (
				   Time,
				   variable1,
				   variable2,
				  )

				VALUES
				  (
				    now(),
				    :variable1,
				    :variable2,
				  )');



				*/ 





			}

		}

}




?>