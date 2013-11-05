<?php 

//This loads extra cards
// $key is the
include_once("config.php"); 
include_once(ABSPATH."includes_new/connection.php");
include_once(ABSPATH."classes/Posts.php");
include_once(ABSPATH."classes/View.php");
include_once(ABSPATH."classes/Image.php");
include_once(ABSPATH."classes/Lb_functions.php");

$key = $_POST['key'];

switch ($key) {
	case 'extraBloggers':
?>
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
<?php
	
	break;
	
	case 'topPosts':
	$top5 = new Posts($db);
	$stats = $top5->get_Top_Posts($hours=12, $howmany = 5) ;?>
		
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
		} ;?>
		</div> <!-- /cards_body -->

	<?php	
	break;
?>

		
		<?php

	case 'tip':
		$tipTitle = isset($_POST['tipTitle']) ? $_POST['tipTitle']: NULL;
		$tipText = isset($_POST['tipText']) ? $_POST['tipText']: NULL;
		$tipImage = isset($_POST['tipImage']) ? $_POST['tipImage']: NULL;

		;?>
		
		<div class="card_header tip"></div>
		<div class="card_body tip">
			<?php 
				if ($tipTitle) {
					echo "<h3>$tipTitle</h3>";
				}
			?>
			<?php 
				if ($tipText) {
					echo "<p>$tipText</p>";
				}
			?>			
			<?php 
				if ($tipImage) {
					echo '<img src="'.$tipImage.'" alt="">';
				}
			?>
			
		</div>
		
		<?php		

	default:
		# code...
		break;
}

?>