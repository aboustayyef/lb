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
    	<div id="navigation">
	    	<div class="navbutton">
	        	<div id ="menubutton">
	        		<a href="#leftnav"><img src="<?php echo WEBPATH ;?>img/interface/navicon.png" width ="20px"></a>
	        	</div>
	        </div><!--/navbutton -->
	        <ul class="nav">
	          <a href="<?php echo WEBPATH ;?>."><li <?php if ($this->_page == "home") {echo 'class ="active"';}?>>Home</li></a>
	          <a href="<?php echo WEBPATH ;?>pages/about.php"><li <?php if ($this->_page == "about") {echo 'class ="active"';}?>>About</li></a>
	          <a href="<?php echo WEBPATH ;?>pages/bloggers.php"><li <?php if ($this->_page == "bloggers") {echo 'class ="active"';}?>>Bloggers</li></a>
	          <a href="<?php echo WEBPATH ;?>pages/feedback.php"><li <?php if ($this->_page == "feedback") {echo 'class ="active"';}?>>Feedback</li></a>
	          <!-- <a href="<?php echo WEBPATH ;?>pages/ff.php"><li <?php if ($this->_page == "ff") {echo 'class ="active"';}?>>#FF</li></a> -->
	          <li><a href="http://lebaneseblogs.com/blog">Blog</a></li>
	        </ul>
      	</div> <!-- /navigation -->
	    <div class="mainbar">
    		<!-- logo -->
      		<div id ="logo">
        		<a href="<?php echo WEBPATH ;?>">
          		<img src ="<?php echo WEBPATH;?>img/interface/logo_new_white_275x46x2.png" width ="275" height = "46">
        		</a>
      		</div>
    	</div> <!-- /mainbar -->
      	
      	<!-- search -->
        <div class ="lb_search">
        	<form class="form-search" action ="<?php echo WEBPATH ?>search/index.php" method ="get">
            	<input type="text" class="input-medium search-query span3" name ="s" placeholder ="Search thousands of blog posts">
          	</form>
        </div>

        <div id="modal_background" style = "display:none"></div>	
		<div id="channels_window" style = "display:none"> <!-- modal window -->
			<a href ="#"><i class ="icon-remove-sign icon-large top-right"></i></a>
			<h2>Pick a Channel</h2>
			<div id="window_chooser">
	  			<ul>
	    			<a href=".">
	      				<li <?php if (!isset($channel)) { echo 'class ="selected"';} ?>> All</li>
	    			</a>
	  			<?php 
	    		foreach ($channel_descriptions as $this_channel => $ch_description) {;?>  
	        		<a href = "<?php echo '.?channel='.$this_channel; ?>"> 
	          		<li
		          		<?php 
		            		if (isset($channel)) {
		              			if ($channel == $this_channel) { 
		                			echo 'class ="selected"' ;
		              			} 
		            		}
		            	?>
		          		>      
		          		<?php echo $ch_description ;?>
	          		</li>              
	        		</a> 
	      		<?php
	    		} ?>        
				</ul>
			</div>
		</div>

		<div id="channels_bar">
			<div id ="selector" class ="card" style="opacity:0">
				<ul>
					<li <?php if (!isset($channel)) { echo 'class ="selected"';} ?>>
					  <a href=".">All</a>
					</li>
					<?php 
					foreach ($channel_descriptions as $this_channel => $ch_description) {;?>   
				    <li
					    <?php 
					      if (isset($channel)) {
					        if ($channel == $this_channel) { 
					          echo 'class ="selected"' ;
					        } 
					      }
					      ?>
					    >      
					    <a href = "<?php echo '.?channel='.$this_channel; ?>"><?php echo $ch_description ;?></a> 
				    </li>
  <?php } ?>   
					<a href="#"><li id ="more">More <i class ="icon-caret-down"></i></li></a>           
				</ul>
			</div>
		</div> <!-- /channels_bar -->
		<div class ="loader" style ="position:absolute;top:70px;padding:20px;background-color:#B4B4B4;width:100%;text-align:center"><img src="img/interface/loadinfo.net.gif"></div>
		<div id="content_wrapper">

<?php ?>