<?php
  $page = "home";
  $title = "Lebanese Blogs | Latest posts from the best Blogs";
  $description = "A place to browse the latest posts in the Lebanese blogosphere in a convenient and visually striking way";
  include_once("includes/top_part.php");
?>
    <div id="entries-main-container">
      <div class ="loader" style ="width:100%;text-align:center"><img src="img/interface/ajax-loader.gif"></div>
      <?php display_blogs(0, 17); ?>
    </div> <!-- /container -->
    <div class ="endloader" style ="width:100%;text-align:center;margin:2em 0"><img src="img/interface/ajax-loader.gif"></div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/document_ready.js?<?php echo time(); ?>"></script>
<?php 
  include_once("includes/bottom_part.php");
 ?>