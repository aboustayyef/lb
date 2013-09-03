<?php 

if (!isset($_GET['img'])) {
	die("Please add an \"img\" parameter to this script: ?img=xxxxxxx ");
}

$image = $_GET['img'];

$adjusted = preg_replace('/-[0-9]{3}x[0-9]{3}\.jpg$/', ".jpg", $image);

echo 'Original image source : '.$image.'<br>';
echo 'adjusted : '.$adjusted.'<br>';

?>