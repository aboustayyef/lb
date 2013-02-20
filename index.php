<?php 
    require_once("simplepie.php");
    require_once("functions.php");
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
        <link rel="stylesheet" type="text/css" href="css/lebanonblogs.css?<?php echo time() ?>">
    </head>
    <body>

    <div id="page">          

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <h1 class ="main title"><a href ="http://lebaneseblogs.com" style ="color:white;">LebaneseBlogs.com</a></h1>
        <div class ="subheader"><a class ="prefopen" href ="#"><img src ="http://placehold.it/20x20"></a> <h2>A place to browse the latest posts from the best Lebanese blogs.</h2></div>
         <div id="prefpanel">
            <p>this is a test</p>
        </div><!-- /panel -->


    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/blocksit.min.js"></script>
    <script src ="js/jquery.waitforimages.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            content_size();
            $('#main-container').waitForImages(function() {
                $('#main-container').BlocksIt({
                  numOfCol: how_many_columns(),
                  offsetX: 10,
                  offsetY: 10,
                  blockElement: '.blogentry'
                });
                $('#loader').fadeTo('fast', 0   , function(){});
                $('.blogentry').fadeTo('slow', 1, function(){});
                $('.prefopen img').fadeTo('slow',1, function(){});           
            });
            $( ".prefopen" ).click(function(){
                $("#prefpanel").slideToggle("fast");
            });

        });

        
        $(window).resize(function(){
            content_size();
            $('#main-container').waitForImages(function() {
                $('#main-container').BlocksIt({
                  numOfCol: how_many_columns(),
                  offsetX: 10,
                  offsetY: 10,
                  blockElement: '.blogentry'
                });
            });
        }); 
        

        function content_size()
            {
            var x = $(window).width();
            var margins= x%320;
            var desiredwidth = x-margins;
            if (x!=desiredwidth) {
            $("#wrapper").css("width",desiredwidth);      
            }};
        
        var how_many_columns = function(){
            var x = $(window).width();
            var margins= x%320;
            var desiredwidth = x-margins;
            var columns = desiredwidth/320;
            return columns;
        }
       </script>

        <div id ="wrapper">
            <div id ="main-container">
                <div id ="loader"><img src ="ajax-loader.gif"></div>
                <?php display_blogs(0,20) ?>
            </div>
        </div>
    
        <footer>

            <div class = "subheader">Feedback? We're on <a href="http://twitter.com/lebaneseblogs" style ="color:yellow">Twitter</a><br/><small>Choice of blogs, design &amp; web development by <a href ="http://beirutspring.com">Mustapha Hamoui</a></small></div>

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
