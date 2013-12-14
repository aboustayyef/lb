<?php 

include_once('init.php');
require_once(ABSPATH.'classes/simple_html_dom.php');
$html = file_get_html('http://www.thenational.ae/apps/pbcs.dll/search?q=*&NavigatorFilter=[Byline:Michael%20Karam]&BuildNavigators=1');

echo $html;
