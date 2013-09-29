<?php 

/**
*   This script displays an amount of posts in the timeline view as per the $data given
*/

// load image class for calculating image dimensions

	// loops through the posts
		foreach ($data as $key => $post) {

			$target_url = "http://lebaneseblogs.com/r.php?r=".urlencode($post['post_url']);

			// first, capture the $key so that extra widgets can show (example: top posts at 0 and tips)
			//$this->map_keys($_SESSION['items_displayed']);

			;?>
			
			<!-- timeline post wrapper -->

			<div class="timeline" id="<?php echo 'post-',$_SESSION['posts_displayed']; ?>"  style ="opacity:0;">
		
			<!--blog thumb-->
			
				<div class="timeline-blog-thumb">
					<a href ="<?php echo '/' . $post['post_id'] ?>"><img class ="blog_thumb" src="<?php echo "img/thumbs/".$post['blog_id'].".jpg";?>" width ="50" height ="50"></a>
				</div>
				
				<div class="timeline-post-details">
					<!-- blog name -->
					<div class="blog_name"><a href ="<?php echo '/' . $post['blog_id'] ?>"><?php echo $post['blog_name'] ;?></a></div>
					
					<!-- post title -->
					<div class="post_title <?php if ($this->contains_arabic($post['post_title'])) {echo " rtl";};?>"><a href="<?php echo $target_url ;?>"><?php echo $post['post_title']; ?></a></div>
					
					<!-- image or excerpt -->
					<?php 

						if (isset($post['post_image']) && ($post['post_image_width'] > 0) && ($post['post_image_height']>0)) {
							$theimage = new Image();
							$theimage->setMax(500);
							$theimage->setWidth($post['post_image_width']);
							$theimage->setHeight($post['post_image_height']);
							$theimage->calculateDimensions();
							$image_height = $theimage->getDesiredHeight();
							$image_width = $theimage->getDesiredWidth();
							?>
						
						<a href="<?php echo $target_url ;?>"><img class="lazy" data-original="<?php echo $post['post_image'] ; ?>" src="img/interface/grey.gif" width="<?php echo $image_width ; ?>" height="<?php echo $image_height ; ?>"></a>
							<?php
						} else {
							;?>
							<div class ="excerpt <?php if ($this->contains_arabic($post['post_title'])) {echo " rtl";};?>">
								<blockquote><?php echo $post['post_excerpt']; ?></blockquote>	
								<a href="<?php echo $target_url ;?>">Read more..</a>
							</div>	
							<?php
						}
				?>
				</div>
    		</div>
			<?php

			// update counters
			$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			$_SESSION['posts_displayed'] = $_SESSION['posts_displayed'] + 1;
		}
?>