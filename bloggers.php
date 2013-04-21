<?php 
$title = "Bloggers | Lebaneseblogs.com";
$description = "Submit your blog to Lebaneseblogs.com";
$page = "bloggers";

include_once("includes/top_part.php");
?>

<div class ="page_wrapper">
	<div class="container">
		<div class="preset2 offset2 span8">
		
		<h2>Submit Your Blog</h2>
		<p>Before you submit your blog, make sure it is not already listed by checking the <a href="#myModal" role="button" data-toggle="modal">list of blogs</a></p>

		<hr>
		<p class ="lead">For your blog to be considered, it needs to fulfill some criteria:</p>
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
	</div>
</div>

<div id ="myModal" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>List of Blogs on lebaneseblogs.com</h3>
  </div>
  <div class="modal-body">
  	<?php 

  		global $db_username, $db_password , $db_host , $db_database;
		$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host. '', $db_username, $db_password );

		//make sure everything is in utf8 for arabic
		$db->query("SET NAMES 'utf8'");
		$db->query("SET CHARACTER SET utf8");
		$db->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");	

		$stmt = $db->query("SELECT * FROM blogs ORDER BY blog_name",PDO::FETCH_ASSOC);
		$rows = $stmt->fetchAll();
		echo "<ul>";
		foreach ($rows as $row) {
		 	echo "<li>", $row['blog_name'],"</li>";
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


include_once("includes/bottom_part.php");
 ?>