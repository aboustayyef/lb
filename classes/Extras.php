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

			case 0: // card 8 , suggested bloggers
				self::topFive(5, 12);
				$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
				break;			
			
			case 3: // card 5 , suggested bloggers
				self::featuredBloggers();
				$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
				break;

			case 7: //very first card
				self::tip("Test Tip", "This is a tip that was triggered from the control method of the Extras class");
				$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
				break;

			default:
				# nothing...
				break;
		}
	}

	public static function tip($tipTitle, $tipBody , $tipImage = NULL){
		?>
		<div class="card tip">
			<div class="card_header tip">
			</div>
			<div class="card_body tip">
				<h3><?php echo $tipTitle ; ?></h3>
				<p><?php echo $tipBody ; ?></p>
			</div>
		</div>
		<?php
	}

	public static function featuredBloggers(){
		?>
		<div class="card">
			<div class="card_header redheader">
				<h3 class ="whitefont">Featured Bloggers</h3>
			</div>
			<div class="card_body elastic silverbody">
				<div class="list_type_b">
					<img src="img/thumbs/blogbaladi.jpg" alt="" class="thumb">
					<h3>Blog Baladi</h3>
					<div class ="button-wrapper"><a href="" class="btn btn-red btn-small">explore</a></div>
				</div>
				<div class="list_type_b">
					<img src="img/thumbs/beirutspring.jpg" alt="" class="thumb">
					<h3>Beirut Spring</h3>
					<div class ="button-wrapper"><a href="" class="btn btn-red btn-small">explore</a></div>
				</div>
				<div class="list_type_b">
					<img src="img/thumbs/beirutntsc.jpg" alt="" class="thumb">
					<h3>Beirut NTSC</h3>
					<div class ="button-wrapper"><a href="" class="btn btn-red btn-small">explore</a></div>
				</div>
			</div>
		</div>
		<?php
	}

	public static function topFive($howmany=5, $hours=12, $channel = null){
		
		global $db;
		$top5 = new Posts($db);
		$stats = $top5->get_Top_Posts($hours, $howmany, $channel); 
		;?>
		<div class="card">
			<div class="card_header redheader">
				<h3 class ="whitefont">Top Posts</h3>
			</div>
			
			<div class ="card_body elastic">
			
			<?php
			foreach ($stats as $stat) {
				$img = $stat['post_image'];
				$img_height =$stat['post_image_height'] ;
				$img_width =$stat['post_image_width'] ;
				$title = $stat['post_title'];
				$url = $stat['post_url'];
				$blogger_url = ABSPATH . $stat['blog_id'];
				;?>
			
				<div class="list_type_a">
					<?php
					if (empty($stat['post_image'])) {
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
					<h4><a href ="<?php echo $url ;?>"><?php echo $title ;?></a></h4><h5><a href ="<?php echo $blogger_url; ?>"><?php echo $stat['blog_name'] ;?></a></h5>			
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