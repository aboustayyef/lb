<?php

/*require_once "config.php";

$db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host . '', $db_username, $db_password);

//make sure everything is in utf8 for arabic
$db->query("SET NAMES 'utf8'");
$db->query("SET CHARACTER SET utf8");
$db->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");

$stmnt = $db->query($name_query,PDO::FETCH_NUM);

$result = $stmnt->fetch();
echo "The Blog's name is $result[0]";

*/

require_once "simple_html_dom.php";

$content = '<img src="http://24.media.tumblr.com/b8d4ff29c00f27a391ee0bb08f48d4d8/tumblr_mk621lZkt01r188pco1_500.jpg"><br><br><p>That’s about the closest I’ll ever get to a French manicure';

$html = str_get_html($content);
foreach ($html->find('img[src]') as $img) {
    $image =$img->getAttribute('src');
    echo $image ,"<br/>";
    list($width, $height, $type, $attr) = getimagesize("$image");
    echo $width,"<br>";
}
?>