<?php 

/************************************************************************************************
*	This is a links debugging tool 														 		*
*																								*
************************************************************************************************/ 

$link = 'UNICEF Sweden recently released its latest ad to raise funds for their children polio vaccination campaign. This spot reminds us, that liking the NGO’s Facebook page does not save live and that even if the page is expected to reach 200,000 likes this summer, it does not necessarily mean that the poor kids in the [...]<img alt="" border="0" src="http://stats.wordpress.com/b.gif?host=thejrexpress.com&blog=15937828&post=2083&subd=expressjr&ref=&feed=1" width="1" height="1">';

require_once "ff/config.php";
require_once("ff/functions.php");
require_once("ff/simple_html_dom.php");


$blog_post_link = $link;
$canonical_resource = $link; 

$html = new simple_html_dom(); 
$html->load($link);

echo "link: ", $blog_post_link,"<br/>";

//get title and image
//$title = $html->find("title",0)->innertext;
//echo "Title: ", $title, "<br/>";

$image = dig_suitable_image($link);
echo "image: $image <br/>";

$images = $html->find("img",0);
echo $images->src;

?>