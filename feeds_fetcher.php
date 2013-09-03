<?php 

ini_set('max_execution_time', 0);
ini_set("memory_limit","256M"); 
error_reporting(E_ALL);
ini_set('display_errors', '1');

/************************************************************************************************
*	This script handles the Cron Job for adding feeds for Lebanese Blogs into the database 		*
*																								*
************************************************************************************************/ 

require_once("includes/simplepie.php");
include_once("includes/config.php");
include_once("includes/connection.php");
require_once("includes/core-functions.php");
require_once("includes/simple_html_dom.php");

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
$query = $db->query('SELECT blog_rss_feed FROM blogs');
$feeds = $query->fetchAll();

// loop through feeds
foreach ($feeds as $feed) 
{	
	$workingfeed = $feed['blog_rss_feed'];
	echo "<b>",$workingfeed,"</b><br/>";

	$sp_feed = new SimplePie(); // We'll process this feed with all of the default options.
	$sp_feed->set_feed_url($workingfeed); // Set which feed to process.
	$sp_feed->set_cache_location('cache');
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
			$blog_post_link = urldecode($blog_post_link);
			echo $blog_post_link,"<br/>\n";
			$domain = get_domain($blog_post_link); //get_domain() is a function from functions.php. It fetches the url's domain. Example: beirutspring
			$blog_post_timestamp =  strtotime($item->get_date()); // get post's timestamp;	

			// check if this post is in the database
			$query2 = $db->query('SELECT post_url FROM posts WHERE blog_id ="'.$domain.'"', PDO::FETCH_NUM);
			$posts = $query2->fetchAll();
			$list_of_posts = array();
			foreach ($posts as $post) {
				$list_of_posts[] = preg_replace('#\bhttp(s?):\/\/#', '', $post[0]); // removes the http:// or https:// from post slug
			}

			//echo "<pre>",print_r($list_of_posts,true),"</pre>";

			if (in_array(preg_replace('#\bhttp(s?):\/\/#', '', $blog_post_link), $list_of_posts)) {
				echo '<span style ="color:blue">post is already in the database</span>',"\n";
				echo "<hr>";
				break;
				
			} else if ((time()-$blog_post_timestamp) > (2629740*12)) { //post is more than 3 month old ;
				echo '<span style ="color:red">post is more than one year old</span>',"\n";
				echo "<hr>";
				break;
			} else {
				$blog_post_title = clean_up($item->get_title(), 120);
				$temp_content = $item->get_content();
				$blog_post_content = html_entity_decode($temp_content, ENT_COMPAT, 'utf-8');
				
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




?>