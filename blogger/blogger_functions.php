<?php 

function blog_exists($id){
	global $db;
	$query = 'SELECT `blog_id` FROM `blogs` WHERE `blog_id` ="'. $id .'"';
	$stmt = $db->query($query);
	$rows = $stmt->fetchAll();
	if (count($rows)>0) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function route_keyword($keyword){
/*
	This function serves to direct tags to their parent tags
*/

	$tag_router = array(
		"fashion" 			=>	"fashion",
	    "society"			=>	"society",
	    "tech" 				=>	"tech",
	    "politics" 			=>	"politics",
	    "design"  			=>	"design",
	    "food" 				=>	"food",
	    "activism" 			=>	"politics",
	    "art"				=>	"design",
	    "business" 			=>	"tech",
	    "photography" 		=>	"design",
	    "advertising" 		=>	"design",
	    "agriculture" 		=>	"society",
	    "environmentalism" 	=>	"society",
	    "health"			=>	"food",
	    "humor"				=>	"society",
	    "comics"			=>	"society",
	    "marketing"			=>	"tech",
	    "music"				=>	"media",
	    "tv"				=>	"media",
	    "film"				=>	"media"
	);

	if (isset($tag_router[strtolower($keyword)])) {
		return $tag_router[strtolower($keyword)];
	}else{
		return false;
	}

}


function get_blogger_posts_from_database($from,$to, $blogger_id){
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
	
	$query = 'SELECT * FROM `posts` WHERE `blog_id` = "'.$blogger_id.'" ORDER BY `post_timestamp` DESC LIMIT '.$to;
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
		"visits" => $row['post_visits'],
		"id"=> $row['post_id']
		);
	};
	$newposts = array_slice($posts, -$amountOfRecords, $amountOfRecords, true);
	return $newposts;
}

function display_blogger_blogs($posts){
	foreach ($posts as $key => $post) 
	{
		draw_blogger_blog_entry($key, $post);
		//mapkeys($key);
	}
	;?>

	<?php
}

function blogger_sharing_tools($post_title,$post_twitter,$post_url, $post_visits, $blog_id, $post_id){
	global $root_is_at;
	$tweetcredit = ($post_twitter)?" by @$post_twitter":"";
	$url_to_incode = "$post_title $post_url".$tweetcredit." via lebaneseblogs.com";
	$twitterUrl = urlencode($url_to_incode);
	echo '
<div class ="sharing_tools">
		<ul>
			<li> <a href="https://twitter.com/intent/tweet?text='.$twitterUrl.'" title="Click to send this post to Twitter!" target="_blank"><i class="icon-twitter-sign icon-large"></i> Tweet</a> </li>
			<li> <a href="http://www.facebook.com/sharer.php?u='.$post_url.'"><i class="icon-facebook-sign icon-large"></i> Share on Facebook</a> </li>';

			if (admin_logged_in()) {
				echo "<li>$post_visits</li>";
				echo '<a href ="'.$root_is_at.'/admin/edit.php?id='.$post_id.'"><i class ="icon-edit icon-large"></i></a>';
			}
echo '</ul></div>';

}

function draw_blogger_blog_entry($key, $post){ 
	
	$target_url = $post['url'];
	;?>
	
	<div id="<?php echo 'blogger-post-',$key; ?>" class="content_module<?php if (contains_arabic($post['title'])) {echo " rtl";} ?>" style ="opacity:0;" 
		
		<!--header-->
		<div class="content_module_header">
			<a href="<?php echo $target_url ;?>"><h2><?php echo $post['title']; ?></h2></a>
		</div>
		
		<!--body-->
		<div class ="content_module_body" id ="<?php echo 'content-post-' . $key; ?>">
			<?php 
				if (isset($post['image-url'])) {
					$image_width = 300;
					$image_height = intval(($image_width / $post['img_width'])*$post['img_height']);
					;?>
					
					<a href="<?php echo $target_url ;?>"><img class="lazy" data-original="<?php echo $post['image-url'] ; ?>" src="../img/interface/grey.gif" width="<?php echo $image_width ; ?>" height="<? echo $image_height ; ?>"></a>
					
					<?php
				} else {
					;?>
					
					<div class ="excerpt"><blockquote><?php echo $post['excerpt']; ?></blockquote>	</div>
					
					<?php
				}
			?>
		</div>
		<!--footer-->
		<div class ="sharing">
			<div class="content_module_footer">
				<?php blogger_sharing_tools($post['title'],$post['twitter'],$post['url'], $post['visits'], $post['domain'], $post['id']); ?>
			</div>
		</div>
	</div>
<?php

}