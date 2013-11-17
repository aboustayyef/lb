<?php 

/**
*   This script displays an amount of posts in the timeline view as per the $data given
*/

// load image class for calculating image dimensions

	// loops through the posts
		foreach ($data as $key => $post) {

			$target_url = "http://lebaneseblogs.com/r.php?r=".urlencode($post->post_url);

			;?>
			
			<!-- timeline post wrapper -->

			<div class="timeline timeline-post" data-id="<?php echo $_SESSION['posts_displayed']; ?>"  style ="opacity:0;">
		
				<!--blog thumb-->
			
				<div class="col col-1 timeline-blog-thumb">
					<a href ="<?php echo '/' . $post->post_id ?>"><img class ="blog_thumb" src="<?php echo "img/thumbs/".$post->blog_id.".jpg";?>" width ="50" height ="50"></a>
				</div>
				
				<!-- post details -->
				<div class="col col-2">
					<div class="col col-2a timeline-post-details">
						<!-- blog name -->
						<div class="blog_name"><a href ="<?php echo '/' . $post->blog_id ?>"><?php echo $post->blog_name ;?></a></div>
						
						<!-- post title -->
						<div class="post_title <?php if ($this->contains_arabic($post->post_title)) {echo " rtl";};?>"><a href="<?php echo $target_url ;?>"><?php echo $post->post_title; ?></a><span class="post_time"><?php echo Lb_functions::time_elapsed_string($post->post_timestamp) ?></span></div>
						
						<!-- image or excerpt -->
						<?php 

						if (isset($post->post_image) && ($post->post_image_width > 0) && ($post->post_image_height>0)) {
							$theimage = new Image();
							$theimage->setMax(500);
							$theimage->setWidth($post->post_image_width);
							$theimage->setHeight($post->post_image_height);
							$theimage->calculateDimensions();
							$image_height = $theimage->getDesiredHeight();
							$image_width = $theimage->getDesiredWidth();
							?>
							
							<a href="<?php echo $target_url ;?>"><img class="lazy" data-original="<?php echo $post->post_image ; ?>" src="img/interface/grey.gif" width="<?php echo $image_width ; ?>" height="<?php echo $image_height ; ?>"></a>
							<?php
						} else {
							;?>
							<div class ="excerpt <?php if ($this->contains_arabic($post->post_title)) {echo " rtl";};?>">
								<blockquote><?php echo $post->post_excerpt; ?></blockquote>	
								<a href="<?php echo $target_url ;?>">Read more..</a>
							</div>	
							<?php
						}

						$tweetcredit = ($post->blog_author_twitter_username)?" by @{$post->blog_author_twitter_username}":"";
						$url_to_incode = "{$post->post_title} {$post->post_url}".$tweetcredit." via lebaneseblogs.com";
						$twitterUrl = urlencode($url_to_incode);
						?>

					</div>
					<!-- <div class="col col-2b timeline-tools">
						<ul>
							<li><a href="<?php echo WEBPATH.$post->blog_id; ?>"><i class="icon icon-signin"></i> Go To Blog's Page</a></li>
							<li><div class="add2fav"><a href="userlogin.php?from=favorites"><i class="icon-star"></i> Add Blog to Favorites</a></div></li>
							<li><a href="#"><i class="icon-heart"></i> Save Post</a></li>
							<li> <a href="https://twitter.com/intent/tweet?text=<?php echo $twitterUrl; ?>" title="Click to send this post to Twitter!" target="_blank"><i class="icon-twitter icon-large"></i> Tweet</a> </li>
							<li> <a href="http://www.facebook.com/sharer.php?u='.$post_url.'"><i class="icon-facebook icon-large"></i> Share</a> </li>
						</ul>
					</div> -->
				</div>
			</div>
			<?php

			// update counters
			$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			$_SESSION['posts_displayed'] = $_SESSION['posts_displayed'] + 1;
		}
?>