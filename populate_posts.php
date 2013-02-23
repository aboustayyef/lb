<?php 
    require_once("simplepie.php");
    require_once "config.php";
    require_once("functions.php");

    $posts = get_posts($_GET["from"],$_GET["to"]);
    foreach ($posts as $post) {
        echo $post['url'],"<br/>";
    }

?>
