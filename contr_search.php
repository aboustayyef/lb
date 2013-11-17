<?php 

require_once('init.php');

$term = $_POST['term'];
$scope = $_POST['scope'];

switch ($scope) {
	case 'blognames':
		$results = Posts::searchBlogNames($term);
		$howmany = count($results);
		if ($howmany>0) { //there are results
			echo "<h3>There are $howmany Blogs with the term '$term' in their Name:</h3>";
			echo '<ul>';
			foreach ($results as $result) {
				echo '<li class ="resultItem">';
					echo '<a href="./'.$result->blog_id.'"><h4>'.$result->blog_name.'</h4></a>';
					echo '<p>'.$result->blog_description.'</p>';
				echo '</li>';
			}
			echo '</ul>';
		} else {
			Echo "<h3 class = \"dimmed\">There are no blogs with the term '$term' in their name</h3>";
		}

		echo '<hr>';
	break;
	
	case 'blogtitles':
		$results = Posts::searchBlogTitles($term);
		$howmany = count($results);
		if ($howmany>0) { //there are results
			echo "<h3>There are $howmany Blog Posts with the term '$term' in their titles:</h3>";
			echo '<ul>';
			foreach ($results as $result) {
				echo '<li class ="resultItem">';
					echo '<div class ="blogname-posttitle"><div class ="blogname">'.$result->blog_name.':</div> <div class ="posttitle"><a href="'.$result->post_url.'">'.$result->post_title.'</a><span class="postdate"> '.Lb_functions::time_elapsed_string($result->post_timestamp).'</span></div></div>';
				echo '</li>';
			}
			echo '</ul>';
		} else {
			Echo "<h3 class = \"dimmed\">There are no Blog Posts with the term '$term' in their titles</h3>";
		}
		echo '<hr>';
	break;	

	case 'blogcontents':
		$results = Posts::searchBlogContents($term);
		$howmany = count($results);
		if ($howmany>0) { //there are results
			echo "<h3>There are $howmany Blog Posts with the term '$term' in their text:</h3>";
			echo '<ul>';
			foreach ($results as $result) {
				echo '<li class ="resultItem">';
					echo '<div class ="blogname-posttitle"><div class ="blogname">'.$result->blog_name.':</div> <div class ="posttitle"><a href="'.$result->post_url.'">'.$result->post_title.'</a><span class="postdate"> '.Lb_functions::time_elapsed_string($result->post_timestamp).'</span></div></div>';
				echo '</li>';
			}
			echo '</ul>';
		} else {
			Echo "<h3 class = \"dimmed\">There are no Blog Posts with the term '$term' in their text</h3>";
		}

		echo '<hr>';
	break;	

	default:
		# code...
		break;
}

?>