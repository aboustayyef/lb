<?php 

/**
*   This script displays an amount of cards as per the $data given
*/

	// loops through the posts
		foreach ($data as $key => $post) {

			// prepare URL of exit link
			$target_url = "http://lebaneseblogs.com/r.php?r=".urlencode($post->post_url);
			
			// add extra cards (if any)
			Extras::control($_SESSION['posts_displayed']);

			;?>
			
			<!-- Card wrapper -->

			<div class="card<?php if ($this->contains_arabic($post->post_title)) {echo " rtl";} ?>" data-id="<?php echo $_SESSION['posts_displayed']; ?>"  style ="opacity:0;">
		
			<!--card header-->
		
			<div class="card_header background-greylightest">
				<a href ="<?php echo WEBPATH. $post->blog_id ; ?>"><img class ="blog_thumb" src="<?php echo WEBPATH.'img/thumbs/'.$post->blog_id.'.jpg';?>" width ="50" height ="50"></a>
				<div class="post_details">
					<div class="blog_name secondaryfont"><a href ="<?php echo WEBPATH. $post->blog_id ;?>"><?php echo $post->blog_name ;?></a></div>
					<div class="blog_tools">
							<!-- <li><i class ="icon-exclamation-sign"></i> About Blog</li> -->
							
							<?php 
								if (Users::UserSignedIn()) { // if user is signed in;
									$f_id = $_SESSION['LebaneseBlogs_Facebook_User_ID'];
									$blog_id = $post->blog_id;
									if (Posts::isFavorite($f_id, $blog_id)) {
										// user is signed in and blog is a favorite
										?>
										<div class ="add2fav favorite_toggle" data-blog="<?php echo $blog_id ?>" data-user="<?php echo $f_id ; ?>"><i class="icon-star" style="color:#FC0"></i> Favorite (<a class ="removeFromFavorites" href="#">remove</a>)</div>
										<?php
									}else {
										// user is signed in but blog is not a favorite
										?>
										<div class ="add2fav favorite_toggle" data-blog="<?php echo $blog_id ?>" data-user="<?php echo $f_id ; ?>"><a class ="addToFavorites" href="#"><i class ="icon-star"></i> Add Blog to Favorites</a></div>
										<?php
									}
								} else {
									// user is not signed in. Will ask them to sign in;
									?>
									<div class ="add2fav" ><a href="userlogin.php?from=favorites"><i class ="icon-star"></i> Add Blog to Favorites</a></div>
									<?php
								}
							 ?>
					</div>
				</div>
			</div>


			<!--card body-->
			<div class ="card_body" id ="<?php echo 'content-post-' . $_SESSION['posts_displayed']; ?>">
				<div class="post_time"><?php echo Lb_functions::time_elapsed_string($post->post_timestamp) ?></div>
				<div class="post_title secondaryfont"><a href="<?php echo $target_url ;?>"><?php echo $post->post_title; ?></a></div>
				<?php 

					if (isset($post->post_image) && ($post->post_image_width > 0) && ($post->post_image_height>0)) {
						$image_width = 278;
						$image_height = intval(($image_width / $post->post_image_width)*$post->post_image_height);
						;?>
						
						<a href="<?php echo $target_url ;?>"><img class="lazy" data-original="<?php echo $post->post_image ; ?>" src="img/interface/grey.gif" width="<?php echo $image_width ; ?>" height="<?php echo $image_height ; ?>"></a>
						
						<?php
					} else {
						;?>
						
						<div class ="excerpt"><blockquote><?php echo $post->post_excerpt; ?></blockquote>	</div>
						
						<?php
					}

				?>
			</div>

			<!--card footer-->
			<div class="card_footer nopadding">
				<?php 
				$tweetcredit = ($post->blog_author_twitter_username)?" by @{$post->blog_author_twitter_username}":"";
				$url_to_incode = "{$post->post_title} {$post->post_url}".$tweetcredit." via lebaneseblogs.com";
				$twitterUrl = urlencode($url_to_incode);
				?>
				<ul>
					<li class="save"><a href="#"><i class="icon-heart"></i> Save Post</a></li>
					<li> <a href="https://twitter.com/intent/tweet?text=<?php echo $twitterUrl; ?>" title="Click to send this post to Twitter!" target="_blank"><i class="icon-twitter icon-large"></i> Tweet</a> </li>
					<li> <a href="http://www.facebook.com/sharer.php?u='.$post_url.'"><i class="icon-facebook icon-large"></i> Share</a> </li>
					<?php 
						/*if (admin_logged_in()) {
							echo "<li>$post_visits</li>";
							echo '<a href ="'.$root_is_at.'/admin/edit.php?id='.$post_id.'"><i class ="icon-edit icon-large"></i></a>';
						}*/
						?>
					</ul>


			</div>
		</div> <!-- /content module -->
	    
			<?php

			// update counters
			$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			$_SESSION['posts_displayed'] = $_SESSION['posts_displayed'] + 1;
		}
?>