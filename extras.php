<?php 

//This loads extra cards
// $key is the

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
	
	case 'blablabla':
		;?>
		<img src ="http://placehold.it/300x300">
		
		<?php

	case 'tip':
		$tipTitle = isset($_POST['tipTitle']) ? $_POST['tipTitle']: NULL;
		$tipText = isset($_POST['tipText']) ? $_POST['tipText']: NULL;
		$tipImage = isset($_POST['tipImage']) ? $_POST['tipImage']: NULL;

		;?>
		
		<div class="card_header tip"></div>
		<div class="card_body nopadding">
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