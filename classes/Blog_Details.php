<?php 
class Blog_Details
{
    //properties
    protected $_db; //connection resource
    protected $_blogger_id;

    protected $_query;
    protected $_query_result;
    protected $_rows;

    protected $_blog_name;
    protected $_blog_description;  
    protected $_blog_url;
    protected $_blog_twitter;
    protected $_blog_tags;
    protected $_blog_author;

    //constructor
    public function __construct($db, $blogger_id)
    {
        $this->_db = $db;
        $this->_blogger_id = $blogger_id;

        // get blog's details
        $this->_query = ' SELECT * FROM `blogs` WHERE `blog_id` = "'. $this->_blogger_id .'"';
        $this->_query_result = $this->_db->query($this->_query);
        $this->_rows = $this->_query_result->fetchAll(PDO::FETCH_ASSOC);

        $this->_blog_name = $this->_rows[0]['blog_name'];
        $this->_blog_description = $this->_rows[0]['blog_description'];
        $this->_blog_url = $this->_rows[0]['blog_url'];
        $this->_blog_twitter = $this->_rows[0]['blog_author_twitter_username'];
        $this->_blog_tags = $this->_rows[0]['blog_tags'];
        $this->_blog_author = $this->_rows[0]['blog_author'];

    }

/**
*   displays a list of posts
*
*/ 
    public function list_Posts($howmany, $order_by, $order_desc_or_asc = "DESC"){
        $this->_query = 'SELECT * FROM `posts` WHERE `blog_id` = "' . $this->_blogger_id . '" ORDER BY ' . $order_by . ' ' . $order_desc_or_asc . ' LIMIT ' . $howmany ;
        $this->_query_result = $this->_db->query($this->_query);
        $this->_rows = $this->_query_result->fetchAll(PDO::FETCH_ASSOC);
        return $this->_rows;
    }

    public function list_Photos($blog, $howmany, $height){
        $this->_query = 'SELECT * FROM `posts` WHERE `post_image_width` > 0 AND `blog_id` = "' . $blog . '" ORDER BY post_timestamp DESC LIMIT ' . $howmany ;
        $this->_query_result = $this->_db->query($this->_query);
        $this->_rows = $this->_query_result->fetchAll(PDO::FETCH_ASSOC);
        $images = array();
        $rows = $this->_rows;
        foreach ($rows as $key=>$row) {
            $images[$key]['image'] = $row['post_image'];
            $height_to_width_ratio = ($row['post_image_height'] / $row['post_image_width']);
            $images[$key]['width'] = $height / $height_to_width_ratio ;
            $images[$key]['url'] = $row['post_url'];
        }
        return $images;
        
    }


/**
*   return blog's details
*/ 

    public function name(){
        return $this->_blog_name; 
    }

    public function url(){
        return $this->_blog_url; 
    }

    public function description(){
        return $this->_blog_description; 
    }

    public function twitter(){
        return $this->_blog_twitter; 
    }
    
    public function tags(){
        return $this->_blog_tags; 
    }

    public function author(){
        return $this->_blog_author; 
    }


/**
*   blog statistics
*/ 

    public function blogs_per_week(){

        // how many posts in the last 30 days
        $today = time();
        $ninety_days_ago = $today - (90*24*60*60);
        $this->_query = 'SELECT COUNT(`post_timestamp`) FROM `posts` WHERE `blog_id` ="' . $this->_blogger_id . '" AND `post_timestamp` > ' . $ninety_days_ago;
        $this->_query_result = $this->_db->query($this->_query);
        $this->_rows = $this->_query_result->fetch();
        $posts_per_90 = $this->_rows[0];
        $posts_per_week = ceil(($posts_per_90/90)*7);
        return $posts_per_week;

    }
    public function number_of_posts(){

        // how many posts in the last 30 days
        $today = time();
        $ninety_days_ago = $today - (90*24*60*60);
        $this->_query = 'SELECT COUNT(`post_timestamp`) FROM `posts` WHERE `blog_id` ="' . $this->_blogger_id . '"';
        $this->_query_result = $this->_db->query($this->_query);
        $this->_rows = $this->_query_result->fetch();
        return $this->_rows[0];
    }

}