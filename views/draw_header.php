<?php 
global $channel_descriptions;
;?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->_title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $this->_description;?>">
    <meta name="author" content="Mustapha Hamoui">
    <meta property="og:image" content="http://lebaneseblogs.com/img/interface/facebook-og-image.jpg">

    <!-- Main CSS -->
    <link href="<?php echo WEBPATH ;?>css/lebaneseblogs.css?<?php echo time(); ?>" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" type="text/css" href="<?php echo WEBPATH ;?>css/font-awesome/css/font-awesome.min.css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->



    <!-- touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo WEBPATH ;?>img/interface/lb-apple-icon-144x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo WEBPATH ;?>img/interface/lb-apple-icon-114x114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo WEBPATH ;?>img/interface/lb-apple-icon-72x72.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo WEBPATH ;?>img/interface/lb-apple-icon-57x57.png">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo WEBPATH ;?>img/interface/favicon.ico"> 
    
    <!-- Google Font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans|Bitter' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
  </head>

  <body>
  	<div id ="pagewrapper">
      <!-- Navigation -->
      <div class="mainbar-wrapper">
  	    <div class="mainbar">
      		<!-- logo -->
        		<div id ="logo">
          		<a href="<?php echo WEBPATH ;?>">
            		<img src ="<?php echo WEBPATH;?>img/interface/logo-horiz-white.png" width ="250" height = "40">
          		</a>
        		</div>
            <div class="nav-wrapper">
              <div id="menu">
                <ul>
                  <li><a href="#">Sign in  <i class ="icon-signin"></i></a></li>
                  <li><a href="#">FAQ - About</a></li>
                  <li><a href="#">Submit Blog</a></li>
                  <li class ="search"><a href="#"><i id ="searchtoggle" class ="icon-search icon-large"></i></a><input id ="search" type="text" placeholder ="search"></li>
                </ul>
              </div>
            </div><!-- nav-wrapper -->
      	</div> <!-- /mainbar -->
      </div>
		<div id="content_wrapper"> <!-- the middle section between the header and the footer -->
			<div class ="loader">
        <img src="img/interface/loadinfo.net.gif">
      </div>
      <?php include_once(ABSPATH.'views/draw_left_column.php'); ?>
    <div id ="view-area">
<?php ?>