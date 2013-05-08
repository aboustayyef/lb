<?php 

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

function draw_blog_entry_with_image(
	$blog_thumb,
	$blog_name,
	$post_title,
	$post_url,
	$post_image,
	$post_image_width,
	$post_image_height,
	$post_twitter,
	$post_visits )
{
	$module_code = <<<BLOGENTRY
<div class="blogentry" style ="opacity:0">
	<div class="post_info">
		<img class ="blog_thumb" src="$blog_thumb" width ="50" height ="50">
		<div class="post_details">
			<div class="blog_name">$blog_name</div>
			<div class="post_title"><a href="$post_url">$post_title</a></div>
		</div>
	</div>
	<a href="$post_url"><img class="lazy" data-original="$post_image" src="img/interface/grey.gif" width="$post_image_width" height="$post_image_height"></a>
BLOGENTRY;

echo $module_code;
sharing_tools($post_title,$post_twitter,$post_url, $post_visits);
echo "</div>";
}

function draw_blog_entry_with_excerpt(
	$blog_thumb,
	$blog_name,
	$post_title,
	$post_url,
	$post_excerpt,
	$post_twitter,
	$post_visits )
{
	$module_code = <<<BLOGENTRY
<div class="blogentry" style ="opacity:0">
	<div class="post_info">
		<img class ="blog_thumb" src="$blog_thumb" width ="50" height ="50">
		<div class="post_details">
			<div class="blog_name">$blog_name</div>
			<div class="post_title"><a href="$post_url">$post_title</a></div>
		</div>
	</div>
	<div class ="excerpt">
		<blockquote>$post_excerpt</blockquote>
	</div>
BLOGENTRY;

echo $module_code;
sharing_tools($post_title,$post_twitter,$post_url, $post_visits);
echo "</div>";

}

function top_5_posts($nb_hours){
	$module_code = <<<FEATURE

<div id ="special1" class ="blogentry special" style="opacity:0">
	<div class = "wrapper_special">
		<img src ="img/interface/up.png" width ="35px" style ="border:none">
		<h2>Top Posts in the last $nb_hours hours</h2>
		<hr class ="clear">
FEATURE;
echo $module_code;
	global $db_username, $db_password , $db_host , $db_database;
	$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host. '', $db_username, $db_password);

	$db->query("SET NAMES 'utf8'");
	$db->query("SET CHARACTER SET utf8");
	$db->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");
	
	$lb_now = time();
	$lb_yesterday= $lb_now-($nb_hours*60*60);

	$stmt = $db->query("SELECT posts.post_url, posts.post_title, blogs.blog_name FROM posts INNER JOIN blogs ON posts.blog_id = blogs.blog_id WHERE posts.post_timestamp > $lb_yesterday ORDER BY post_visits DESC LIMIT 5", PDO::FETCH_ASSOC);
	$posts = $stmt->FetchAll();
	foreach ($posts as $post) {
		$img = "img/thumbs/".get_domain($post['post_url']).".jpg";
		$title = $post['post_title'];
		$url = $post['post_url'];
		
		;?>
		
		<table>
			<tr>
				<td width ="25"><img src ="<?php echo $img ;?>" width ="25"></td>
				<td><a href ="<?php echo $url ;?>"><h4><?php echo $title ;?></h4></a><h5><?php echo $post['blog_name'] ;?><h5></td>
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
		case '1':
			draw_tip("A Bottomless Pit", "<em>Lebanese Blogs</em> is an infinite scrolling website. This means that scrolling down never ends. It is like going back in time to see older posts.","img/interface/tip-arrows-infinite-scrolling.png");
			break;
		
		case '2':
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



function sharing_tools($post_title,$post_twitter,$post_url, $post_visits){
	$tweetcredit = ($post_twitter)?" by @$post_twitter":"";
	$post_url = substr(urldecode($post_url), 33);
	$url_to_incode = "$post_title $post_url".$tweetcredit." via lebaneseblogs.com";
	$twitterUrl = urlencode($url_to_incode);
	echo '
<div class ="sharing_tools">
		<ul>
			<li> <a href="https://twitter.com/intent/tweet?text='.$twitterUrl.'" title="Click to send this post to Twitter!" target="_blank"><img src ="img/interface/share-icon-twitter.png" style ="border:none" width ="16"></a></li>
			<li> <a href="http://www.facebook.com/sharer.php?u='.$post_url.'"><img src ="img/interface/share-icon-facebook.png" width ="16"></a> </li>';
			if (admin_logged_in()) {
				echo "<li>$post_visits</li>";
			}
echo '</ul></div>';

}

function follow_our_bloggers($no){

	global $db_username, $db_password , $db_host , $db_database;
	$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host. '', $db_username, $db_password);

	$db->query("SET NAMES 'utf8'");
	$db->query("SET CHARACTER SET utf8");
	$db->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");

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
	global $db_username, $db_password , $db_host , $db_database;
	$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host . '', $db_username, $db_password);

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
	global $db_username, $db_password , $db_host , $db_database;
	$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host . '', $db_username, $db_password);

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

?>