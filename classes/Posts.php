<?php 

/**
* fetches posts to display 
*/

class Posts
{
    //properties
    protected $_db; //connection resource
    protected $_posts;

    protected $_query;
    protected $_query_result;
    protected $_rows;


    /* 
    *Constructor: connects to database
    */

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function get_latest_posts($number_of_posts = 10, $channel = NULL) { //default is 10 posts
        // get blog's details
        if (isset($channel)) {
            $this->_query = 'SELECT * FROM `posts` INNER JOIN `blogs` ON posts.blog_id = blogs.blog_id WHERE blogs.blog_tags LIKE "%'.trim($channel).'%" ORDER BY `post_timestamp` DESC LIMIT ' . $number_of_posts ;
        } else {
            $this->_query = 'SELECT * FROM `posts` INNER JOIN `blogs` ON posts.blog_id = blogs.blog_id ORDER BY `post_timestamp` DESC LIMIT ' . $number_of_posts ;
        }
        $this->_query_result = $this->_db->query($this->_query);
        $this->_rows = $this->_query_result->fetchAll(PDO::FETCH_ASSOC);
        return $this->_rows;
    }


    public function get_interval_posts($from=0,$howmany=10, $channel = NULL){
        
        if (isset($channel)) {
            $this->_query = "SELECT * FROM `posts` INNER JOIN `blogs` ON posts.blog_id = blogs.blog_id WHERE blogs.blog_tags LIKE '%".trim($channel)."%' ORDER BY `post_timestamp` DESC LIMIT $from, $howmany";
        } else {
            $this->_query = "SELECT * FROM `posts` INNER JOIN `blogs` ON posts.blog_id = blogs.blog_id ORDER BY `post_timestamp` DESC LIMIT $from, $howmany";
        }

        $this->_query_result = $this->_db->query($this->_query);
        $this->_rows = $this->_query_result->fetchAll(PDO::FETCH_ASSOC);

        return $this->_rows;

    }

    public function get_top_posts($hours, $howmany = 5){

        // calculate the time cutoff 
        $lb_now = time();
        $lb_before = $lb_now-($hours*60*60);

        if (isset($_SESSION['channel'])){
            $this->_query = 'SELECT posts.post_image, posts.post_image_width, posts.post_image_height, posts.post_url, posts.post_title, blogs.blog_name, posts.blog_id 
                    FROM posts INNER JOIN blogs ON posts.blog_id = blogs.blog_id 
                    WHERE blogs.blog_tags LIKE "%'.$_SESSION['channel'].'%" AND posts.post_timestamp > '.$lb_before.' 
                    ORDER BY post_visits DESC LIMIT '.$howmany;
        } else {
            $this->_query = 'SELECT posts.post_image, posts.post_image_width, posts.post_image_height, posts.post_url, posts.post_title, blogs.blog_name, posts.blog_id 
            FROM posts INNER JOIN blogs ON posts.blog_id = blogs.blog_id 
            WHERE posts.post_timestamp > '.$lb_before.' ORDER BY post_visits DESC LIMIT '.$howmany;

        }

        $this->_query_result = $this->_db->query($this->_query);
        $this->_rows = $this->_query_result->fetchAll(PDO::FETCH_ASSOC);

        return $this->_rows;
    }

}



