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
Render::drawCards($blogger_posts, 'blogger');
?>
</div> <!-- /bloggerPosts -->
</div> <!-- /blogger -->
<div class="bloggerbutton">
	<a class="btn btn-red" href="<?php echo $url;?>">See More at <?php echo $blog_name; ?></a>
</div>