<?php 

require_once('init.php');

$columnists = DB::getInstance();
$columnists->getAll('columnists');

include_once('media_definitions.php');


// Go through authors
foreach ($columnists->results() as $key => $columnist) {

		// extract media definition of that author
		$media = $columnist->col_media_source_shorthand;
		$author_media_definition = $$media;

		$author_list_of_posts = GetArticles::getList($author_media_definition, $columnist->col_home_page, 1);
		echo "<pre>";
		print_r($author_list_of_posts);
		echo "</pre>";
	}
	

?>