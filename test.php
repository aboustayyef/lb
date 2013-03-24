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

$content = '<img width="300" height="300" src="http://www.nogarlicnoonions.com/wp-content/uploads/2013/03/Lets_Burger_Blueberry_Square_Dbayeh77-300x300.jpg" alt="Lets_Burger_Blueberry_Square_Dbayeh77">Blueberry Square here I come. After the opening of Blueberry Square Dbayeh, I decided to visit its restaurants one after the other in order to check what this new hub has to offer. As my love for burgers still goes strong, Let’s Burger was the first place to try on the list. Driving there, I<a href="http://www.nogarlicnoonions.com/lets-enjoy-blueberry-square-and-burger-somewhere-else/">  »more...</a>';

$html = str_get_html($content);
foreach ($html->find('img[src]') as $img) {
    echo $img->getAttribute('src'),"<br/>";
    echo $img->getAttribute('width'),"<br/>";
}
?>