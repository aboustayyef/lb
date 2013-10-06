<?php 

/**
*   This script displays an amount of posts in the compact view as per the $data given
*/

// load image class for calculating image dimensions

	// loops through the posts
		foreach ($data as $key => $post) {

			$target_url = "http://lebaneseblogs.com/r.php?r=".urlencode($post['post_url']);

			// first, capture the $key so that extra widgets can show (example: top posts at 0 and tips)
			//$this->map_keys($_SESSION['items_displayed']);

			;?>
			
			<!-- compact post wrapper -->

			<a href="#" onclick="handleClicks(<?php echo $_SESSION['posts_displayed']; ?>)"><div class="compact" data-post-number="<?php echo $_SESSION['posts_displayed']; ?>" style ="opacity:0">
		
			
				
					<!-- The stuff that show are wrapped in a compact-preview class -->
					
					<div class="compact-preview">
						<!-- blog name -->
						<div class="blog_name"><?php echo $post['blog_name'] ;?></div>
						
						<!-- post title -->
						<div class="post_title <?php if ($this->contains_arabic($post['post_title'])) {echo " rtl";};?>"><?php echo $post['post_title']; ?></div>

						<!-- post excerpt -->
						<div class ="excerpt-preview <?php if ($this->contains_arabic($post['post_title'])) {echo " rtl";};?>"><?php echo $post['post_excerpt']; ?>	</div>	
						
						<!-- post time -->
						<div class="post_time"><?php echo Lb_functions::time_elapsed_string($post['post_timestamp']) ?></div>
					</div>
					
					<!-- The other stuff are in the class compact-details -->
					<div class="compact-details"> <!-- (the hidden part) -->

						<h4><a href ="<?php echo '/' . $post['blog_id'] ?>"><?php echo $post['blog_name'] ;?></a></h4>
						<h2 class="<?php if ($this->contains_arabic($post['post_title'])) {echo " rtl";};?>"><a href="<?php echo $target_url ;?>"><?php echo $post['post_title']; ?></a></h2>
						<?php 
							if (isset($post['post_image']) && ($post['post_image_width'] > 0) && ($post['post_image_height']>0)) {
								$theimage = new Image(); // use this class to display a maximum side of 500 per image
								$theimage->setMax(500);
								$theimage->setWidth($post['post_image_width']);
								$theimage->setHeight($post['post_image_height']);
								$theimage->calculateDimensions();
								$image_height = $theimage->getDesiredHeight();
								$image_width = $theimage->getDesiredWidth();
								?>
							
							<div class="compact-image">
								<a href="<?php echo $target_url ;?>">
									<img class="lazy" data-original="<?php echo $post['post_image'] ; ?>" src="img/interface/grey.gif" width="<?php echo $image_width ; ?>" height="<?php echo $image_height ; ?>">
								</a>
							</div>
							<?php } ;?>
							<div class ="compact-excerpt <?php if ($this->contains_arabic($post['post_title'])) {echo " rtl";};?>">
								<blockquote><?php echo $post['post_excerpt']; ?></blockquote>	
									<a href="<?php echo $target_url ;?>">Read more..</a>
							</div>	
							<?php?>
					</div> <!-- /compact-details (the hidden part) -->				
				</div> <!-- /compact -->
			</a>
			<?php

			// update counters
			$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			$_SESSION['posts_displayed'] = $_SESSION['posts_displayed'] + 1;
		}
?>