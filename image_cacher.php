<?php
require_once('init.php');
$connection = DB::getInstance();
$connection->query('SELECT `post_image`, `post_timestamp` FROM `posts` WHERE `post_image_width` > 0 ORDER BY `post_timestamp` DESC LIMIT 100' );

$line_length = 70;
$hr  = "\n".str_repeat('-', $line_length)."\n";
$dhr = "\n".str_repeat('=', $line_length)."\n";

echo $dhr."IMAGE CACHING SCRIPT BEGINS".$dhr;

foreach ($connection->results() as $key => $row) {

$outFile = 'img/cache/'.$row->post_timestamp.'.'.Lb_functions::get_image_format($row->post_image);
$image = new Imagick($row->post_image);
$image->thumbnailImage(278,0);
if (file_exists($outFile)) {
	echo $outFile.' already exists'."\n";
	break;
}
$image->writeImage($outFile);

echo 'added '.$outFile."\n";

}

?>