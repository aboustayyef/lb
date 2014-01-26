<?php 

/**
* This class adds Extra cards (items?) to the deck. Things like tips, etc..
*/
class Extras
{
	
	function __construct()
	{
		//nothing
	}

	// this function is the controller of the entire extras system
	// it allocates slots to different cards
	public static function control($itemNumber){
		
		switch ($itemNumber) {

			case 0: 
			if ($_SESSION['pagewanted'] == 'browse') {
				self::topFive(5, 12, $_SESSION['channel']);
				$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			}
			break;			

			case 2:
			if ($_SESSION['pagewanted'] == 'browse') {
				/* Uncomment below for ads*/
				//self::drawAd();
				//$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			}
			break;
			
			case 7: 
			if ($_SESSION['pagewanted'] == 'browse') {
				self::featuredBloggers();
				$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			}
			break;

			case 9: 
			self::tip(0);
			$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			break;

			case 12: 
			self::tip(1);
			$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			break;

			case 17: 
			self::tip(2);
			$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			break;
			case 22: 
			self::tip(3);
			$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			break;

			default:
				# nothing for now
			break;
		}
	}

	public static function tip($whichtip){
		if (isset($_COOKIE['lebaneseblogs_user_visits'])) {
			if ($_COOKIE['lebaneseblogs_user_visits'] > 3) {
				# user has seen website more than 3 times. 
				# user is an expert, no longer needs tips;
				return NULL;
			}
		}

		$all_tips = array(
			array(
				'title'=>"Stash The Gems",
				'body'=> 'Some blog posts are just so amazing or useful that you need to keep them at hand for future reference. Saving Posts is a great way to do that. <img src ="img/interface/stack-of-cards.png" width ="240" height ="172" class ="noborder">',
				),
			array(
				'title'=>'Smart Tweeting',
				'body'=> 'When you share using the Lebanese Blogs "tweet" button, the blogger who wrote the post will be automatically mentioned on twitter <a href ="http://lebaneseblogs.com/blog/?p=44">learn more</a> <img src ="img/interface/smart-twitter-bird.png" width ="240" height ="107" class ="noborder">',
				),
			array(
				'title'=>"Don't Miss a Post",
				'body'=> 'Having a list of favorite blogs is a great way to keep up with blogs that don\'t post often. Whenever you see a blog you like, just click on the "Add Blog to Favorites" button to add it to your list<img src ="img/interface/add-blog-button.png" class ="noborder">',
				),
			array(
				'title'=>'A Bottomless Pit',
				'body'=> 'Lebanese Blogs is an infinite scrolling website. This means that scrolling down never ends. It is like going back in time to see older posts. <img src ="img/interface/downward-arrows.png" width ="240" height = "80" class ="noborder">',
				),
			);
			?>
			<div class="card-container">
				<div class="card tip">
					<div class="card_header primaryfont tip">
						<h3><i class = "icon-lightbulb"></i> TIP</h3>
					</div>
					<div class="card_body tip">
						<h3 class ="primaryfont"><?php echo $all_tips[$whichtip]['title'] ; ?></h3>
						<p class ="secondaryfont"><?php echo $all_tips[$whichtip]['body'] ; ?></p>
					</div>
					<?php 
					if (!empty($all_tips[$whichtip]['image'])) {
						;?> 
						<div class="card_footer tip nopadding background-white">
							<img src="<?php echo $all_tips[$whichtip]['image'] ; ?>">
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}

		public static function featuredBloggers(){

			global $channel_descriptions;

			$bloggers = Posts::get_random_bloggers(3, $_SESSION['channel']);?>
			<div class="card-container">
				<div class="card">
					<div class="card_header primaryfont background-bluegreen">
						<h3 class ="whitefont">
							<?php 
								if (isset($_SESSION['channel'])) {
									echo '<span class ="understated">'. $channel_descriptions[$_SESSION['channel']].'</span><br>';
								}
							?>
							Featured Blogs				
						</h3>
					</div>
					<div class="card_body elastic silverbody">
						
						<?php
						foreach ($bloggers as $blogger) { 
							if (isset($blogger->blog_id) && !empty($blogger->blog_id)) { // it's a blogger, not a columnists
								$name = $blogger->blog_name;
								$description = $blogger->blog_description;
								$id = $blogger->blog_id;
								$url = $blogger->blog_url;
							} else {
								$name = $blogger->col_name;
								$description = $blogger->col_description;
								$id = $blogger->col_shorthand;
								$url = $blogger->col_home_page;
							}
						?>

						<div class="list_type_b">
							<img src="img/thumbs/<?php echo $id; ?>.jpg" alt="" class="thumb">
							<h3><?php echo $name; ?></h3>
							<p><?php echo Lb_functions::limitWords(10, $description); ?></p>
							<div class ="button-wrapper">
								<a href="<?php echo WEBPATH.$id; ?>" class="btn btn-whitetext btn-small background-bluegreen">Page</a>
								<a href="<?php echo $url; ?>" class="btn btn-whitetext btn-small background-bluegreen">Home</a>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>

			<?php
		}

		public static function topFive($howmany=5, $hours=12, $channel = null){
			$stats = Posts::get_Top_Posts($hours, $howmany, $channel);
			if (count($stats)<5) {
				$hours = 24;
				$stats = Posts::get_Top_Posts($hours, $howmany, $channel);
				if (count($stats)<5) {
					$hours = 48;
					$stats = Posts::get_Top_Posts($hours, $howmany, $channel);
				}
			}
			;?>
			<div class="card-container">

				<div class="card">
					<?php
					//for debugging:
					/*echo "<pre>";
					print_r($_SESSION);
					echo "</pre>";*/
					?>
					<!-- <div class ="announcement-graphic">
						<i class="icon icon-heart"></i>
					</div> 
					<div class="announcement">
						<h4>
							A <a href ="http://lebaneseblogs.com/blog/?p=191">Very Good Reason</a> for Following us on <a href="http://facebook.com/lebaneseblogs">Facebook</a> and <a href="http://twitter.com/lebaneseblogs">Twitter</a>.
						</h4>
					</div> -->
					
					
				</div>
				
				<div class="card">
					<div class="card_header primaryfont background-red">
						<h3 class ="whitefont">Top Posts</h3>
						<div id="timeSelector">12 Hours <i class ="icon-chevron-down"></i></div>
					</div>

					<div id = "top" class ="card_body elastic">
						
						<?php

						foreach ($stats as $stat) {
							$img = $stat->post_image;

							$image_cache = 'img/cache/'.$stat->post_timestamp.'_'.$stat->blog_id.'.'.Lb_functions::get_image_format($img);
							if (file_exists(ABSPATH.$image_cache)) {
								$img = WEBPATH.$image_cache;
							}

							$img_height =$stat->post_image_height ;
							$img_width =$stat->post_image_width ;
							$title = $stat->post_title;
							$url = $stat->post_url;
							$blogger_url = WEBPATH . $stat->blog_id;
							;?>

							<div class="list_type_a">
								<?php
								if (empty($stat->post_image)) {
									;?>
									<a href ="<?php echo $url ;?>" target="_blank">
										<div class="thumb"><img src="<?php echo "img/interface/no-image.jpg" ;?>" height ="75px"></div>
									</a>
									<?php
								}else {
									if ($img_width >= $img_height) {
										;?>				
										<a href ="<?php echo $url ;?>" target="_blank">
											<div class="thumb"><img src="<?php echo $img ;?>" height ="75px"></div>
										</a>
										<?php
									} else {
										;?>
										<a href ="<?php echo $url ;?>" target="_blank">
											<div class="thumb"><img src="<?php echo $img ;?>" width = "75px"></div>
										</a>
										<?php
									}
								}
								?>
								<?php $blog_name = isset($stat->blog_name)? $stat->blog_name: $stat->col_name ;?>
								<h4><a href ="<?php echo $url ;?>" target="_blank"><?php echo $title ;?></a></h4><h5><a href ="<?php echo $blogger_url; ?>"><?php echo $blog_name ;?></a></h5>			
							</div>
							<?php
						} 
						;?>
					</div> <!-- /cards_body -->
				</div>
			</div>
			<?php	
		}

		public static function drawAd(){
			?>

			<div class="card-container">
				<div class="card" style ="height:475px; opacity:0;">
			
				<!--card header-->
			
				<div class="card_header background-greylightest" style="background-color: #FCEDED">
					<img class ="blog_thumb" src="<?php echo WEBPATH.'img/thumbs/bullhorn.jpg';?>" width ="50" height ="50">
					<div class="post_details">
						<div class="blog_name secondaryfont">Special Promotion<br><span class ="small understated" style ="opacity:.5;font-size:12px">( Sponsored post )</span></div>
					</div>
				</div>

				<!--card body-->
				<div class ="card_body" id ="advertisement">
					<div class="post_title secondaryfont"><a href="http://go.anghami.com/lbblogsgift">Send your loved ones the gift of unlimited music this holiday!</a></div>
						<a href="http://go.anghami.com/lbblogsgift">
							<img src="<?php echo WEBPATH ?>img/ads/anghami.png" alt="Anghami Special Offer">							
						</a>
				</div>
			</div>
		</div>

			<?php
		}

	}

	?>
