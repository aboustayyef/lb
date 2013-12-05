<?php 
header('Content-Type: text/html; charset=utf-8');
require_once('init.php');
include_once('media_definitions.php');

//$article = GetArticles::getArticle($now_lebanon, 'https://now.mmedia.me/lb/en/Author/Hanin.Ghadar', 0);

$counter = 0;
while ($counter >= 0) {
	if ($article = GetArticles::getArticle($the_national, 'http://www.thenational.ae/apps/pbcs.dll/search?q=*&NavigatorFilter=[Byline:Michael%20Karam]&BuildNavigators=1', $counter)) {
		echo '<a href="'.$article['link'].'">'.$article['title'].'</a><br>';
		$counter++;
	} else {
		echo '<h2>All Articles Available are displayed</h2>';
		break;
	}
}

?>