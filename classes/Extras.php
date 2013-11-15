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
				self::topFive(5, 12);
				$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
				break;			
			
			case 3: // card 5 , suggested bloggers
				self::featuredBloggers();
				$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
				break;

			case 7: // card 9, twitter tip
				self::tip(0);
				$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
				break;

			case 12: //very first card
				self::tip(1);
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
				'title'=>'Smart Sharing',
				'body'=> 'When you share using the Lebanese Blogs sharing button, the blogger who wrote the post will be automatically mentioned on twitter <a href ="#">learn more</a>',
				'image'=> 'img/interface/twitter-share.png'
			),
			array(
				'title'=>'A Bottomless Pit',
				'body'=> 'Lebanese Blogs is an infinite scrolling website. This means that scrolling down never ends. It is like going back in time to see older posts.',
				'image'=> 'img/interface/tip-arrows-infinite-scrolling.png'
			),
			array(
				'title'=>'This is another tip',
				'body'=> 'This is the body of the third tip, the description and everything that is here',
				'image'=> 'img/interface/tip-arrows-infinite-scrolling.png'
			),
		);
		?>

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
		<?php
	}

	public static function featuredBloggers(){
		
		global $db;

		$bloggers = Posts::get_random_bloggers(3);?>

		<div class="card">
			<div class="card_header primaryfont background-bluegreen">
				<h3 class ="whitefont">Featured Blogs</h3>
			</div>
			<div class="card_body elastic silverbody">

		<?php
		foreach ($bloggers as $blogger) { ?>
				<div class="list_type_b">
					<img src="img/thumbs/<?php echo $blogger->blog_id; ?>.jpg" alt="" class="thumb">
					<h3><?php echo $blogger->blog_name; ?></h3>
					<p><?php echo Lb_functions::limitWords(10, $blogger->blog_description); ?></p>
					<div class ="button-wrapper"><a href="<?php echo WEBPATH.$blogger->blog_id; ?>" class="btn btn-whitetext btn-small background-bluegreen">explore</a></div>
				</div>
		<?php } ?>
			</div>
		</div>

		<?php
	}

	public static function topFive($howmany=5, $hours=12, $channel = null){
		
		global $db;
		$stats = Posts::get_Top_Posts($hours, $howmany, $channel); 
		;?>
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
					<h4><a href ="<?php echo $url ;?>"><?php echo $title ;?></a></h4><h5><a href ="<?php echo $blogger_url; ?>"><?php echo $stat->blog_name ;?></a></h5>			
				</div>
			<?php
			} 
			;?>
			</div> <!-- /cards_body -->
		</div>
	<?php	
	}

}

?>