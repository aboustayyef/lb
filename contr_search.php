<?php 

require_once('init.php');

$term = $_POST['term'];
$scope = $_POST['scope'];

switch ($scope) {
	case 'blognames':
		$results = Lb_Search::searchBlogNames($term);
		$howmany = count($results);
		if ($howmany>0) 
		{ //there are results
			foreach ($results as $result) 
			{

			}

		} 
	break;
	
	case 'blogtitles':
		$results = Lb_Search::searchBlogTitles($term);
		$howmany = count($results);
		if ($howmany>0) { //there are results
			echo "<h3>There are $howmany Blog Posts with the term '$term' in their titles:</h3>";
			echo '<ul>';
			foreach ($results as $result) {
				if (isset($result->blog_name) && !empty($result->blog_name)) {
					$name = $result->blog_name;
				}else{
					$name = $result->col_name;
				}
				echo '<li class ="resultItem">';
					echo '<div class ="blogname-posttitle"><div class ="blogname">'.$name.':</div> <div class ="posttitle"><a href="'.$result->post_url.'">'.$result->post_title.'</a><div class="postdate">&lrm; '.Lb_functions::time_elapsed_string($result->post_timestamp).'</div></div></div>';
				echo '</li>';
			}
			echo '</ul>';
		} else {
			Echo "<h3 class = \"dimmed\">There are no Blog Posts with the term '$term' in their titles</h3>";
		}
		
	break;	

	case 'blogcontents':
		$results = Lb_Search::searchBlogContents($term);
		$howmany = count($results);
		if ($howmany>0) { //there are results
			echo "<h3>There are $howmany Blog Posts with the term '$term' in their text:</h3>";
			echo '<ul>';
			foreach ($results as $result) {
				if (isset($result->blog_name) && !empty($result->blog_name)) {
					$name = $result->blog_name;
				}else{
					$name = $result->col_name;
				}
				echo '<li class ="resultItem">';
					echo '<div class ="blogname-posttitle"><div class ="blogname">'.$name.':</div> <div class ="posttitle"><a href="'.$result->post_url.'">'.$result->post_title.'</a><span class="postdate">&lrm; '.Lb_functions::time_elapsed_string($result->post_timestamp).'</span></div></div>';
				echo '</li>';
			}
			echo '</ul>';
		} else {
			Echo "<h3 class = \"dimmed\">There are no Blog Posts with the term '$term' in their text</h3>";
		}

	break;	

	default:
		# code...
		break;
}

?>