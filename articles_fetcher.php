<?php 

require_once('init.php');

$columnists = DB::getInstance();
$columnists->getAll('columnists');

include_once('media_definitions.php');


// Go through authors
foreach ($columnists->results() as $key => $columnist) {

	$author_media_definition = $columnist->col_media_source_shorthand;
	$author_media_definition = $$author_media_definition;
	echo '<hr>';
	echo 'Getting author '.$columnist->col_name.' at '.$columnist->col_media_source.'<br>';
	// Go through articles
	$counter = 0;
	while ($counter >= 0) {
		if ($article = GetArticles::getArticle($author_media_definition, $columnist->col_home_page, $counter)) {
			
			$url = $article['link'];
			if (Posts::postExists($url)) {
				echo 'Post "'.$article['title'].'" already exists';
				echo "<br>";

				break;
			} else {
				// new post!
				if ((isset($article['image_details']['source'])) && (!empty($article['image_details']['source'])) ) {
					$image_source = $article['image_details']['source'];
					$image_width = $article['image_details']['width'];
					$image_height = $article['image_details']['height'];
				} else {
					$image_source = NULL;
					$image_width = 0;
					$image_height = 0;
				}

				DB::getInstance()->insert('posts', array(
					'post_url'	=>	$article['link'],
					'post_title'	=>	$article['title'],
					'post_image'	=>	$image_source,
					'post_excerpt'	=> 	$article['excerpt'],
					'blog_id'		=>	$columnist->col_shorthand,
					'post_timestamp'	=> $article['timestamp'],
					'post_content'	=> $article['content'],
					'post_image_height'	=> $image_height,
					'post_image_width'	=>	$image_width,
				));

				echo 'added: "'.$article['title'].'"';
				echo "<br>";

				// If you are debugging, uncomment the next line so that just one article of each columnist is inserted
				// break;
			}
			$counter++;
		} else {
			echo '<h2>All Articles Available are displayed</h2>';
			break;
		}
	}

}	

?>