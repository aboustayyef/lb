<?php

$root_is_at = "..";
require_once($root_is_at . '/classes/Blog_Details.php');
include_once("$root_is_at/includes/config.php");
include_once("$root_is_at/includes/connection.php");

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

include_once("$root_is_at/includes/top_part.php"); ?>

<div class ="full-white">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h1 class ="details_of_blog">Details of Blog <em><?php echo $blog_at_hand->name() ?></em></h1>
            </div>
        </div>  
        <div class="row">
            <div class="span4">
                <div id ="blog_details" class="well">
                        <table>
                            <td>
                                <tr>
                                    <td style ="width:60px;"><img src ="<?php echo $root_is_at.'/img/thumbs/'.$blogger_id.'.jpg' ;?>" width ="50" style ="border:1px solid grey;"></td>
                                    <td>
                                        <?php 
                                            $blog_description = $blog_at_hand->description();
                                            if (!empty($blog_description)) {
                                                ;?>                              
                                                <p><em><?php echo $blog_at_hand->description(); ?></em></p>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                            </td>
                        </table>
                       
                        <hr>
                        <p><strong>Blog URL: </strong><a href ="<?php echo $blog_at_hand->url(); ?>"><?php echo $blog_at_hand->url(); ?></a><br>
                        <strong>Blog Topics: </strong><?php echo $blog_at_hand->tags(); ?></p>
                        <?php 
                            $blog_twitter= $blog_at_hand->twitter(); 
                            if (!empty($blog_twitter)) {
                                ;?>
                                    <a href="https://twitter.com/<?php echo $blog_twitter ?>" class="twitter-follow-button" data-show-count="false" data-size="large" data-dnt="true">Follow @<?php echo $blog_twitter ?></a>
                                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>                                
                                <?php
                            }
                        ?>
                        <hr>
                        <p><strong>Indexed Posts: </strong><?php echo $blog_at_hand->number_of_posts(); ?><br>
                        <strong>Average posts per week: </strong><?php echo $blog_at_hand->blogs_per_week(); ?></p>
                        <p>(Wrong / Missing details? <a href ="http://twitter.com/beirutspring" class ="lb_underline">send me a tweet</a> )</p>



                </div>
                
            </div>

            <div id ="secondcolumn" class="span8">
                <div id="recent_photos" style ="overflow:auto">
                    
                    <?php 
                        $photo_height = 100;
                        $photos = $blog_at_hand->list_Photos($blogger_id, 6, $photo_height); // (howmany, height of each) 
                        if (!empty($photos)) {
                            echo '<h3>Recent photos</h3>';
                            foreach ($photos as $photo) {
                                echo '<a href ="' . $photo['url'] . '">';
                                echo '<img class ="lazy" data-original ="' . $photo['image'] . '" src = "' . $root_is_at . '/img/interface/grey.gif" height = "'. $photo_height .'" width = "'. $photo['width'] .'" style ="float:left; margin:5px">';
                                echo '</a>';
                            }
                        }                       
                    ?>
                </div>


            <div id ="top_posts">
                    <h3>
                        Top Posts
                    </h3>
                        <?php 
                            $posts = $blog_at_hand->list_Posts(3, "post_visits");
                            foreach ($posts as $key => $post) {
                                echo '<div class ="post_list">';
                                echo '<a href ="'. $post['post_url'] .'">';
                                echo $post['post_title'], "<br/>";
                                echo '</a>';
                                echo '</div>';
                            }
                        ?>
                </div>

                <?php 
                    $posts = $blog_at_hand->list_Posts(40, "post_timestamp");
                    echo '<h3>Latest posts</h3>';
                    foreach ($posts as $key => $post) {
                        echo '<div class ="post_list"';
                        if (contains_arabic($post['post_title'])) {
                            echo ' style ="direction:rtl;text-align:left;"';
                        }
                        echo '>';
                                echo '<a href ="'. $post['post_url'] .'">';
                                echo $post['post_title'];
                                echo '</a> <span class ="daysago">'.days_ago($post['post_timestamp']).' days ago</span>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("img.lazy").lazyload({ 
            effect : "fadeIn",
            threshold : 500
    });
</script>

<?php 
include_once("$root_is_at/includes/bottom_part.php");
?>