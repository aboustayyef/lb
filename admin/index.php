<?php 

$root_is_at = "..";
include_once("$root_is_at/includes/config.php");
include_once("$root_is_at/includes/connection.php");
include_once("$root_is_at/includes/core-functions.php");

if (admin_logged_in()) 
{
  drawpage();
} else {
  header("location:login.php");
}
?>

<?php 
function drawpage(){
?>

<html>
<head>
    <title>Admin Area</title>
</head>
<body>
<h1>Admin page!</h1>

<?php 
    $dir = getcwd();
    $files = scandir($dir);
    define('ROOT', dirname(__FILE__));
    echo "<ul style =\"list-style:none;padding-left:5px\">";
    foreach ($files as $file) {
        ?>
        <li style ="line-height:1.3em"><a href="<?php echo $file ;?>">/<?php echo $file ;?></a></li>        
        <?php
    }
    echo "</ul>";

 ?>

</body>
</html>

<?php 
} 
?>