<?php 
	/*******************************************************************
	*	This script handles adding items on the page for infinite scrolling effect
	*
	********************************************************************/ 

	$start_from = $_POST['start_from'];

	require_once("simplepie.php");
    require_once "config.php";
    require_once("functions.php");
    require_once("views.php");

	$to = $start_from + 15; // change figure if we want
	$posts = get_posts_from_database($start_from+1, $to); 
	foreach ($posts as $post) 
	{?>
	<!-- <div class ="console"><?php echo $start_from, " ", $to; ?></div> -->
	<div class="blogentry <?php if ($post['domain'] =="lebaneseblogs") {echo "metablog";} ?>" style ="opacity:0">
	<div class ="thumb_and_title">
		<div class ="blog_thumb"> 			
			<img src ="<?php echo $post['thumb']; ?>" width ="50">
		</div>				
		<div class ="blog_info">
			<div class ="blog_name">
				<?php echo $post['blogname'] ; ?>
			</div>
			<div class ="post_title <?php if (contains_arabic($post["title"])) { echo "isarabic"; } ?>">
				<a href ="<?php echo $post['url'] ;?>"><?php echo $post['title'] ?></a>
			</div>
		</div> <!-- /blog_info -->
	</div>
	<div class ="dash_thumbnail">
		<?php 
		if ($post['image-url']) { ?>
			<a href ="<?php echo $post['url'] ?>"><img width ="318" src ="<?php echo $post['image-url'] ?>"></a>
		<?php
		} else {?>
			<a href ="<?php echo $post['url'] ; ?>"><div class ="quote <?php if (contains_arabic($post['excerpt'])) { echo 'isarabic'; } ?>"><blockquote><?php echo $post['excerpt'] ; ?></blockquote></div></a>
			<?php echo "<!-- length of string:", strlen($post['excerpt']), "-->" ?>
		<?php 
		} ; ?>
	</div><!-- /dash_thumbnail -->
	<div class ="sharing_tools">
		<ul>
			<?php $tweetcredit = ($post['twitter'])?" by @${post['twitter']}":""; ?>
			<?php $url_to_incode = "${post['title']} ${post['url']}".$tweetcredit." via lebaneseblogs.com" ;?>
			<?php $twitterUrl = urlencode($url_to_incode) ;?>
			<li> <a href="https://twitter.com/intent/tweet?text=<?php echo $twitterUrl; ?>" title="Click to send this post to Twitter!" target="_blank"><img src ="share-icon-twitter.png" width ="16"></a></li>
			<li> <a href="http://www.facebook.com/sharer.php?u=<?php echo $post['url'] ; ?>"><img src ="share-icon-facebook.png" width ="16"></a> </li>
			<!-- <a href="https://twitter.com/share?url=<?php echo $post['url'] ; ?>" target="_blank"><img src ="share-icon-twitter.png" width ="16"></a> -->

		</ul>
	</div>
</div> <!-- /blogentry -->
<?php 
}

?>