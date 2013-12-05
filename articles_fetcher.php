<?php 

require_once('init.php');

$columnists = DB::getInstance();
$columnists->getAll('columnists');

include_once('media_definitions.php');


// Go through authors
foreach ($columnists->results() as $key => $columnist) {

	$author_media_definition = $columnist->col_media_source_shorthand;
	$author_media_definition = $$author_media_definition;


	// Go through articles
	$counter = 0;
	while ($counter >= 0) {
		if ($article = GetArticles::getArticle($author_media_definition, $columnist->col_home_page, $counter)) {
			
			// check if article exists in database
			//--> yes
			//	 	|break
			//--> No
			//		| store post

			echo '<a href="'.$article['link'].'">'.$article['title'].'</a><br>';
			$counter++;
		} else {
			echo '<h2>All Articles Available are displayed</h2>';
			break;
		}
	}

}	

?>