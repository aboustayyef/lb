<?php 


/**
*   This script displays an amount of cards as per the $data given
*/

	// loops through the posts

		foreach ($data as $key => $post) {

			$target_url = "http://lebaneseblogs.com/r.php?r=".urlencode($post['post_url']);

			// first, capture the $key so that extra widgets can show (example: top posts at 0 and tips)
			$this->map_keys($_SESSION['items_displayed']);

			;?>
			
			<!-- Card wrapper -->

			<div class="card<?php if ($this->contains_arabic($post['post_title'])) {echo " rtl";} ?>" id="<?php echo 'post-',$_SESSION['posts_displayed']; ?>"  style ="opacity:0;">
		
			<!--card header-->
		
			<div class="card_header blog_post_module">
				<a href ="<?php echo '/' . $post['post_id'] ?>"><img class ="blog_thumb" src="<?php echo "img/thumbs/".$post['blog_id'].".jpg";?>" width ="50" height ="50"></a>
				<div class="post_details">
					<div class="blog_name"><a href ="<?php echo '/' . $post['blog_id'] ?>"><?php echo $post['blog_name'] ;?></a></div>
				</div>
			</div>


			<!--card body-->
			<div class ="card_body" id ="<?php echo 'content-post-' . $_SESSION['posts_displayed']; ?>">
				<div class="post_title"><a href="<?php echo $target_url ;?>"><?php echo $post['post_title']; ?></a></div>
				<?php 

					if (isset($post['post_image']) && ($post['post_image_width'] > 0) && ($post['post_image_height']>0)) {
						$image_width = 278;
						$image_height = intval(($image_width / $post['post_image_width'])*$post['post_image_height']);
						;?>
						
						<a href="<?php echo $target_url ;?>"><img class="lazy" data-original="<?php echo $post['post_image'] ; ?>" src="img/interface/grey.gif" width="<?php echo $image_width ; ?>" height="<?php echo $image_height ; ?>"></a>
						
						<?php
					} else {
						;?>
						
						<div class ="excerpt"><blockquote><?php echo $post['post_excerpt']; ?></blockquote>	</div>
						
						<?php
					}

				?>
			</div>

			<!--card footer-->
				<div class ="sharing">
					<div class="card_footer">
						<?php 
						$tweetcredit = ($post['blog_author_twitter_username'])?" by @{$post['blog_author_twitter_username']}":"";
						$url_to_incode = "{$post['post_title']} {$post['post_url']}".$tweetcredit." via lebaneseblogs.com";
						$twitterUrl = urlencode($url_to_incode);
	 				?>
					<div class ="sharing_tools">
						<ul>
							<li> <a href="https://twitter.com/intent/tweet?text=<?php echo $twitterUrl; ?>" title="Click to send this post to Twitter!" target="_blank"><i class="icon-twitter-sign icon-large"></i> Tweet</a> </li>
							<li> <a href="http://www.facebook.com/sharer.php?u='.$post_url.'"><i class="icon-facebook-sign icon-large"></i> Share</a> </li>
							<li> <a href="./<?php echo $post['blog_id'] ?>"><i class="icon-question-sign icon-large"></i> About this blog</a> </li>
					<?php 
						/*if (admin_logged_in()) {
							echo "<li>$post_visits</li>";
							echo '<a href ="'.$root_is_at.'/admin/edit.php?id='.$post_id.'"><i class ="icon-edit icon-large"></i></a>';
						}*/
					?>
						</ul>
					</div>


					</div>
				</div>
			</div> <!-- /content module -->
	    
			<?php

			// update counters
			$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			$_SESSION['posts_displayed'] = $_SESSION['posts_displayed'] + 1;
		}
?>