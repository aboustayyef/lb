<?php
	$page = "about";
	$title = "About Lebanese Blogs";
	$description = "Why LebaneseBlogs is the best way to browse Lebanon's blogosphere";
	$root_is_at = "..";

  include_once("$root_is_at/includes/top_part.php");
?>

    <div id="entries-main-container">
      <div class ="paper">
	      <div id = "about_info" class="container">
	      	<div class="row">
	      		<br/>
	      		<div class="span8 offset2 last">
      				<p class="lead">
      					<em>Lebanese Blogs</em> is a place to browse the latest posts by the best Lebanese bloggers, laid out in a visually striking way and grouped by topic
      				</p>	      			
	      		</div>
	      	</div>
	      		<div class="row">
		      		<div class="span4 offset2">
				      	<h3>About Lebanese Blogs</h3>
				      	<p><em>LebaneseBlogs</em> is a project that was started by a Lebanese man (a blogger <a href="http://beirutspring.com">himself</a> ) who loves reading other Lebanese blogs.</p>
				      	<p>It was born out of the realization that there must be a more fun way to browse blogs and find out what's going on without the guilt of an unread inbox. Reading blogs is supposed to be fun and breezy, and this is what this website promises to provide</p>
				      	<h3>How does this thing work?</h3>
				      	<p>This website does not rely on external feed fetchers. It has its own robots that cruise the Lebanese blogosphere to find the latest goodies and publish them</p>
				      	<p>There is a database with a list of carefully chosen blogs that is constantly being updated. The database is the basis for a feed fetching script that gathers the latest posts and puts them in another database for posts, which is what this website uses to get its data</p> 		
		      		</div>

		      		<div class="span4">
				      	<h3>How are blogs chosen?</h3>   	
				      	<p>
							In order to provide the best and most relevant experience to browsers, blogs that are indexed in <em>Lebanese Blogs</em> should satisfy some criteria. The blog has to be related to Lebanon has has to have a track record of at least 6 months. Read more about these criteria <a href="bloggers.php">here.</a>
				      	</p>
				      	<h3>Can I get my blog in there?</h3>   	
				      	<p> If you think your blog belongs here and satisfies the criteria, what are you waiting for? <br><a class = "btn btn-info btn-large" href="bloggers.php">Submit it!</a></p>
				    </div>
		      </div>
	      </div>
	    </div> <!-- /container -->
	</div><!-- /page_wrapper -->
<?php 
include_once("$root_is_at/includes/bottom_part.php");
 ?>