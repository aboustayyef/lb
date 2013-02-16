<?php 
    require_once("simplepie.php");
    require_once("functions.php")
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
        <title>Lebanese Blogs</title>
        <meta name="description" content="A place to conveniently browse the latest posts in Lebanese blogs">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/lebanonblogs.css?<?php echo time() ?>">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            content_size();
        });

        $(window).resize(function(){
            content_size();
        });

        function content_size()
            {
            var x = $(window).width();
            var margins= x%320;
            var desiredwidth = x-margins;
            if (x!=desiredwidth) {
            $(".main-container").css("width",desiredwidth);      
            }};
        </script>


        <div class ="main-container">
            <div id ="title" class ="logo_info">
                <img src ="lebanese-blogs-logo.png">
                <p>A place to conveniently browse Lebanese blogs. Blogs are chosen by <a href ="http://beirutspring.com">Mustapha Hamoui</a><br/>&nbsp;<br/><span style ="color:#73120d">(Not even alpha)</span></p>
            </div>
            <?php display_blogs(0,21) ?>
            <div id ="dashboard" class ="logo_info">
                <!-- <img src ="lebanese-blogs-logo.png"> -->
                <p>Check our sister site <a href ="http://beirutspring.info">The Beirut Dashboard</a> for Lebanese tweets and news..</p>
            </div>
        </div>
    
        <footer>

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

    </body>
</html>
