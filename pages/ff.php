<?php 
$title = "FF | Lebaneseblogs.com";
$description = "Follow all our bloggers on Twitter";
$page = "ff";
$root_is_at = "..";
include_once("$root_is_at/includes/top_part.php");
?>


    <div id="entries-main-container">
        <div class="text_content">
		<h1 class ="lb_red">#FF - Follow all our bloggers on twitter!</h1>
		<hr>
		<p>Note: This page is a bit heavy on Javascript from twitter, so your web browser will take a bit of time to render it. Please be patient if the page shows nothing but white.</p>
		<h3>Share this list on twitter  
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://lebaneseblogs.com/ff.php" data-text="The definitive list of Lebanese Bloggers to follow on Twitter!" data-size="large" data-related="lebaneseblogs" data-hashtags="FF">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</h3>
		<hr>
		<div class ="row">
			<div class="span11 last">
<?php 
	global $db_username, $db_password , $db_host , $db_database;
	$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host. '', $db_username, $db_password);

	$db->query("SET NAMES 'utf8'");
	$db->query("SET CHARACTER SET utf8");
	$db->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");

	$query = "SELECT blog_author_twitter_username from blogs WHERE blog_author_twitter_username IS NOT NULL ORDER by RAND()";
	$stmt = $db->query($query, PDO::FETCH_ASSOC);
	$posts = $stmt->fetchAll();
	foreach ($posts as $post) {

;?>

		<a href="https://twitter.com/<?php echo $post['blog_author_twitter_username'] ?>" class="twitter-follow-button" data-show-count="false" data-size="large" data-dnt="true">Follow @<?php echo $post['blog_author_twitter_username'] ?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<?php

	}
 ?>
			</div>
		</div>
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