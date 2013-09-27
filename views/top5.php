<?php 

?>
<div id ="top_posts" class ="card" style="opacity:0">
	<div class = "card_header top_posts_module <?php if (isset($_SESSION['channel'])) {echo $_SESSION['channel'];} ?>">
		<table>
			<tr>
				<td>
					<img src ="img/interface/up.png" width ="35px" style ="border:none">
				</td>
				<td>
					<?php if (isset($_SESSION['channel'])) {
						$channel = $_SESSION['channel'];
						echo "<h2>Hot posts in {$channel_descriptions[$channel]}</h2>";
					} else {
						echo "<h2>Hot Posts</h2>";
					} ?>
				</td>
			</tr>

		</table>
	</div>
	<div class ="card_body">
		
<?php

	foreach ($posts as $post) {
		$img = $post['post_image'];
		$img_height =$post['post_image_height'] ;
		$img_width =$post['post_image_width'] ;
		$title = $post['post_title'];
		$url = $post['post_url'];
		$blogger_url = WEBPATH . $post['blog_id'];
		;?>
		
		<table>
			<tr>
				<?php
				if (empty($post['post_image'])) {
					;?>
					<td width ="85px">
						<a href ="<?php echo $url ;?>">
							<div class="top_thumbs">
								<img class="lazy" data-original ="<?php echo "img/interface/no-image.jpg" ;?>" src="img/interface/grey.gif" height ="75px">
							</div>	
						</a>
					</td>				
					<?php
				}else {
					if ($img_width >= $img_height) {
						;?>				
							<td width ="85px">
								<a href ="<?php echo $url ;?>">
									<div class="top_thumbs">
										<img class="lazy" data-original ="<?php echo $img ;?>" src="img/interface/grey.gif" height ="75px">
									</div>
								</a>
							</td>
						<?php
					} else {
						;?>
							<td width ="85px">
								<a href ="<?php echo $url ;?>">
									<div class="top_thumbs">
										<img class="lazy" data-original ="<?php echo $img ;?>" src="img/interface/grey.gif" width = "75px">
									</div>
								</a>
							</td>						
						<?php
					}
				}
				?>
				<td><h4><a href ="<?php echo $url ;?>"><?php echo $title ;?></a></h4><h5><a href ="<?php echo $blogger_url; ?>"><?php echo $post['blog_name'] ;?></a></h5></td>
				
			</tr>
		</table>
		<hr>
		
		<?php
		//echo '<div class ="post_wrapper"><img src ="'.$img.'" width ="25"><div class ="info_wrapper"><a href ="'.$url.'"><h4>'.$title.'</h4></a></div>'.$post['blog_name'].'</div>';
	} echo "</div>";
	;?>
	
	<div class ="card_footer"></div>
	</div>