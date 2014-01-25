<?php 
/**
* This class renders posts for certain views
*/
class Render
{
	public static function drawCards($data, $kind='normal') // kinds supported: 'normal' & 'blogger'
	{
		// loops through the posts
		echo '<!-- done using the Render Class -->';
		foreach ($data as $key => $post) {

			// prepare URL of exit link
			$target_url = "http://lebaneseblogs.com/r.php?r=".urlencode($post->post_url);
			
			// add extra cards (if any)
			Extras::control($_SESSION['posts_displayed']);

			;?>
			
			<!-- Depending on wheather it's a columnist or a blogger, some variables have to change -->
			<?php 
				if (!isset($post->blog_id) || empty($post->blog_id)) { // if there is no blog_id, it means we are dealing with a columnist
					$blog_id = $post->col_shorthand;
					$blog_name = $post->col_name;
					$author_twitter = $post->col_author_twitter_username;
				}else{
					$blog_id = $post->blog_id;
					$blog_name = $post->blog_name;
					$author_twitter = $post->blog_author_twitter_username;
				}
			?>
			<!-- Card wrapper -->

			<div class="card-container">
				<div class="card" data-id="<?php echo $_SESSION['posts_displayed']; ?>"  style ="opacity:0;">
			
				<!--card header-->
				<?php 

				if ($kind == 'normal') { //only show the header when we're not in the blogger page

				?>
					<div class="card_header background-greylightest">
						<a href ="<?php echo WEBPATH. $blog_id ; ?>"><img class ="blog_thumb" src="<?php echo WEBPATH.'img/thumbs/'.$blog_id.'.jpg';?>" width ="50" height ="50"></a>
						<div class="post_details">
							<div class="blog_name secondaryfont"><a href ="<?php echo WEBPATH. $blog_id ;?>"><?php echo $blog_name ;?></a></div>
							<div class="blog_tools">
									<!-- <li><i class ="icon-exclamation-sign"></i> About Blog</li> -->
									
									<?php 
										if (Users::UserSignedIn()) { // if user is signed in;
											$f_id = $_SESSION['LebaneseBlogs_Facebook_User_ID'];
											$blog_id = $blog_id;
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
											<div class ="add2fav" ><a href="userlogin.php?from=favorites&amp;action=favorite&amp;blog=<?php echo $blog_id; ?>&amp;redirect=<?php echo WEBPATH ?>"><i class ="icon-star"></i> Add Blog to Favorites</a></div>
											<?php
										}
									 ?>
							</div>
						</div>
					</div>
				<?php 
				}	 
				?>


				<!--card body-->
				<div class ="card_body" id ="<?php echo 'content-post-' . $_SESSION['posts_displayed']; ?>">
					<div class="post_time"><?php echo Lb_functions::time_elapsed_string($post->post_timestamp) ?></div>
					<?php 
						if (isset($_SESSION['admin'])) {
						     ?>
						     <div class="number-of-clicks"><?php echo $post->post_visits; ?></div>
						     <?php
						 }
					?>
					<div class="post_title secondaryfont <?php if (Lb_functions::contains_arabic($post->post_title)) {echo " rtl";}else{echo " ltr";} ?>"><a  href="<?php echo $target_url ;?>" target="_blank"><?php echo $post->post_title; ?></a></div>
					<?php 

						if (isset($post->post_image) && ($post->post_image_width > 0) && ($post->post_image_height>0)) {
							$image_width = 278;
							$image_height = intval(($image_width / $post->post_image_width)*$post->post_image_height);
							$the_image = $post->post_image;

							// use image cache if exists.
							$image_cache = 'img/cache/'.$post->post_timestamp.'_'.$post->blog_id.'.'.Lb_functions::get_image_format($the_image);
							if (file_exists(ABSPATH.$image_cache)) {
								$the_image = WEBPATH.$image_cache;
							}

							;?>
							
							<a href="<?php echo $target_url ;?>" target="_blank"><img class="lazy" data-original="<?php echo $the_image ; ?>" src="img/interface/grey.gif" width="<?php echo $image_width ; ?>" height="<?php echo $image_height ; ?>"></a>
							
							<?php
						} else {
							;?>
							
							<div class ="excerpt"><blockquote class ="secondaryfont <?php if (Lb_functions::contains_arabic($post->post_title)) {echo " rtl";}else{echo " ltr";} ?>"><?php echo $post->post_excerpt; ?></blockquote></div>
							
							<?php
						}

					?>
				</div>

				<!--card footer-->
				<div class="card_footer nopadding">
					<?php 
					$tweetcredit = ($author_twitter)?" by @{$author_twitter}":"";
					$url_to_incode = "{$post->post_title} {$post->post_url}".$tweetcredit." via lebaneseblogs.com";
					$twitterUrl = urlencode($url_to_incode);
					$post_url = $post->post_url;
					?>
					<ul>
						<?php 
							if (Users::UserSignedIn()) { // if user is signed in;
								$f_id = $_SESSION['LebaneseBlogs_Facebook_User_ID'];
								if (Posts::isSaved($f_id, $post_url)) {
									// user is signed in and post is saved
									?>
									<li class="doSave save_toggle" data-url ="<?php echo $post_url ?>" data-user="<?php echo $f_id ; ?>"><a class="removeFromSaved" href="#"><i class="icon-heart selected"></i> Saved</a></li>
									<?php
								}else {
									// user is signed in but post is not saved
									?>
									<li class="doSave save_toggle" data-url ="<?php echo $post_url ?>" data-user="<?php echo $f_id ; ?>"><a class="addToSaved" href="#"><i class="icon-heart"></i> Save Post</a></li>
									<?php
								}
							} else {
								// user is not signed in. Will ask them to sign in;
								?>
								<li class="doSave"><a href="userlogin.php?from=saved&amp;action=save&amp;url=<?php echo urlencode($post->post_url) ?>&amp;redirect=<?php echo WEBPATH ?>"><i class="icon-heart"></i> Save Post</a></li>
								<?php
							}
						 ?>	
					
						<li> <a href="https://twitter.com/intent/tweet?text=<?php echo $twitterUrl; ?>" title="Click to send this post to Twitter!" target="_blank"><i class="icon-twitter icon-large"></i> Tweet</a> </li>
						<li> <a href="http://www.facebook.com/sharer.php?u=<?php echo $post_url ;?>"><i class="icon-facebook icon-large"></i> Share</a> </li>
						<?php 
							/*if (admin_logged_in()) {
								echo "<li>$post_visits</li>";
								echo '<a href ="'.$root_is_at.'/admin/edit.php?id='.$post_id.'"><i class ="icon-edit icon-large"></i></a>';
							}*/
							?>
						</ul>


				</div>
			</div> <!-- /card-container -->
		</div> <!-- /content module -->
	    
		<?php
		// update counters
		$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
		$_SESSION['posts_displayed'] = $_SESSION['posts_displayed'] + 1;
		}
	}


}
?>