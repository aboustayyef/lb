<?php 

// query to get the latest posts by blogger $this->_blogger;

$blogger_posts = Posts::get_blogger_posts(20,$this->_blogger);

if (!isset($blogger_posts[0]->blog_id) || empty($blogger_posts[0]->blog_id)) { // if there is no blog_id, it means we are dealing with a columnist
	$blog_id = $blogger_posts[0]->col_shorthand;
	$blog_name = $blogger_posts[0]->col_name;
	$author_twitter = $blogger_posts[0]->col_author_twitter_username;
	$description = $blogger_posts[0]->col_description;
	$tags = $blogger_posts[0]->col_tags;
	$url = $blogger_posts[0]->col_home_page;
}else{
	$blog_id = $blogger_posts[0]->blog_id;
	$blog_name = $blogger_posts[0]->blog_name;
	$author_twitter = $blogger_posts[0]->blog_author_twitter_username;
	$description = $blogger_posts[0]->blog_description;
	$tags = $blogger_posts[0]->blog_tags;
	$url = $blogger_posts[0]->blog_url;
}

;?>
<div class="blogger">
	<div class="blogMeta">
	<?php 
		$blogDetails = $blogger_posts[0];
		?>
		<div class="blogger-header">
			<img src="<?php echo WEBPATH.'img/thumbs/'.$blog_id.'.jpg'; ?>" width ="50" height="50" alt="">
			<h2 class ="primaryfont"><?php echo $blog_name; ?></h2>
		</div>
		<?php
		//echo '<img class ="blog_thumb" src ="' .WEBPATH.'img/thumbs/' .$blogDetails->blog_id.'.jpg">';
		//echo '<h2>'.$blog_name.'</h2>';
		echo '<p class = "secondaryfont">'.$description .'</p>';
		?>
		<?php
		$tags = explode(',',$tags);
		echo '<div id ="tags">';
		foreach ($tags as $key => $tag) {
			$tag = trim($tag);
			$channel = Lb_functions::tagtochannel($tag); // because we have many tags but only a few channels
			echo '<a href="'.WEBPATH.'?channel='.$channel.'">#'.$tag.' </a>'; 
		}
		echo '</div>';
		echo '<ul class ="goToButtons">';
			if (Users::UserSignedIn()) { // if user is signed in;
				$f_id = $_SESSION['LebaneseBlogs_Facebook_User_ID'];
				if (Posts::isFavorite($f_id, $blog_id)) {
					// user is signed in and blog is a favorite
					?>
					<li><div class ="twitterstylebutton favorite_toggle" data-blog="<?php echo $blog_id ?>" data-user="<?php echo $f_id ; ?>"><i class="icon-star" style="color:#FC0"></i> Favorite (<a class ="removeFromFavorites" href="#">remove</a>)</div></li>
					<?php
				}else {
					// user is signed in but blog is not a favorite
					?>
					<li><div class ="twitterstylebutton favorite_toggle" data-blog="<?php echo $blog_id ?>" data-user="<?php echo $f_id ; ?>"><a class="addToFavorites" href="#"><i class="icon-star"></i> Add Blog to Favorites</a></div></li>
					<?php
				}} else {
				// user is not signed in. Will ask them to sign in;
				?>
				<li><div class ="twitterstylebutton" ><a href="userlogin.php?from=favorites"><i class ="icon-star"></i> Add Blog to Favorites</a></div></li>
				<?php
			}
		 ?>
			<!-- twitter follow button -->
			<li><iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/follow_button.1384205748.html#_=1384688098230&amp;dnt=true&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=<?php echo $author_twitter ;?>&amp;show_count=false&amp;show_screen_name=true&amp;size=l" class="twitter-follow-button twitter-follow-button" title="Twitter Follow Button" data-twttr-rendered="true" style="width: 168px; height: 28px;"></iframe></li>
		</ul>

	</div><!-- /blogMeta -->

<div class ="bloggerPosts">
<?php

foreach ($blogger_posts as $key => $post) {
;?>
<div class="card-container">
<div class ="card">

	<div class="card_body nopadding">	
		<div class="post_title givemargins secondaryfont <?php if (Lb_functions::contains_arabic($post->post_title)) {echo " rtl";}else{echo " ltr";} ?>">
			<a href="<?php echo $post->post_url ;?>"><?php echo $post->post_title; ?></a>
			<div class="post_time"><?php echo Lb_functions::time_elapsed_string($post->post_timestamp) ?></div>
	
		</div>

		<?php 
			if (isset($post->post_image) && ($post->post_image_width > 0) && ($post->post_image_height>0)) {
				$image_width = 300;
				$image_height = intval(($image_width / $post->post_image_width)*$post->post_image_height);
				$the_image = $post->post_image;

				$image_cache = 'img/cache/'.$post->post_timestamp.'_'.$blog_id.'.'.Lb_functions::get_image_format($the_image);
				if (file_exists(ABSPATH.$image_cache)) {
					$the_image = WEBPATH.$image_cache;
				}				
				;?>
				
				<a href="<?php echo $post->post_url ;?>"><img class="lazy" data-original="<?php echo $the_image ; ?>" src="img/interface/grey.gif" width="<?php echo $image_width ; ?>" height="<?php echo $image_height ; ?>"></a>
				
				<?php
			} else {
				;?>
				
				<div class ="excerpt"><blockquote class ="<?php if (Lb_functions::contains_arabic($post->post_title)) {echo " rtl";}else{echo " ltr";} ?>"><?php echo $post->post_excerpt; ?></blockquote>	</div>
				
				<?php
			}
		?>
	</div>
	<div class="card_footer nopadding noborder">
		<?php 
		$tweetcredit = ($author_twitter)?" by @{$author_twitter}":"";
		$url_to_incode = "{$post->post_title} {$post->post_url}".$tweetcredit." via lebaneseblogs.com";
		$twitterUrl = urlencode($url_to_incode);
		?>
		<ul>
			<li class="save"><a href="#"><i class="icon-heart"></i> Save Post</a></li>
			<li> <a href="https://twitter.com/intent/tweet?text=<?php echo $twitterUrl; ?>" title="Click to send this post to Twitter!" target="_blank"><i class="icon-twitter icon-large"></i> Tweet</a> </li>
			<li> <a href="http://www.facebook.com/sharer.php?u='.$post_url.'"><i class="icon-facebook icon-large"></i> Share</a> </li>
		</ul>
	</div>
</div>
</div>
<?php

}
?>
</div> <!-- /bloggerPosts -->
</div> <!-- /blogger -->
<div class="bloggerbutton">
	<a class="btn btn-red" href="<?php echo $url;?>">See More at <?php echo $blog_name; ?></a>
</div>