<?php 

require_once('init.php');
require_once(ABSPATH.'classes/simple_html_dom.php');

$url = 'http://feedproxy.google.com/~r/Ritakml/~3/EDeZW55DTDs/';

$html = file_get_html($url);

$text_container = $html->find('.entry-content',0)->find('img');

if ($text_container) {
	foreach ($text_container as $key => $element) {
		if ($element->width > 300) {
			return $element->src;
		}
	}
}


?>