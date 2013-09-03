<?php 

if (!isset($_GET['feed'])) {
	die("Please add a feed parameter to this script: ?feed=xxxxxxx ");
}

ini_set('max_execution_time', 0);
ini_set("memory_limit","256M"); 
error_reporting(E_ALL);
ini_set('display_errors', '1');

/************************************************************************************************
*	This script shows how LEbanese Blogs' Parser sees posts 							 		*
*																								*
************************************************************************************************/ 

require_once("includes/simplepie.php");
require_once("includes/core-functions.php");
require_once("includes/simple_html_dom.php");



echo "--------------------------------------------------\n";
echo date('d M Y , H:i:s');
echo "\n--------------------------------------------------\n","<br>";


$maxitems = 0;

$workingfeed = $_GET['feed'];
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
		$domain = get_domain($blog_post_link); //get_domain() is a function from functions.php. It fetches the url's domain. Example: beirutspring
		$blog_post_timestamp =  strtotime($item->get_date()); // get post's timestamp;	

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

		$date_published = new datetime();
		$date_published->setTimestamp($blog_post_timestamp);
		echo "<strong>Post published </strong>:", $date_published->format("d M Y , H:i:s"), "<br>";

		echo "
		<strong>Post title</strong> : $blog_post_title <br>
		<strong>Post link</strong> : $blog_post_link <br>
		<strong>Post image</strong> : $blog_post_image <br>
		<strong>Post excerpt</strong> : $blog_post_excerpt <br>
		<strong>Post content</strong> : $blog_post_content <br>
		";

		echo "<hr>";

	}
?>