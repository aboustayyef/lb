<?php

$channel_descriptions = array(
        "fashion"   => "Fashion &amp; Style",
        "society"   => "Society &amp; Fun News",
        "media"     => "Music, TV &amp; Film",
        "tech"      => "Business &amp Tech",
        "politics"  => "Politics &amp; Current Affairs",
        "design"    => "Advertising &amp; Design",
        "food"      => "Food &amp; Health"
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
<div id="modal_background" style = "display:none">
</div>
<div id="channels_window" style = "display:none"> <!-- modal window -->
  <a href ="#"><i class ="icon-remove-sign icon-large top-right"></i></a>
  <h2>Pick a Channel</h2>
  <div id="window_chooser">
          <ul>
            <a href=".">
              <li <?php if (!isset($channel)) { echo 'class ="selected"';} ?>>
                All
              </li>
            </a>
          <?php 
            foreach ($channel_descriptions as $this_channel => $ch_description) {
              ;?>  
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
            }
          ?>        
        </ul>
    </div>
</div>

    <div id="channels_bar">
      <div id ="selector" class ="content_module" style="opacity:0">
          <ul>
            <li <?php if (!isset($channel)) { echo 'class ="selected"';} ?>>
              <a href=".">All</a>
            </li>
          <?php 
            foreach ($channel_descriptions as $this_channel => $ch_description) {
              ;?>   
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
              <?php
            }
          ?>   
          <a href="#"><li id ="more">More <i class ="icon-caret-down"></i></li></a>           
        </ul>
      </div>
    </div>

    <div id="content_wrapper">
      <div class ="loader" style ="width:100%;text-align:center"><img src="img/interface/ajax-loader.gif"></div>
      

      <?php 
        if (!isset($channel)) {
          $channel = NULL;
        }
        top_5_posts(12, $channel)
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