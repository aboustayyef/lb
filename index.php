<?php 
    require_once("simplepie.php");
    require_once "config.php";
    require_once("functions.php");
    require_once("views.php");
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Lebanese Blogs | Latest posts from the best Blogs</title>
        <meta name="description" content="A place to browse the latest posts in the Lebanese blogosphere in a convenient and visually striking way.">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/lebanonblogs.css?<?php echo time() ?>">
    </head>
    <body>

    <div id="page">          

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="js/blocksit.min.js"></script>
        <script src ="js/jquery.waitforimages.min.js"></script>
        <script>var viewtype ="grid" // default view is grid. Other option is list</script>
        <script type="text/javascript" src = "js/handledimensions.js"></script>

        <div class ="main title">
            <ul><li><img id ="switchToGridView" src="gridview.png" alt = "Switch to Grid View" title = "Switch to Grid View"></li><li><img id ="switchToListView" src="listview.png" alt = "Switch to List View" title = "Switch to List View"></li></ul> 
            <a href ="http://lebaneseblogs.com" style ="color:white;">LebaneseBlogs.com</a>
        </div>
        <div class ="subheader"><a class ="prefopen" href ="#"><img src ="details-icon.png" width ="20"></a> <h2>Browse the latest posts from the best Lebanese blogs.</h2></div>
         
        <div id="prefpanel">
            <div class ="menu">
                <a href = "/blog">Metablog</a> | <a href ="http://twitter.com/lebaneseblogs">Twitter</a>  | Choice of blogs, design &amp; web development by <a href ="http://beirutspring.com">Mustapha Hamoui</a>
            </div>
        </div><!-- /panel -->

        <div id ="wrapper">
            <div id ="main-container">
                <div id ="loader"><img src ="ajax-loader.gif"></div>
                <?php display_blogs(0,20) ?>
            </div>
            <div id ="loadingnew" class = "clearfix" style = "width:100%; padding:5px;text-align:center">
                
                <img src="ajax-loader.gif">

            </div>
        </div>
    
        <footer>

            <div class = "subheader"></div>

            <!-- Start of StatCounter Code for Default Guide -->
                <script type="text/javascript">
                var sc_project=8489889; 
                var sc_invisible=1; 
                var sc_security="6ec3dc93"; 
                var scJsHost = (("https:" == document.location.protocol) ?
                "https://secure." : "http://www.");
                document.write("<sc"+"ript type='text/javascript' src='" +
                scJsHost +
                "statcounter.com/counter/counter.js'></"+"script>");</script>
                <noscript><div class="statcounter"><a title="web counter"
                href="http://statcounter.com/" target="_blank"><img
                class="statcounter"
                src="https://c.statcounter.com/8489889/0/6ec3dc93/1/"
                alt="web counter"></a></div></noscript>
            <!-- End of StatCounter Code for Default Guide -->

        </footer>
    </div>
    </body>
</html>
