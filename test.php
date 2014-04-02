<?php 
	/* testing */
require_once('init.php');
$searchterm = 'Syria';

$results = Lb_Search::searchBlogContents($searchterm);

echo '<pre>';
print_r($results);
echo '</pre>';

?>