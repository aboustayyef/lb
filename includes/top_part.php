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

    <!-- Le styles -->
    <link href="<?php echo $root_is_at . '/' ;?>css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        padding-top: 40px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="<?php echo $root_is_at . '/' ;?>css/bootstrap-responsive.min.css" rel="stylesheet" >
    <link href="<?php echo $root_is_at . '/' ;?>css/lebaneseblogs.css?<?php echo time(); ?>" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $root_is_at . '/' ;?>img/interface/lb-apple-icon-144x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $root_is_at . '/' ;?>img/interface/lb-apple-icon-114x114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $root_is_at . '/' ;?>img/interface/lb-apple-icon-72x72.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $root_is_at . '/' ;?>img/interface/lb-apple-icon-57x57.png">

<link rel="shortcut icon" href="<?php echo $root_is_at . '/' ;?>img/interface/favicon.ico"> 
<link href='http://fonts.googleapis.com/css?family=Open+Sans|Bitter' rel='stylesheet' type='text/css'>

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="<?php echo $root_is_at . '/' ;?>js/blocksit.min.js"></script>
    <script src="<?php echo $root_is_at . '/' ;?>js/bootstrap.js"></script>
    <script src="<?php echo $root_is_at . '/' ;?>js/jquery.lazyload.min.js"></script>
    <script src="<?php echo $root_is_at . '/' ;?>js/jquery.waitforimages.min.js"></script>

  </head>

  <body>
    <form class="form-search" action ="<?php echo $root_is_at ;?>/search/index.php" method ="get">
      <input type="text" class="input-medium search-query span3" name ="s" placeholder ="Search thousands of blog posts">
    </form>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="brand" href=".">Lebaneseblogs.com</a> -->
          <a href ="<?php echo $root_is_at . '/' ;?>."><img id ="mobile-logo" src ="<?php echo $root_is_at . '/' ;?>img/interface/white-logo-horizontal-h100.png" height ="50"></a>

          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <?php if ($page == "home") {echo 'class ="active"';}?>><a href="<?php echo $root_is_at . '/' ;?>.">Home</a></li>
              <li <?php if ($page == "about") {echo 'class ="active"';}?>><a href="<?php echo $root_is_at . '/' ;?>pages/about.php">About</a></li>
              <li <?php if ($page == "bloggers") {echo 'class ="active"';}?>><a href="<?php echo $root_is_at . '/' ;?>pages/bloggers.php">Bloggers</a></li>
              <li <?php if ($page == "feedback") {echo 'class ="active"';}?>><a href="<?php echo $root_is_at . '/' ;?>pages/feedback.php">Feedback</a></li>
              <li <?php if ($page == "ff") {echo 'class ="active"';}?>><a href="<?php echo $root_is_at . '/' ;?>pages/ff.php">#FF</a></li>
              <li><a href="http://lebaneseblogs.com/blog">Blog</a></li>
            </ul>
          </div><!--/.nav-collapse -->

        </div>
      </div>
    </div>
    <div class="logobar">
    	<div class="container">
        <a href="<?php echo $root_is_at . '/' ;?>">
          <img src ="<?php echo $root_is_at .'/' ;?>img/interface/logo_new_white_275x46x2.png" width ="275" height = "46">
        </a>
    	</div>
    </div>
    <div class="descriptionbar visible-phone">
        <form class="form-search-mobile" action ="search/index.php" method ="get">
          <input type="text" class="input-medium search-query span2" name ="s" placeholder ="Search thousands of blog posts">
        </form>      
    </div>