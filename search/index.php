<?php

$page = "search";
$title = "Search Lebanese Blogs";
$description = "The best search engine for Lebanese blogs and the Lebanese blogosphere";
$root_is_at = "..";

include_once("$root_is_at/includes/config.php");
include_once("$root_is_at/includes/connection.php");
include_once("$root_is_at/includes/top_part.php");

$search_phrase =$_GET['s']; 
$number_of_results = 0;


?>
<div class ="full-white">
<div class ="container">

<?php if (isset($search_phrase)) 
{
    // remove quotations users may have added
    $search_phrase = trim($search_phrase,'"');
    $search_phrase = trim($search_phrase,"'");
    $search_phrase = trim($search_phrase);
?>


    <div class="row">
            <h2>
                Search result for <?php echo '<span class ="search_string">',$search_phrase,"</span>" ; ?>
            </h2>
    </div>
    <div class="row">

        <div class="span12">
            <?php

                /*******************************************************************
                *   First Match: matching of blog name
                *
                ********************************************************************/ 

                $stmt = $db->query('SELECT blog_name, blog_url, blog_description FROM blogs WHERE MATCH(blog_name) AGAINST (\'"'.$search_phrase.'"\' IN BOOLEAN MODE) ORDER BY blog_name DESC');
                $results = $stmt->fetchALL();

                if ($results[0]['blog_name']=="") 
                {
                    # if no results do nothing ...
                } 
                else 
                {
                    $number_of_results++;
                    echo '<h3 class ="search_results">Blog Matches</h3>';
                    foreach ($results as $result) 
                    {
                        ;?>
                        <div class="resultline">
                        <strong><a href ="<?php echo $result['blog_url']; ?>"><?php echo $result['blog_name']; ?></a></strong>
                        <?php 
                            if (isset($result['blog_description'])) 
                            {
                                echo "<p>",$result['blog_description'],"</p>";
                            }
                        ?>
                        </div>
                    <?php
                    }
                }


                $images_result = array();
                $post_images = array(); //to prevent duplicates

                /*******************************************************************
                *   Second Match: Verbatim Matches in titles
                *
                ********************************************************************/ 
                $stmt = $db->query
                    ('
                    SELECT posts.post_title, posts.post_url, posts.post_timestamp, blogs.blog_name, posts.post_image, posts.post_image_height, posts.post_image_width
                    FROM posts INNER JOIN blogs ON posts.blog_id = blogs.blog_id 
                    WHERE MATCH(post_title) 
                    AGAINST (\'"'.$search_phrase.'"\' IN BOOLEAN MODE) 
                    ORDER BY post_timestamp DESC'
                    );
                $results = $stmt->fetchALL();

                if ($results[0]['post_url'] =="") 
                {
                    # if no results do nothing;
                } 
                else 
                {
                    $number_of_results++;
                    echo '<h3 class ="search_results">Post titles containing <span class ="search_string">'.$search_phrase.'</span></h3>';
                    foreach ($results as $result) 
                    {
                        ;?>
                        <div class="resultline">
                        <strong><?php echo $result['blog_name'];  ?></strong> : 
                        <a href ="<?php echo $result['post_url']; ?>"><?php echo $result['post_title']; ?></a>  - 
                        <?php echo '<span class ="daysago">',days_ago($result['post_timestamp']),' days ago</span>'; ?>
                        </div>                  
                        <?php

                        // if there's an image, add it to array
                        if ($result['post_image_height'] > 0) 
                        { //there's an image
                            $aspect_ratio = $result['post_image_width']/$result['post_image_height'];
                            $post_images[] = $result['post_image'];
                            $images_result[]= 
                            array(
                                "post_image"                => $result['post_image'],
                                "post_image_height"         => $result['post_image_height'],
                                "post_image_width"          => $result['post_image_width'],
                                "post_image_aspect_ratio"   => $aspect_ratio,
                                "post_image_url"            => $result['post_url']
                                );
                        }


                    }
                }

                /*******************************************************************
                *   Third Match: Verbatim search of content
                *
                ********************************************************************/ 
                $stmt = $db->query('
                    SELECT posts.post_title, posts.post_url, posts.post_timestamp, blogs.blog_name, posts.post_image, posts.post_image_height, posts.post_image_width  
                    FROM posts INNER JOIN blogs ON posts.blog_id = blogs.blog_id 
                    WHERE MATCH(post_title, post_content) AGAINST (\'"'.$search_phrase.'"\' IN BOOLEAN MODE) ORDER BY post_timestamp DESC');
                $results = $stmt->fetchALL();
                if ($results[0]['post_url'] =="") 
                {
                    # if no results do nothing;
                } 
                else 
                {
                    $number_of_results++;
                    echo '<h3 class ="search_results">Posts containing <span class ="search_string">'.$search_phrase.'</span></h3>';
                    foreach ($results as $result) 
                    {
                        ;?>
                        <div class="resultline">        
                        <strong><?php echo $result['blog_name'];  ?></strong> : 
                        <a href ="<?php echo $result['post_url']; ?>"><?php echo $result['post_title']; ?></a>
                        <?php echo '<span class ="daysago">',days_ago($result['post_timestamp']),' days ago</span>'; ?>
                        </div>
                        <?php
                        // if there's an image, add it to array
                        if ($result['post_image_height'] > 0) 
                        { //there's an image
                            if (in_array($result['post_image'], $post_images)) 
                            { //image is unique in results
                                //do nothing
                            } 
                            else 
                            {
                                $aspect_ratio = $result['post_image_width']/$result['post_image_height'];
                                $images_result[]= 
                                array(
                                "post_image"                => $result['post_image'],
                                "post_image_height"         => $result['post_image_height'],
                                "post_image_width"          => $result['post_image_width'],
                                "post_image_aspect_ratio"   => $aspect_ratio,
                                "post_image_url"            => $result['post_url']
                                );
                            }                   
                        }
                    }
                }
                
                if ($number_of_results <1) 
                { // no results
                    echo '<h2>No Results found for <span class ="search_string">'.$search_phrase.'</span></h2>';
                    echo '<p>
                    Try different spellings of the phrase, or try narrowing down your search term if it\' too general. Also please keep in mind that indexing of posts began in June 2012, which means that any blog post published before that date is not indexed.
                    </p>';
                }
            
            ?>
        <?php if (count($post_images)>-1) {
        ;?>
        
            <h3 class ="search_results">Images search for <?php echo '<span class ="search_string">'.$search_phrase.'</span>' ?></h3>
            <?php 
                //echo "<pre>",print_r($images_result,true), "</pre>"; 
                $maximum_size=150; //pixels
                echo '<div id ="image_results" style ="position:relative;opacity:0">';
                foreach ($images_result as $image) {
                    if ($image['post_image_width']>=$image['post_image_height']) {
                        echo '<div class ="thumb"><a href ="'.$image['post_image_url'].'"><img class="lazy" data-original="'.$image['post_image'].'" src="img/interface/grey.gif" width="'.$maximum_size.'" height="'.($maximum_size/$image['post_image_aspect_ratio']).'"></a></div>';
                    }else{
                        echo '<div class ="thumb"><a href ="'.$image['post_image_url'].'"><img class="lazy" data-original="'.$image['post_image'].'" src="img/interface/grey.gif" height="'.$maximum_size.'" width ="'.($maximum_size*$image['post_image_aspect_ratio']).'"></a></div>';
                    }
                    
                }
                echo "</div>";
            ?>
        
        <?php       } ?>


        </div>
    </div>  
</div>

</div>

<script type="text/javascript">

/*functions*/

var maximum_size = 150;
var wdth = $(window).width();
var cols = ((wdth - (wdth % maximum_size)) / maximum_size)-1;
cols = Math.round(cols*.6);


var doit;
function resizedw(){
    fixDimensions();

}
$(window).resize(function() {
    clearTimeout(doit);
    doit = setTimeout(function() {
        var wdth = $(window).width();
        var cols = ((wdth - (wdth % maximum_size)) / maximum_size);
        cols = Math.round(cols*.6);
        $('#image_results').BlocksIt({
            blockElement: '.thumb',
            numOfCol: cols
        });
    }, 100);
});


$(document).ready(function() {
    $('#image_results').BlocksIt({
        blockElement: '.thumb',
        numOfCol: cols
    });
    $('#image_results').fadeTo('slow', 1);
    $("img.lazy").lazyload({ 
        effect : "fadeIn",
        threshold : 500
    });
});

</script>

<?php

}
include_once("includes/bottom_part.php");

?>