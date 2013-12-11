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
			
			case 3: 
			if ($_SESSION['pagewanted'] == 'browse') {
				self::featuredBloggers();
				$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
			}
			break;

			case 7: 
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

			global $db;
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
					<div class ="announcement-graphic">
						<i class="icon icon-quote-right"></i>
					</div> 
					<div class="announcement">
						<h4><!-- twitter button -->
							<!-- <a href="https://twitter.com/lebaneseblogs" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @lebaneseblogs</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> -->						
							<strong>New Feature:</strong> Articles by noted Lebanese columnists. <a href ="http://lebaneseblogs.com/blog/?p=168">more >></a>
						</h4>
					</div>
				</div>
				
				<div class="card">
					<div class="card_header primaryfont background-red">
						<h3 class ="whitefont">Top Posts</h3>
					</div>

					<div class ="card_body elastic">
						
						<?php

						foreach ($stats as $stat) {
							$img = $stat->post_image;
							$img_height =$stat->post_image_height ;
							$img_width =$stat->post_image_width ;
							$title = $stat->post_title;
							$url = $stat->post_url;
							$blogger_url = ABSPATH . $stat->blog_id;
							;?>

							<div class="list_type_a">
								<?php
								if (empty($stat->post_image)) {
									;?>
									<a href ="<?php echo $url ;?>">
										<div class="thumb"><img src="<?php echo "img/interface/no-image.jpg" ;?>" height ="75px"></div>
									</a>
									<?php
								}else {
									if ($img_width >= $img_height) {
										;?>				
										<a href ="<?php echo $url ;?>">
											<div class="thumb"><img src="<?php echo $img ;?>" height ="75px"></div>
										</a>
										<?php
									} else {
										;?>
										<a href ="<?php echo $url ;?>">
											<div class="thumb"><img src="<?php echo $img ;?>" width = "75px"></div>
										</a>
										<?php
									}
								}
								?>
								<?php $blog_name = isset($stat->blog_name)? $stat->blog_name: $stat->col_name ;?>
								<h4><a href ="<?php echo $url ;?>"><?php echo $title ;?></a></h4><h5><a href ="<?php echo $blogger_url; ?>"><?php echo $blog_name ;?></a></h5>			
							</div>
							<?php
						} 
						;?>
					</div> <!-- /cards_body -->
				</div>
			</div>
			<?php	
		}

	}

	?>