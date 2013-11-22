<?php 
global $channel_descriptions;
;?>

<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->_title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $this->_description;?>">
    <meta name="author" content="Mustapha Hamoui">
    <meta property="og:image" content="http://lebaneseblogs.com/img/interface/facebook-og-image.jpg">

    <!-- Main CSS -->
    <?php 
      switch ($this->_page) {
        case 'blogger':
          ;?><link href="<?php echo WEBPATH ;?>css/blogger.css?<?php echo time(); ?>" rel="stylesheet"><?php
          break;
        case 'about':
          ;?><link href="<?php echo WEBPATH ;?>css/pages.css?<?php echo time(); ?>" rel="stylesheet"><?php
          break;
        case 'search':
          ;?><link href="<?php echo WEBPATH ;?>css/search.css?<?php echo time(); ?>" rel="stylesheet"><?php
          break;        
        default:
          ;?><link href="<?php echo WEBPATH ;?>css/lebaneseblogs.css?<?php echo time(); ?>" rel="stylesheet"><?php
          break;
      }
    ?>
    <?php ?>
    
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
      <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Bitter' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
  </head>


<!-- About Menu -->
  <body>
    <script>
      // important: These js variables tell javascript what to initialize
      global_page = "<?php echo $this->_page ?>"; 
      global_viewtype = "<?php echo $this->_view ?>";

    </script>
    <?php include_once ABSPATH."views/modules/modal.inc"; ?>
    <div class = "menu" id="menu-about">
      <ul>
        <a href="<?php echo WEBPATH.'about' ?>"><li>About</li></a>
        <a href="<?php echo WEBPATH.'about#submit' ?>"><li>Submit Your Blog</li></a>
        <a href="<?php echo WEBPATH.'blog'; ?>"><li class ="last" >Our Own Blog</li></a>
      </ul>
    </div>

<!-- Search Menu -->
    <div class="menu" id ="menu-search">
      <form method="get" action="<?php echo WEBPATH ;?>">
        <input type="hidden" name = "pagewanted" value = "search">
        <input id="search-box" type="text" name="s">
        <input type="submit" value ="go" style ="display:none;">
      </form>
        <p>Search thousand of lebanese blog posts. <span class ="strong lbred"><br>Tip:</span> try searching for stores or brands.</p>
    </div>

    <!-- Left Nav -->
    <?php if ($this->_left_column == "yes") {
        include_once(ABSPATH.'views/draw_left_column.php');
    } ?>

    <!-- rest of page -->
  	<div id ="pagewrapper">
      <!-- Navigation -->
      <div class="mainbar-wrapper">
  	    <div class="mainbar">
      		<!-- logo -->
          <?php if (($this->_page == "browse") || ($this->_page == "top") || ($this->_page == "favorites") || ($this->_page == "saved")){
            ;?>
              <a href ="#left-col-wrapper"><div id="hamburger"><i class ="icon-reorder icon-2x"></i></div></a>
            <?php
          } ?>
          
        		<div id ="logo">
            		<a href="<?php echo WEBPATH ;?>">
            		<img class='desktop-logo' src ="<?php echo WEBPATH;?>img/interface/logo-horiz-white.png" >
          		  <img src ="<?php echo WEBPATH;?>img/interface/logo-horiz-white-mobile.png" alt="" class="mobile-logo">
              </a>
        		</div>
            <div id="slogan" class="primaryfont">The best place to discover, read and organize Lebanon's top blogs</div>
            <div class="nav-wrapper">
                <ul id ="menu-icons">
                  <li data-menu="menu-about"><i id ="info" class ="icon-info-sign icon-large"></i></li>
                  <li data-menu="menu-search"><i id ="search" class ="icon-search icon-large"></i></li>
                </ul>
            </div><!-- nav-wrapper -->
      	</div> <!-- /mainbar -->
      </div>
              <img class ="loader" src="img/interface/lb-loader-animated-big-red.gif">

		<div id="content_wrapper"> <!-- the middle section between the header and the footer -->
    <div id ="view-area" style ="opacity:0">
<?php ?>