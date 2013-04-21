<?php
	$page = "about";
	$title = "About Lebanese Blogs";
	$description = "Why LebaneseBlogs is the best way to browse Lebanon's blogosphere";

  include_once("includes/top_part.php");
?>

    <div id="entries-main-container">
      <div class ="page_wrapper">
	      <div class="container">
	      	<div class="row">
	      		<br/>
		      	<div class="span6 offset3 preset3">
			      	<h3>About Lebanese Blogs</h3>
			      	<p><em>LebaneseBlogs</em> is a project that was started by a Lebanese man (a blogger <a href="http://beirutspring.com">himself</a> ) who loves reading other Lebanese blogs.</p>
			      	<p>It was born out of the realization that there must be a more fun way to browse blogs and find out what's going on without the guilt of an unread inbox. Reading blogs is supposed to be fun and breezy, and this is what this website promises to provide</p>
			      	<h3>How does this thing work?</h3>
			      	<p>Are you asking if I go in myself every five minutes and edit the latest posts? Of course not! This website has its own robots that cruise the Lebanese blogosphere to find the latest goodies and publish them</p>
			      	<h3>No really, how?</h3>
			      	<p>There is a database with a list of carefully chosen blogs that is constantly being updated. The database is the basis for a feed fetching script that gathers the latest posts and puts them in another database for posts, which is what this website uses to get its data</p>
			      	<h3>Can I get my blog in there?</h3>
			      	
			      	<p> If you think your blog belongs here, what are you waiting for? <a class = "btn btn-info" href="bloggers.php">Submit it!</a></p>
			      </div>
		      </div>
	      </div>
	    </div> <!-- /container -->
	</div><!-- /page_wrapper -->
<?php 
  include_once("includes/bottom_part.php");
 ?>