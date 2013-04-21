<?php
include_once("includes/config.php");
include_once("includes/functions.php");
include_once("includes/core.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description;?>">
    <meta name="author" content="Mustapha Hamoui">

    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        padding-top: 40px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" >
    <link href="css/lebaneseblogs.css?<?php echo time(); ?>" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <!-- <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">-->

<link rel="shortcut icon" href="img/interface/favicon.ico"> 
<link href='http://fonts.googleapis.com/css?family=Open+Sans|Bitter' rel='stylesheet' type='text/css'>

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="js/blocksit.min.js"></script>
    <script src="js/jquery.lazyload.min.js"></script>

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="brand" href=".">Lebaneseblogs.com</a> -->
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <?php if ($page == "home") {echo 'class ="active"';}?>><a href=".">Home</a></li>
              <li <?php if ($page == "about") {echo 'class ="active"';}?>><a href="about.php">About</a></li>
              <li <?php if ($page == "bloggers") {echo 'class ="active"';}?>><a href="bloggers.php">Bloggers</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="logobar">
    	<div class="container">
    		<?php center_item('<img src = "img/interface/logo_new_white_275x46x2.png" width ="275" height = "46">'); ?>
    	</div>
    </div>
    <div class="descriptionbar">
    	<div class="container">
        <?php center_item('
        <h5>Latest posts from the best blogs</h5>
        ') ?>
      </div>
    </div>