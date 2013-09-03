<?php 
$title = "Bloggers | Lebaneseblogs.com";
$description = "Submit your blog to Lebaneseblogs.com";
$page = "bloggers";
$root_is_at = "..";
include_once("$root_is_at/includes/top_part.php");
?>

    	<div class="text_content">
			<h1 class ="lb_red">Bloggers Central</h1>
			<hr>
			<div class="span6">
				<h2>Submit your blog</h2>
				<p>Before you submit your blog, make sure it is not already listed. To know if your blog is listed, use this website's search box above (you can search for your blog's url or title)
				<hr>
				<h2>For your blog to be considered, it needs to fulfill some criteria:</h2>
				<ul>
					<li>The blogger has to be either Lebanese, Living in Lebanon or writing about Lebanon</li>
					<li>The blog should be at least 6 month old with an average of at least one post per week</li>
					<li>The blog should be personal, not commercial or institutional</li>
					<li>The blog should not be a vehicle for ads or spam in the posts</li>
				</ul>
				<?php 
				if (isset($_POST["submit"])) {
					$submitted = $_POST['submittedUrl'];
					mail("mustapha.hamoui@gmail.com", "[lebaneseblogs.com] SUBMISSION", $submitted);
					echo '<div class="alert-success">Your suggestion has been submitted! <a class ="btn btn-small" href ="bloggers.php">Submit another?</a></div>';

				} else {
					drawform();
				}
				
				?>
			</div>
			<div class="span5 last well">
				<h2>Share the love</h2>
				<p>If your blog is already listed, why don't you spread the word with a badge? Just pick a badge from below and copy-paste the code in your blog</p>
				<hr>
				<img src="<?php echo $root_is_at ; ?>/img/interface/badge160x160.png">
					<textarea readonly rows ="5" cols="45" style="resize:none"><a href="http://lebaneseblogs.com"><img src="http://lebaneseblogs.com/img/interface/badge160x160.png"></a>
					</textarea>	
				<hr>
				<img src="<?php echo $root_is_at ; ?>/img/interface/badge220x220.png">
				<textarea readonly rows ="5" cols="45" style="resize:none"><a href="http://lebaneseblogs.com"><img src="http://lebaneseblogs.com/img/interface/badge220x220.png"></a>
				</textarea>	
				<hr>
			</div>
		</div>
<?php 

function drawform($errormessage=NULL){
	?>

		<form method ="post" action ="bloggers.php" >
		  <h3>Ready to submit ?</h3>
		  <fieldset>
		    <label>Blog URL</label>
		    <input type="text" placeholder="Example: blogbaladi.com" name = "submittedUrl">
		    <p class = "small">The blog will be reviewed for the criteria above and then added to the list. New blogs are added in batches <button type="submit" name ="submit" class="btn btn-large">Submit</button></p>
		  </fieldset>
		</form>



	<?php
}


include_once("$root_is_at/includes/bottom_part.php");
 ?>