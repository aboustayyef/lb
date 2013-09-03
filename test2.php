<?php 

	$a = 'http://whenhopespeaks.wordpress.com/2013/07/29/أصل-الحكي/';
	$b = 'https://whenhopespeaks.wordpress.com/2013/07/29/أصل-الحكي/';

	echo preg_replace('#\bhttp(s?):\/\/#', '', $a);
	echo preg_replace('#\bhttp(s?):\/\/#', '', $b);

	//echo preg_replace("#\bhttp(s?)://#g", '', $b);
	//preg_replace(pattern, replacement, subject)
?>