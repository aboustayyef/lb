            <div class="endloader">Loading more... </div>
        </div> <!-- /view-area -->
    </div> <!-- /pagewrapper -->
</div>



    <!-- JS Dependencies -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?php echo WEBPATH ;?>js/blocksit.min.js"></script>
    <script src="<?php echo WEBPATH ;?>js/jquery.waitforimages.min.js"></script>
    <script src="<?php echo WEBPATH ;?>js/jquery.lazyload.min.js"></script>

    <!-- App JS -->
    <script src="<?php echo WEBPATH ;?>js/interface.js?<?php //echo time(); ?>"></script>
    

    <?php 
        switch ($_SESSION['viewtype']) {
            case 'cards':
                ?>
                    <script src="<?php echo WEBPATH ;?>js/cards.js?<?php //echo time(); ?>"></script>
                <?php
                break;
            case 'timeline':
                ?>
                    <script src="<?php echo WEBPATH ;?>js/timeline.js?<?php //echo time(); ?>"></script>
                <?php
                break;
            case 'compact':
                ?>
                    <script src="<?php echo WEBPATH ;?>js/compact.js?<?php //echo time(); ?>"></script>
                <?php
                break;
            
            default:
                ?>
                    <script src="<?php echo WEBPATH ;?>js/cards.js?<?php //echo time(); ?>"></script>
                <?php
                break;
        }
    ?>
   

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

            <!-- Start of Google Analytics Code 
                <script>
                    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
                    ga('create', 'UA-40418714-1', 'lebaneseblogs.com');
                    ga('send', 'pageview');
                </script>
    -->
  </body>
</html>
