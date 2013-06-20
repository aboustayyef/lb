<?php 


function display_blogs($posts){
	foreach ($posts as $key => $post) 
	{
		draw_blog_entry($key, $post);
		mapkeys($key);
	}
	;?>
	<!-- Lazy load images -->
	<script>
		$(".blogentry").css("display","block");
		$("img.lazy").lazyload({ 
	   		effect : "fadeIn",
	   		threshold : 500
		});
		$("img.lazy").removeClass("lazy");
	</script>

	<?php
}

function draw_blog_entry($key, $post){ 

	$target_url = "http://lebaneseblogs.com/r.php?r=".urlencode($post['url']);
	;?>
	
	<div id="<?php echo 'post-',$key; ?>" class="blogentry<?php if (contains_arabic($post['title'])) {echo " rtl";} ?>" style ="opacity:0;">
	<div class="post_info">
		<a href ="<?php echo 'blogger/?id=' . $post['domain'] ?>"><img class ="blog_thumb" src="<?php echo $post['thumb'];?>" width ="50" height ="50"></a>
		<div class="post_details">
			<div class="blog_name"><a href ="<?php echo 'blogger/?id=' . $post['domain'] ?>"><?php echo $post['blogname']; ?></a></div>
			<div class="post_title"><a href="<?php echo $target_url ;?>"><?php echo $post['title']; ?></a></div>
		</div>
	</div>
	<?php 

		if (isset($post['image-url'])) {
			$image_width = 278;
			$image_height = intval(($image_width / $post['img_width'])*$post['img_height']);
			;?>
			
			<a href="<?php echo $target_url ;?>"><img class="lazy" data-original="<?php echo $post['image-url'] ; ?>" src="img/interface/grey.gif" width="<?php echo $image_width ; ?>" height="<? echo $image_height ; ?>"></a>
			
			<?php
		} else {
			;?>
			
			<div class ="excerpt"><blockquote><?php echo $post['excerpt']; ?></blockquote>	</div>
			
			<?php
		}

	?>
	<div class="shareicon"><img src ="img/interface/icon-share-48.png" width ="24px"></div>
	<?php

	sharing_tools($post['title'],$post['twitter'],$post['url'], $post['visits'], $post['domain']);
	echo "</div>";
}


/*******************************************************************
*	This function adds extra widgets to the display
*
********************************************************************/ 
function mapkeys($key){
	if ($key == 12) {
		show_tip(1);
	} elseif ($key == 26) {
		show_tip(2);
	} elseif (($key > 30 ) && ($key%25 == 0)) {
		follow_our_bloggers(5);
	}
}


function get_posts_from_database($from,$to, $tag = NULL){
/************************************************************************************
*	uses database as source of data. Make sure database is up to date before using
*	Returns an array of associative array with values to be displayed
* 	$posts[]	= array (
		"domain"	=> $rows['blog_id'],
		"url"		=> $rows['post_url'],
		"title"		=> $rows['post_title'],
		"timestamp" => $rows['post_timestamp'],
		"image-url"	=> $rows['post_image'],
		"excerpt"	=> $rows['post_excerpt'],
		"content"	=> $rows['post_content'],
		"blogname"	=> $blogname,
		"thumb"		=> $thumbimage,
		"description" => $blogdescription,
		"twitter" => $blogtwitter,
		"img_width"	=> $blog_image_width,
		"img_height" => $blog_image_height,
		);
*
**************************************************************************************/
	global $db;

	$posts = array();
	$amountOfRecords = $to-$from;
	
	if (isset($tag)) {
		$query = "SELECT * FROM `posts` INNER JOIN `blogs` ON posts.blog_id = blogs.blog_id WHERE blogs.blog_tags LIKE '%".trim($tag)."%' ORDER BY `post_timestamp` DESC LIMIT $to";
	} else {
		$query = "SELECT * FROM `posts` ORDER BY `post_timestamp` DESC LIMIT $to";
	}

	$stmt = $db->query($query);
	$rows = $stmt->fetchAll();	

	foreach ($rows as $row) {

		$url = $row['post_url'];
		$blog_details = get_blog_details($url);
		$blogname = $blog_details['name']; 
		$blogtwitter = $blog_details['twitter'];
		$blogdescription = $blog_details['description'];
		$thumbimage = get_thumb($url);
		
		//the section below is temporary. Figures will have to be in post database
		if (isset($row['post_image'])) {
			$blog_image_width = $row['post_image_width'];
			$blog_image_height = $row['post_image_height'];
		} else {
			$blog_image_height = NULL;
			$blog_image_width = NULL;
		}
		// /////////////////////////////////////////////////////////////////////// //

		$posts[]	= array (
		"domain"	=> $row['blog_id'],
		"url"		=> $row['post_url'],
		"title"		=> $row['post_title'],
		"timestamp" => $row['post_timestamp'],
		"image-url"	=> $row['post_image'],
		"excerpt"	=> $row['post_excerpt'],
		"content"	=> $row['post_content'],
		"blogname"	=> $blogname,
		"thumb"		=> $thumbimage,
		"description" => $blogdescription,
		"twitter" => $blogtwitter,
		"img_width"	=> $blog_image_width,
		"img_height" => $blog_image_height,
		"visits" => $row['post_visits']
		);
	};
	$newposts = array_slice($posts, -$amountOfRecords, $amountOfRecords, true);
	return $newposts;
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
	
function contains_arabic($string){	
/*******************************************************************
*	returns true if string has arabic characters
*
********************************************************************/ 
	if (preg_match("/([ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz]).+/", $string)){
		return false;
	} else {
		return true;
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
		$new_string = mb_substr($original_string,0,$length)."...";
	} else {
		$new_string = $original_string;
	}
	
	return $new_string ;
}

function get_blog_details($blog_post_link){

	global $db;
	$domain = get_domain($blog_post_link);	
	$name_query = "SELECT * FROM blogs WHERE blog_id = '$domain'";
	$stmnt = $db->query($name_query);

	$details = array();

	$result = $stmnt->fetch();
	if ($result['blog_id']) {
		$details = array(
			'name' => $result['blog_name'],
			'description' => $result['blog_description'],
			'twitter' => $result['blog_author_twitter_username']
			);
		return $details;
	} else {
		$details = array(
			'name' => 'New blog',
			'description' => 'blog recently added to lebaneseblogs.com',
			'twitter' => null
			);
	}
}


function get_blog_name($blog_post_link){

	global $db;

	// find blog's name, or use "random blog"		
	$domain = get_domain ($blog_post_link); // output example "beirutspring"

	$name_query = "SELECT blog_name FROM blogs WHERE blog_id = '$domain'";
	$stmnt = $db->query($name_query,PDO::FETCH_NUM);

	$result = $stmnt->fetch();
	if ($result[0]) {
		return $result[0];
	} else {
		return "Random Blog";
	}
}

function dig_suitable_image($content)
/*******************************************************************
*	This functions uses the PHP DOM Parser to extract images
*
********************************************************************/ 
{
$firstImage ="";
$html = str_get_html($content);
foreach ($html->find('img[src]') as $img) 
	{
	    $image = $img->getAttribute('src');
    	list($width, $height, $type, $attr) = getimagesize("$image");
    	if ($width>299) //only return images 300 px large or wider
    	{ 
    		$firstImage = $img->getAttribute('src');
    		break;
    	}
    }
if ($firstImage) 
	{
	return $firstImage;
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

function dig_suitable_image_old($content) 
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
	for ($i=0; $i < 4 ; $i++) { 
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
	$site = 'img/thumbs/'.$domain.'.jpg';
	if (file_exists($site)){ 
		return $site;
	}else{
		return "img/thumbs/noimage.jpg";
	} 
}

function admin_logged_in()
{
	if (isset($_COOKIE["logged_in"]))
	{
		if ($_COOKIE["logged_in"] == "yes")
    	{
    		return TRUE ;
    	} else {
    		return FALSE ;
    	}
    }
}

function center_item($to_be_centered){

	echo '<table style="width: 100%;"><tr>';
	echo '<td style="text-align: center; vertical-align: middle;">';
	echo $to_be_centered;
	echo "</td> </tr> </table>";

}

function top_5_posts($nb_hours,$channel=NULL){
global $channel_descriptions;
?>
<div id ="special1" class ="blogentry special" style="opacity:0 ; background: white url('css/top_bkg_<?php if (isset($channel)) {echo $channel; } ?>.gif') repeat-x">
	<div class = "wrapper_special">
		<img src ="img/interface/up.png" width ="35px" style ="border:none">
		<?php if (isset($channel)) {
			echo "<h2>Top posts in {$channel_descriptions[$channel]}</h2>";
		} else {
			echo "<h2>Top Recent Posts in all categories</h2>";
		} ?>
		
<?php 
	global $db;
	global $root_is_at;
	$lb_now = time();
	if (isset($channel)) {
		$lb_before = $lb_now-($nb_hours*60*60*3); //three days
		$stmt = $db->query('SELECT posts.post_url, posts.post_title, blogs.blog_name, posts.blog_id 
					FROM posts INNER JOIN blogs ON posts.blog_id = blogs.blog_id 
					WHERE blogs.blog_tags LIKE "%'.$channel.'%" AND posts.post_timestamp > '.$lb_before.' 
					ORDER BY post_visits DESC LIMIT 5', PDO::FETCH_ASSOC);
	} else {
		$lb_before= $lb_now-($nb_hours*60*60);
		$stmt = $db->query("SELECT posts.post_url, posts.post_title, blogs.blog_name, posts.blog_id 
			FROM posts INNER JOIN blogs ON posts.blog_id = blogs.blog_id 
			WHERE posts.post_timestamp > $lb_before 
			ORDER BY post_visits DESC LIMIT 5", PDO::FETCH_ASSOC);
	}

	$posts = $stmt->FetchAll();
	foreach ($posts as $post) {
		$img = "img/thumbs/".get_domain($post['post_url']).".jpg";
		$title = $post['post_title'];
		$url = $post['post_url'];
		$blogger_url = $root_is_at . '/blogger/?id=' . $post['blog_id'];
		
		;?>
		
		<table>
			<tr>
				<td width ="25"><a href ="<?php echo $blogger_url; ?>"><img src ="<?php echo $img ;?>" width ="25"></a></td>
				<td><a href ="<?php echo $url ;?>"><h4><?php echo $title ;?></h4></a><h5><a href ="<?php echo $blogger_url; ?>"><?php echo $post['blog_name'] ;?></a></h5></td>
				
			</tr>
		</table>
		<hr>
		
		<?php
		//echo '<div class ="post_wrapper"><img src ="'.$img.'" width ="25"><div class ="info_wrapper"><a href ="'.$url.'"><h4>'.$title.'</h4></a></div>'.$post['blog_name'].'</div>';
	} echo "</div></div>";
}


/*******************************************************************
*	TIPS
*
********************************************************************/ 

function show_tip($which_tip){
	switch ($which_tip) {
		case '2':
			draw_tip("A Bottomless Pit", "<em>Lebanese Blogs</em> is an infinite scrolling website. This means that scrolling down never ends. It is like going back in time to see older posts.","img/interface/tip-arrows-infinite-scrolling.png");
			break;
		
		case '1':
			draw_tip("Smart Sharing", 'When you share using the <em>Lebanese Blogs</em> sharing button, the blogger who wrote the post will be automatically mentioned on twitter. <a href ="http://lebaneseblogs.com/blog/?p=44">Learn more<a>',"img/interface/tip-twitter-share.png");
			break;
	}

}

function draw_tip($tip_title, $tip_body, $tip_image, $tip_link = NULL){
	echo '<div id ="tip" class ="blogentry tip" style="opacity:0">';
	echo '	<div class = "wrapper_special">';
	echo '		<h1><img src ="img/interface/tips.png" width ="35"><br/>TIP</h1>';
	echo '		<h2>'.$tip_title.'</h2>';
	echo '		<p>'.$tip_body.'</p>';
	echo '		<img src ="'.$tip_image.'" >';
	echo '	</div>';
	echo '</div>';
}



function sharing_tools($post_title,$post_twitter,$post_url, $post_visits, $blog_id){
	$tweetcredit = ($post_twitter)?" by @$post_twitter":"";
	$url_to_incode = "$post_title $post_url".$tweetcredit." via lebaneseblogs.com";
	$twitterUrl = urlencode($url_to_incode);
	echo '
<div class ="sharing_tools">
		<ul>
			<li> <a href="https://twitter.com/intent/tweet?text='.$twitterUrl.'" title="Click to send this post to Twitter!" target="_blank"><img src ="img/interface/share-twitter.png" width ="24" height = "24"></a></li>
			<li> <a href="http://www.facebook.com/sharer.php?u='.$post_url.'"><img src ="img/interface/share-facebook.png" width ="24" height = "24"></a> </li>';
			echo '<li class ="button btn btn-small"><a href ="./blogger/?id=' . $blog_id . '">About This Blog</a></li>';

			if (admin_logged_in()) {
				echo "<li>$post_visits</li>";
			}
echo '</ul></div>';

}

function follow_our_bloggers($no){

	global $db;

	$query = "SELECT blog_author_twitter_username from blogs WHERE blog_author_twitter_username IS NOT NULL ORDER by RAND() LIMIT $no";
	$stmt = $db->query($query, PDO::FETCH_ASSOC);
	$posts = $stmt->fetchAll();
		;?>
		
		<div id ="special2" class ="blogentry special" style="opacity:0">
		<div class = "wrapper_special">
		<img src ="img/interface/white-logo.png" width ="35px" style ="border:none">
		<h2>Follow our bloggers on twitter</h2>
		<p>below is a random list of <?php echo $no; ?> of our bloggers on twitter. Follow them! You won't regret it.</p>
		<?php
	foreach ($posts as $post) {
		;?>
		
		<a href="https://twitter.com/<?php echo $post['blog_author_twitter_username'] ?>" class="twitter-follow-button" data-show-count="false" data-size="large" data-dnt="true">Follow @<?php echo $post['blog_author_twitter_username'] ?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		<?php
		echo "<br>";
	}

	echo "</div></div>";
}


function exists_new_conversation(){ //returns conversation ID if there is a conversation that is less than 24 hours old
	//connect to database
	global $db;

	//Find a conversation that is less than 24 hours old

	$last24hours = time()-(24*60*60);

	$query = "SELECT conv_id FROM conversations WHERE conv_start > $last24hours";
	$stmt = $db->query($query, PDO::FETCH_ASSOC);
	$posts = $stmt->fetchALL();
	
	if (isset($posts[0]['conv_id'])) {
		return $posts[0]['conv_id'];
	} else {
		return false;
	}
}

function show_conversation($conv_id){

	//connect to database
	global $db;

	$query = "SELECT * FROM conversations WHERE conv_id = '$conv_id'";
	$stmt = $db->query($query, PDO::FETCH_ASSOC);
	$posts= $stmt->fetchALL();

	echo '<div id ="conversation" class ="blogentry conv" style="opacity:0">';
	echo '	<div class = "wrapper_special">';

	echo '<div class ="wrapper_special"><img src ="img/interface/trending.png" height ="35" style ="border:0;float:left;margin-right:10px"><h2>Trending Topic</h2></div>';
	echo "<p>",$posts[0]['conv_topic'],"</p>";
		echo "<h3>Bloggers' Reactions: </h3>";

	$query = "SELECT * FROM posts_in_conversations WHERE conversation_id = '$conv_id' ORDER BY contribution_kind";
	$stmt = $db->query($query, PDO::FETCH_ASSOC);
	$posts= $stmt->fetchALL();

	$contribution_title ="";

	foreach ($posts as $post) 
	{

		if ($post['contribution_kind'] <> $contribution_title) 
		{	
			// if contribution title has changed, draw new header
			$contribution_title = $post['contribution_kind'];
			echo '<div class="bubble" style="background: rgb(243, 242, 242); border-color: rgb(243, 242, 242);"><h4>'.$contribution_title.'</h4></div>';
		}
		$domain = get_domain($post['post_url']);
		echo '<a href ="'.$post['post_url'].'"><img src ="img/thumbs/'.$domain.'.jpg" width ="50" class ="conv-thumb"></a>';
	}


	echo '	</div>';
	echo '</div>';

}

function days_ago($post_published)
{
    $today = time();
    $day_in_seconds = 60*60*24;
    $seconds_difference = $today-$post_published;
    
    $seconds_difference = $seconds_difference - ($seconds_difference%$day_in_seconds);
    $days_ago = $seconds_difference / $day_in_seconds;
    
    return $days_ago;
}

?>