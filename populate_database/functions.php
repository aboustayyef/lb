<?php 


function get_posts_from_greader($from, $to)

/************************************************************************************
*	uses google reader as source of data
*	Returns an array of associative array with values to be displayed
* 	$posts[0]= array (
		"domain"	=> "name of blog that usually precedes .com or .wordpress ..etc example: beirutspring"
		"url"		=> "http://url-of-the.post",
		"title"		=> "title of the post",
		"timestamp" => "352342345435",
		"image-url"	=> "http://url-of-the-image-if-one-exists-else.null",
		"excerpt"	=> "the short paragraph with a determined maximum letters",
		"content"	=> "the whole post, if published in rss",
		)
*
**************************************************************************************/
{
	$posts = array();
	$howmany = $to-$from;
	$previous_link = ""; // this variable will be used to prevent duplicate posts from showing twice
	$feed = new SimplePie(); // We'll process this feed with all of the default options.
	$feed->set_feed_url("http://www.google.com/reader/public/atom/user%2F06686689690592384436%2Fbundle%2FLebanon%20Blogs%202?n=$to"); // Set which feed to process.
	$feed->set_cache_duration(600); // Set cache to 10 mins
	$feed->strip_htmltags(false);
	$feed->init(); // Run SimplePie. 
	$feed->handle_content_type(); // This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).

	foreach($feed->get_items($from,$to) as $item) 
	{
		$canonical_resource = $item->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10,'link');
		$canonical_url = has_canonical_url($canonical_resource); // will return either 'false' or a canonical url
		$blog_post_timestamp = strtotime($item->get_date());
		$blog_post_link = ($canonical_url)? $canonical_url : $item->get_permalink();
		// $blog_post_link = preg_replace('/\?.*/', '', $blog_post_link); // removes queries at the end of posts
		$blog_post_thumb = get_thumb($blog_post_link);
		$blog_name = get_blog_name($blog_post_link);
		$blog_post_title = clean_up($item->get_title(), 120);
		$temp_content = $item->get_content();
		$blog_post_content = html_entity_decode($temp_content, ENT_COMPAT, 'utf-8');
		$blog_post_image = @dig_suitable_image($blog_post_content) ;
		$blog_post_excerpt = get_blog_post_excerpt($blog_post_content, 120);
		$domain = get_domain($blog_post_link);
		// (to be used later for harvesting links in post) preg_match_all("/((https?:\/\/)|(www.))([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?/", $blog_post_content, $content_links_all);
		if ($item->get_permalink() !== $previous_link ) { //Only go through if not duplicate
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
		}
		$previous_link = $blog_post_link; //used to prevent duplication 
	}
	return $posts;
}
	
function get_domain($theurl)
/*****************************************
*
*	Will extract the domain from the url
*	Example input: "http://www.xyz.com"
*	Example output: "xyz" (string)
*
*******************************************/
{
	$parse = parse_url($theurl);
	$host = $parse['host'];
	$explode = explode(".", $host);
	$domain = $explode[0];
	if ($domain == 'www' || $domain == 'blog') {
		$domain = $explode[1];
	} else {
		$domain = $domain ;
	}
	return $domain;
}
	
function whatsnew(){
?>
<div class ="message hidden-phone">
      <p><strong>Welcome to the new version of the Beirut Dashboard!</strong> Now with inline images &amp; excerpts in blogs, responsive layout, better news, facelift &amp; bug fixes || Questions? Get in touch via <a href="http://twitter.com/beirutspring">twitter</a></p>
</div>
<?php
}

function contains_arabic($string){	
/*******************************************************************
*	returns true if string has arabic characters
*
********************************************************************/ 
	if (preg_match("/([^…^#][٩٨٧٦٥٤٣٢١ةجحخهعغفقثصضكمنتالبيسشورزدذطظەیؤإأءئپ]).+/", $string)){
		return true;
	} else {
		return false;
	}
}

function clean_up($original_string, $length)
/*****************************************
*
*	Will clean up and truncate a string
*	mostly used for post excerpts
*
*******************************************/
{
	$original_string = html_entity_decode($original_string, ENT_COMPAT, 'utf-8');
	$original_string = strip_tags($original_string);
	str_replace(array("\r", "\r\n", "\n"), '', $original_string);
	$original_string = trim($original_string);
	if (strlen($original_string) > $length ) {
		$new_string = substr($original_string,0,$length)."...";
	} else {
		$new_string = $original_string;
	}
	
	return $new_string ;
}


function dig_suitable_image($content) 
/*******************************************************************
*	this function tries to find an image in a blog
*
********************************************************************/ 
{
	// I got the code below from: http://forums.wittysparks.com/topic/simple-way-to-extract-image-src-from-content-with-php
	$contenttograbimagefrom = $content;
	$firstImage = "";
	// old regex // $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $contenttograbimagefrom, $ContentImages);
	$output = preg_match_all('/<img.+src\s*=\s*[\'"]([^\'"]+)[\'"].*>/i', $contenttograbimagefrom, $ContentImages);
	if (isset($ContentImages[1][0]))
	{
		$firstImage = $ContentImages[1][0]; // To grab the first image
		list($width, $height, $type, $attr) = getimagesize("$firstImage");
		if (300 < $width) 
		{
			return $firstImage;
		}
	} 
	elseif (get_youtube_thumb($content)) 
	{
		return get_youtube_thumb($content);
	} 
	else 
	{
		return NULL;
	}
}

function get_youtube_thumb($content)
/*******************************************************************
*	Tries to get youtube content's preview
*
********************************************************************/ 
{
	preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $content, $matches);
	if(isset($matches[2]) && $matches[2] != '')
	{
 		$YoutubeCode = $matches[2];
 		return 'http://img.youtube.com/vi/'.$YoutubeCode.'/0.jpg';
	} 
	else
	{
		return NULL;
	}
}

function get_blog_post_excerpt($content, $length) 
/*******************************************************************
*	Gets blog post excerpt with a length caracter
*
********************************************************************/ 
{

	$sample_paragraph = clean_up($content, $length);
	return $sample_paragraph ;

}

function has_canonical_url ($resource) { // will either return the canonical url or "false"
	$canonical = "no";
	for ($i=0; $i <4 ; $i++) { 
		if (@$resource[$i]['attribs']['']['rel'] == "canonical") {
			$canonical = "yes";
			return $resource[$i]['attribs']['']['href'];
		}
	}
	if ($canonical ="no") {
		return false;
	}
}

function get_thumb($theurl){
	$domain = get_domain($theurl);
	$site = 'images/'.$domain.'.jpg';
	if (file_exists($site)){ 
		return $site;
	}else{
		return "images/noimage.jpg";
	} 
}

?>