<?php

$channel_descriptions = array(
        "fashion" => "Fashion &amp; Style",
        "society" => "Society &amp; Fun News",
        "design"  => "Advertising &amp; Design",
        "politics" => "Politics &amp; Current Affairs",
        "food" => "Food &amp; Health",
        "tech" => "Business, Tech &amp; Social Media",
  );

  if (isset($_GET['channel'])) {
    $channel = $_GET['channel'];
    $page = "home";
    $title = "Lebanese ".ucfirst($channel)." blogs at Lebanese Blogs";
    $description = "A place to browse the latest posts about $channel in the Lebanese blogosphere in a convenient and visually striking way";
  } else {
    $page = "home";
    $title = "Lebanese Blogs | Latest posts from the best Blogs";
    $description = "A place to browse the latest posts in the Lebanese blogosphere in a convenient and visually striking way";    
  }
  $root_is_at = "."; // important
  include_once("includes/top_part.php");
?>

    <div id="lb_interface">
      <div id ="selector" class ="blogentry" style="opacity:0">
        <select id ="whichchannel">
          <option value = ".">Pick a Channel</option>
          <?php 
            foreach ($channel_descriptions as $this_channel => $ch_description) {
              ;?>         
                <option value =".?channel=<?php echo $this_channel ?>" 
                  <?php 
                  if (isset($channel)) {
                    if ($channel == $this_channel) { 
                      echo "selected" ;
                    } 
                  }
                  ?>
                  >
                  <?php echo $ch_description ?>
                </option>              
              <?php
            }
          ?>        
          <option value = ".">Everything</option>    
        </select>
      </div>
    </div>

    <div id="entries-main-container">
      <div class ="loader" style ="width:100%;text-align:center"><img src="img/interface/ajax-loader.gif"></div>
      

      <?php 
        if (!isset($channel)) {
          $channel = NULL;
        }
        top_5_posts(24, $channel)
      ; ?>


    <?php   

      $posts = get_posts_from_database(0,17,$channel);   
      display_blogs($posts);
    ?>
    </div> <!-- /container -->
    <div class ="endloader" style ="width:100%;text-align:center;margin:2em 0"><img src="img/interface/ajax-loader.gif"></div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<?php 
  include_once("includes/bottom_part.php");
 ?>