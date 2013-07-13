<?php
include_once("$root_is_at/includes/config.php");
include_once("$root_is_at/includes/connection.php");
include_once("$root_is_at/includes/core-functions.php");
include_once("$root_is_at/includes/simple_html_dom.php");
//include_once("$root_is_at/includes/simplepie.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description;?>">
    <meta name="author" content="Mustapha Hamoui">
    <meta property="og:image" content="http://lebaneseblogs.com/img/interface/facebook-og-image.jpg">

    <link href="<?php echo $root_is_at . '/' ;?>css/lebaneseblogs.css?<?php echo time(); ?>" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $root_is_at . '/' ;?>img/interface/lb-apple-icon-144x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $root_is_at . '/' ;?>img/interface/lb-apple-icon-114x114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $root_is_at . '/' ;?>img/interface/lb-apple-icon-72x72.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $root_is_at . '/' ;?>img/interface/lb-apple-icon-57x57.png">
    
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo $root_is_at . '/' ;?>img/interface/favicon.ico"> 
    
    <!-- Google Font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans|Bitter' rel='stylesheet' type='text/css'>

  </head>

  <body>   

      <!-- Navigation -->
      <div id="navigation">
        <div class="navbutton">
          <div id ="menubutton"><a href="#"><img src="<?php echo $root_is_at . '/' ;?>img/interface/navicon.png" width ="20px"></a></div>
        </div><!--/navbutton -->
        <ul class="nav">
          <a href="<?php echo $root_is_at . '/' ;?>."><li <?php if ($page == "home") {echo 'class ="active"';}?>>Home</li></a>
          <a href="<?php echo $root_is_at . '/' ;?>pages/about.php"><li <?php if ($page == "about") {echo 'class ="active"';}?>>About</li></a>
          <a href="<?php echo $root_is_at . '/' ;?>pages/bloggers.php"><li <?php if ($page == "bloggers") {echo 'class ="active"';}?>>Bloggers</li></a>
          <a href="<?php echo $root_is_at . '/' ;?>pages/feedback.php"><li <?php if ($page == "feedback") {echo 'class ="active"';}?>>Feedback</li></a>
          <!-- <a href="<?php echo $root_is_at . '/' ;?>pages/ff.php"><li <?php if ($page == "ff") {echo 'class ="active"';}?>>#FF</li></a> -->
          <li><a href="http://lebaneseblogs.com/blog">Blog</a></li>
        </ul>
      </div>

    <div class="mainbar">
      <!-- logo -->
      <div id ="logo">
        <a href="<?php echo $root_is_at . '/' ;?>">
          <img src ="<?php echo $root_is_at .'/' ;?>img/interface/logo_new_white_275x46x2.png" width ="275" height = "46">
        </a>
      </div>
    </div>
      <!-- search -->
        <div class ="lb_search">
          <form class="form-search" action ="<?php echo $root_is_at ;?>/search/index.php" method ="get">
            <input type="text" class="input-medium search-query span3" name ="s" placeholder ="Search thousands of blog posts">
          </form>
        </div>