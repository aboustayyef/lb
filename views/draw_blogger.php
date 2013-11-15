<?php 

// query to get the latest posts by blogger $this->_blogger;

$blogger_posts = new Posts($db);
$blogger_posts = Posts::get_blogger_posts(20,$this->_blogger);

;?>
<div class="blogger">
	<div class="blogMeta">
	<?php 
		$blogDetails = $blogger_posts[0];
		echo '<img class ="blog_thumb" src ="' .WEBPATH.'img/thumbs/' .$blogDetails->blog_id.'.jpg">';
		echo '<h2>'.$blogDetails->blog_name.'</h2>';
		echo '<p>'.$blogDetails->blog_description.'<p>';
		$tags = explode(',',$blogDetails->blog_tags);
		echo '<ul id ="tags">';
		foreach ($tags as $key => $tag) {
			echo '<li><a href="#">'.$tag.'</a></li>'; 
		}
		echo '</ul>';
		//echo '<h2>', 
	?>

	</div><!-- /blogMeta -->

<div class ="bloggerPosts">
<?php

foreach ($blogger_posts as $key => $post) {
;?>

<div class ="card">
	<div class="card_header noborder">
		<a href="<?php echo $post->post_url ;?>"><h3><?php echo $post->post_title; ?></h3></a>	
	</div>
	<div class="card_body nopadding">	
		<?php 
			if (isset($post->post_image) && ($post->post_image_width > 0) && ($post->post_image_height>0)) {
				$image_width = 300;
				$image_height = intval(($image_width / $post->post_image_width)*$post->post_image_height);
				;?>
				
				<a href="<?php echo $post->post_url ;?>"><img class="lazy" data-original="<?php echo $post->post_image ; ?>" src="img/interface/grey.gif" width="<?php echo $image_width ; ?>" height="<?php echo $image_height ; ?>"></a>
				
				<?php
			} else {
				;?>
				
				<div class ="excerpt"><blockquote><?php echo $post->post_excerpt; ?></blockquote>	</div>
				
				<?php
			}
		?>
	</div>
	<div class="card_footer">
		<!-- nothing -->
	</div>
</div>
<?php

}
?>
</div> <!-- /bloggerPosts -->
</div> <!-- /blogger -->
<div class="bloggerbutton">
	<a class="btn btn-red" href="<?php echo $blogDetails->blog_url;?>">See More at <?php echo $blogDetails->blog_name; ?></a>
</div>