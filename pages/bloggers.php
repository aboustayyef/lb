<?php 
$title = "Bloggers | Lebaneseblogs.com";
$description = "Submit your blog to Lebaneseblogs.com";
$page = "bloggers";
$root_is_at = "..";
include_once("$root_is_at/includes/top_part.php");
?>


<div class ="paper">
	<div class="container">
		<h1 class ="lb_red">Bloggers Central</h1>
		<hr>
		<div class ="row">
			<div class="span6">
				<h2>Submit your blog</h2>
				<p>Before you submit your blog, make sure it is not already listed by checking the <a href="#myModal" role="button" data-toggle="modal" style ="text-decoration:underline">list of blogs</a></p>
				<hr>
				<p class ="lead lb_red">For your blog to be considered, it needs to fulfill some criteria:</p>
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
					echo '<div class="alert alert-success">Your suggestion has been submitted! <a class ="btn btn-small" href ="bloggers.php">Submit another?</a></div>';

				} else {
					drawform();
				}
				
				?>
			</div>
			<div class="span5 last well">
				<h2>Share the love</h2>
				<p>If you're already on the <a href="#myModal" role="button" data-toggle="modal" style ="text-decoration:underline">list</a>, why don't you spread the word with a badge? Just pick a badge from below and copy-paste the code in your blog</p>
				<img src="<?php echo $root_is_at ; ?>/img/interface/badge160x160.png">
					<textarea readonly rows ="3"class ="span4" style="resize:none"><a href="http://lebaneseblogs.com"><img src="http://lebaneseblogs.com/img/interface/badge160x160.png"></a>
					</textarea>	
				<img src="<?php echo $root_is_at ; ?>/img/interface/badge220x220.png">
				<textarea readonly rows ="3"class ="span4" style="resize:none"><a href="http://lebaneseblogs.com"><img src="http://lebaneseblogs.com/img/interface/badge220x220.png"></a>
				</textarea>	
			</div>
		</div>
	</div>
</div>

<div id ="myModal" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>List of Blogs on lebaneseblogs.com</h3>
  </div>
  <div class="modal-body">
  	<?php 

  		global $db;
		$stmt = $db->query("SELECT * FROM blogs ORDER BY blog_name",PDO::FETCH_ASSOC);
		$rows = $stmt->fetchAll();
		echo "<ul>";
		foreach ($rows as $row) {
		 	echo '<li><a href="' . $root_is_at . '/blogger/?id=' . $row['blog_id'] . '">'. $row['blog_name'],'</a></li>';
		 } 
		 echo "</ul>";
  	 ?>

  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="Close">modal</a>
  </div>
</div>

<?php 

function drawform($errormessage=NULL){
	?>

		<form method ="post" action ="bloggers.php" >
		  <legend>Ready to submit ?</legend>
		  <fieldset>
		    <label>Blog URL</label>
		    <input type="text" placeholder="Example: blogbaladi.com" name = "submittedUrl">
		    <span class="help-block">The blog will be reviewed for the criteria above and then added to the list. New blogs are added in batches</span>
		    <button type="submit" name ="submit" class="btn btn-large">Submit</button>
		  </fieldset>
		</form>



	<?php
}


include_once("$root_is_at/includes/bottom_part.php");
 ?>