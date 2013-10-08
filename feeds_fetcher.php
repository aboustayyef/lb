<?php 

ini_set('max_execution_time', 0);
ini_set("memory_limit","256M"); 
error_reporting(E_ALL);
ini_set('display_errors', '1');

/************************************************************************************************
*	This script handles the Cron Job for adding feeds for Lebanese Blogs into the database 		*
*																								*
************************************************************************************************/ 

include_once("config.php");
include_once("includes_new/connection.php");

require_once("includes_new/simplepie.php");
require_once("includes_new/simple_html_dom.php");
require_once("feeds_fetcher_functions.php");

echo "--------------------------------------------------\n";
echo date('d M Y , H:i:s');
echo "\n--------------------------------------------------\n","<br>";


$maxitems = 0;

//prepare and connect to database
global $db;

//error handling
if (!($db)) {
	echo "Error in connection";
	die();
}

// get all feeds
$query = $db->query('SELECT `blog_rss_feed` , `blog_active` FROM `blogs`');
$feeds = $query->fetchAll();

// loop through feeds
foreach ($feeds as $feed) 
{	
	if ($feed['blog_active'] == 1) { // ignore blog if it's marked as inactive
	$workingfeed = $feed['blog_rss_feed'];
	echo "<b>",$workingfeed,"</b><br/>";

	$sp_feed = new SimplePie(); // We'll process this feed with all of the default options.
	$sp_feed->set_feed_url($workingfeed); // Set which feed to process.
	$sp_feed->set_cache_location(ABSPATH.'cache');
	$sp_feed->set_cache_duration(600); // Set cache to 10 mins
	$sp_feed->strip_htmltags(false);
	$sp_feed->init(); // Run SimplePie. 
	$sp_feed->handle_content_type(); // This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).

	// loop through feed items
	foreach($sp_feed->get_items(0, $maxitems) as $item) 
		{
			// post link
			$blog_post_link = $item->get_permalink();

			//resolves feedburner proxies
			$canonical_resource = $item->get_item_tags("http://rssnamespace.org/feedburner/ext/1.0",'origLink');
			if (isset($canonical_resource[0]['data'])) { 
				$blog_post_link = $canonical_resource[0]['data'];
			}
			$blog_post_link = urldecode($blog_post_link);
			echo $blog_post_link,"<br/>\n";

			// get blogid , example: beirutspring.com -> beirutspring
			$domain = get_domain($blog_post_link);

			// get timestamp
			$blog_post_timestamp =  strtotime($item->get_date()); // get post's timestamp;	

			// check if this post is in the database
			
			//first, get the path
			$post_path_parts = parse_url($blog_post_link);
			$post_path = $post_path_parts['path']; // result example: "/a-new-10000-lebanese-lira-bill/"
			if (@$post_path_parts['query']) { // has a query (example: ?pagewanted=.....)
				$post_path = $post_path.'?'.$post_path_parts['query'];
			}
			if (@$post_path_parts['fragment']) { // has a fragment (example: #utm=.....)
				$post_path = $post_path.'#'.$post_path_parts['fragment'];
			}
			echo '<!-- The post path is: '.$post_path.' -->';
			// now check if this particular post is in database. we use a combination of $domain and $post_path and timestamp
			$query2 = $db->query('SELECT `post_id` FROM `posts` WHERE `blog_id` = "' . $domain . '" AND `post_url` LIKE "%' . $post_path  . '" ', PDO::FETCH_NUM);

			if ($query2->rowCount() > 0) { // post exist in database
				echo '<span style ="color:blue">post is already in the database</span><br>',"\n";
				continue;
			} else if ((time()-$blog_post_timestamp) > (3*30*24*60*60)) { //post is more than 3 month old ;
				echo '<span style ="color:blue">post is older than three months</span><br>',"\n";
				continue;
			} else { // ok, new post, insert in database

				$blog_post_title = clean_up($item->get_title(), 120);
				$temp_content = $item->get_content();
				$blog_post_content = html_entity_decode($temp_content, ENT_COMPAT, 'utf-8'); // for arabic
				
				$blog_post_image = dig_suitable_image($blog_post_content) ;
				$blog_post_excerpt = get_blog_post_excerpt($blog_post_content, 120);

				// added image dimensions for lazy loading

				if ($blog_post_image) {
					list($width, $height, $type, $attr) = getimagesize($blog_post_image);
					$blog_post_image_width = $width;
					$blog_post_image_height = $height;
				}	else {
					$blog_post_image_width = 0;
					$blog_post_image_height = 0;
				}

				$stmt = $db->prepare ('INSERT INTO posts 
					(
					post_url,
		    		post_title,
		    		post_image,
		    		post_excerpt,
		    		blog_id,
		    		post_timestamp,
		    		post_content,
		    		post_image_width,
		    		post_image_height
		    		) 
					VALUES
					(
					:url,
					:title,
					:image,
					:excerpt,
					:id,
					:post_timestamp,
					:content,
					:img_width,
					:img_height

					)');

				  $stmt->execute(array(
				        ':url'				=> $blog_post_link,
				        ':title'			=> $blog_post_title,
				        ':image'			=> $blog_post_image,
				        ':excerpt'			=> $blog_post_excerpt,
				        ':id'				=> $domain,
				        ':post_timestamp'	=> $blog_post_timestamp,
				        ':content'			=> $blog_post_content,
				        ':img_width'		=> $blog_post_image_width,
				        ':img_height'		=> $blog_post_image_height
				  ));
				  var_dump($stmt->errorInfo());
				
				if ($stmt->rowCount()) {
					echo "POST ADDED:  <em>$blog_post_title</em><br/><hr>\n";
				}

			}

		}
	}
}




?>