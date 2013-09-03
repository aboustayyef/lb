<?php

$root_is_at = "..";
require_once($root_is_at . '/classes/Blog_Details.php');
include_once("$root_is_at/includes/config.php");
include_once("$root_is_at/includes/connection.php");
include_once("$root_is_at/blogger/blogger_functions.php");

// can't proceed without a blogger's id
if (isset($_GET['id'])) {
    $blogger_id = $_GET['id'];
} else {
    break;
}

//instantiate Blog_Details class
$blog_at_hand = new Blog_Details($db, $blogger_id);

$page = "bloggers";
$title = $blog_at_hand->name() . " at Lebanese Blogs";
$description = "Details for blogger " . $blog_at_hand->name();
$tags = explode("," , $blog_at_hand->tags());

include_once("$root_is_at/includes/top_part.php"); ?>


    <div id="blog_details" style ="display:none" >
        <div class="blog_wrapper">
            <div class="c1">
                <img src ="<?php echo $root_is_at.'/img/thumbs/'.$blogger_id.'.jpg' ;?>" width ="50">
                <h1><?php echo $blog_at_hand->name() ?></h1>
            </div>
            <div class="c2">
                <?php 
                    $blog_description = $blog_at_hand->description();
                    if (!empty($blog_description)) {
                        ;?>                           
                            <p><em><?php echo $blog_at_hand->description(); ?></em>
                        <?php
                        }
                        echo "<br>";
                   foreach ($tags as $key => $tag) {
                        $tag = trim($tag);
                        if (route_keyword($tag)) { // direct to parent tag
                            echo '<a href ="'.$root_is_at.'/?channel='.route_keyword($tag).'">';
                        } else {
                            echo '<a href ="'.$root_is_at.'"">';
                        }
                        echo '#'.$tag.'</a>&nbsp;&nbsp;';
                    }
                    echo "</p>";

                    ?>
                    <ul class="buttons">
                        <li>
                            <a href ="<?php echo $blog_at_hand->url() ?>" ><button type ="button"><i class ="icon-signin icon-large"></i>&nbsp;&nbsp;&nbsp;Go to blog</button></a>
                        </li>
                        <li>
                        <?php 
                        $blog_twitter= $blog_at_hand->twitter(); 
                        if (!empty($blog_twitter)) {
                            ?>
                            <a href="https://twitter.com/<?php echo $blog_twitter ?>" class="twitter-follow-button" data-show-count="false" data-size="large" data-dnt="true">Follow @<?php echo $blog_twitter ?></a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>                               
                                <?php
                            }
                        ?>
                        </li>
                    </ul>
            </div>
        </div>
    </div>

    <div id="blogger_content_wrapper">
        <div class ="loader" style ="width:100%;text-align:center">
            <img src="../img/interface/ajax-loader.gif">
        </div>
      


    <?php   
        
        if ($blog_at_hand->number_of_posts()> 50) {
            $howMuchToShow = 50;
        }   else {
            $howMuchToShow = $blog_at_hand->number_of_posts();
        }
        $posts = get_blogger_posts_from_database(0, $howMuchToShow, $blogger_id);   
        display_blogger_blogs($posts);
    ?>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<?php 
  include_once("$root_is_at/includes/bottom_part.php");
 ?>