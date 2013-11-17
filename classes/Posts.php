<?php 

/**
* fetches posts to display 
*/

class Posts
{

    private static $user_bloggers = null;

    public function __construct()
    {
        //nothing
    }
             
    public static function get_latest_posts($number_of_posts = 10, $channel = NULL) { //default is 10 posts
        // get blog's details
        if (isset($channel) && !empty($channel)) {
            $query = 'SELECT 
            posts.post_url, posts.post_title, posts.post_id, blogs.blog_id, blogs.blog_name ,  
            posts.post_excerpt, posts.post_image,posts.post_image_height, posts.post_image_width, 
            blogs.blog_author_twitter_username, posts.post_timestamp FROM `posts` INNER JOIN `blogs` ON posts.blog_id = blogs.blog_id WHERE blogs.blog_tags LIKE "%'.trim($channel).'%" ORDER BY `post_timestamp` DESC LIMIT ' . $number_of_posts ;
        } else {
            $query = 'SELECT 
            posts.post_url, posts.post_title, posts.post_id, blogs.blog_id, blogs.blog_name ,  
            posts.post_excerpt, posts.post_image,posts.post_image_height, posts.post_image_width, 
            blogs.blog_author_twitter_username, posts.post_timestamp FROM `posts` INNER JOIN `blogs` ON posts.blog_id = blogs.blog_id ORDER BY `post_timestamp` DESC LIMIT ' . $number_of_posts ;
        }
        DB::getInstance()->query($query);
        if (DB::getInstance()->error()) {
            echo "There's an error in the query";
        } else {
            return DB::getInstance()->results();
        }
    }


    public static function get_interval_posts($from=0,$howmany=10, $channel = NULL){
        
        if (isset($channel)) {
            $query = "SELECT posts.post_url, posts.post_title, posts.post_id, blogs.blog_id, blogs.blog_name ,  
            posts.post_excerpt, posts.post_image,posts.post_image_height, posts.post_image_width, 
            blogs.blog_author_twitter_username , posts.post_timestamp FROM `posts` INNER JOIN `blogs` ON posts.blog_id = blogs.blog_id WHERE blogs.blog_tags LIKE '%".trim($channel)."%' ORDER BY `post_timestamp` DESC LIMIT $from, $howmany";
        } else {
            $query = "SELECT posts.post_url, posts.post_title, posts.post_id, blogs.blog_id, blogs.blog_name ,  
            posts.post_excerpt, posts.post_image,posts.post_image_height, posts.post_image_width, 
            blogs.blog_author_twitter_username , posts.post_timestamp FROM `posts` INNER JOIN `blogs` ON posts.blog_id = blogs.blog_id ORDER BY `post_timestamp` DESC LIMIT $from, $howmany";
        }

        DB::getInstance()->query($query);
        if (DB::getInstance()->error()) {
            echo "There's an error in the query";
        } else {
            return DB::getInstance()->results();
        }

    }

    public static function get_blogger_posts($number_of_posts = 10, $whichblogger = NULL) { //default is 10 posts
        // get blog's details

        $query = 
        'SELECT
         blogs.blog_id, blogs.blog_name ,blogs.blog_description, blogs.blog_tags, blogs.blog_url,
         posts.post_url, posts.post_title, posts.post_image,posts.post_image_height, posts.post_image_width, posts.post_excerpt, blogs.blog_author_twitter_username
         FROM `posts` INNER JOIN `blogs` ON posts.blog_id = blogs.blog_id WHERE blogs.blog_id = "'.trim($whichblogger).'" ORDER BY `post_timestamp` DESC LIMIT ' . $number_of_posts ;

        DB::getInstance()->query($query);
        if (DB::getInstance()->error()) {
            echo "There's an error in the query";
        } else {
            return DB::getInstance()->results();
        }
    }


    public static function get_top_posts($hours, $posts_to_show = 5, $channel = NULL){

        // calculate the time cutoff 
        $lb_now = time();
        $lb_before = $lb_now-($hours*60*60);
        if ($channel){
            $query = 'SELECT posts.post_image, posts.post_image_width, posts.post_image_height, posts.post_url, posts.post_title, blogs.blog_name, posts.blog_id 
                    FROM posts INNER JOIN blogs ON posts.blog_id = blogs.blog_id 
                    WHERE blogs.blog_tags LIKE "%'.$channel.'%" AND posts.post_timestamp > '.$lb_before.' 
                    ORDER BY post_visits DESC LIMIT '.$posts_to_show;
        } else {
            $query = 'SELECT posts.post_image, posts.post_image_width, posts.post_image_height, posts.post_url, posts.post_title, blogs.blog_name, posts.blog_id 
            FROM posts INNER JOIN blogs ON posts.blog_id = blogs.blog_id 
            WHERE posts.post_timestamp > '.$lb_before.' ORDER BY post_visits DESC LIMIT '.$posts_to_show;
        }

        DB::getInstance()->query($query);
        if (DB::getInstance()->error()) {
            echo "There's an error in the query";
        } else {
            return DB::getInstance()->results();
        }
    }

    public static function get_favorite_bloggers_posts($user_id, $from, $howmany){

        // get list of User's favorite blogs - don't make a singleton because the list can change
        $sql1 = 'SELECT `blog_id` FROM users_blogs WHERE `user_facebook_id` = "'.$user_id.'"';
        $blogs = DB::getInstance();
        $allblogs = $blogs->query($sql1)->results();
        $list = array();
        foreach ($allblogs as $key => $blog) {
            $list[] = $blog->blog_id;
        }
        $list = "'".join("', '", $list)."'";
        
        // get list of posts

        $sql2 = "SELECT * FROM `posts` INNER JOIN `blogs` ON posts.blog_id = blogs.blog_id WHERE posts.blog_id IN ($list) ORDER BY posts.post_timestamp DESC LIMIT $from, $howmany ";
        $posts = DB::getInstance()->query($sql2)->results();
        return $posts;
    }

    public static function get_random_bloggers($howmany){
        $query = 'SELECT `blog_id`, `blog_name`, `blog_description` FROM blogs ORDER BY RAND() LIMIT '.$howmany;
        DB::getInstance()->query($query);
        if (DB::getInstance()->error()) {
            echo "There's an error in the query";
        } else {
            return DB::getInstance()->results();
        }
    }

    public static function isFavorite($user_id, $blog_id){
        $sql = 'SELECT * from users_blogs WHERE `user_facebook_id` = "' . $user_id . '" AND `blog_id` = "'  . $blog_id . '"';
        if (DB::getInstance()->query($sql)->count() > 0) { // yes, it's a favorite
            return true;
        }
        return false;
    }

    public static function toggleFavorite($user_id, $blog_id){
        if (self::isFavorite($user_id, $blog_id)) { // blog is a favorite, remove
            $sql = 'DELETE FROM users_blogs WHERE `user_facebook_id` = "' . $user_id . '" AND `blog_id` = "'  . $blog_id . '"';
            DB::getInstance()->query($sql);
        } else { // blog is not a favorite. Add new record
            DB::getInstance()->insert('users_blogs', array(
                    'user_facebook_id'  =>  $user_id , 
                    'blog_id'           =>  $blog_id 
                ));
        }
    }

    public static function searchBlogNames($term){
        $names = DB::getInstance();
        $names->query('SELECT blog_id, blog_name, blog_url, blog_description FROM blogs WHERE MATCH(blog_name) AGAINST (\'"'.$term.'"\' IN BOOLEAN MODE) ORDER BY blog_name DESC');
        return $names->results();
    }

    public static function searchBlogTitles($term){
        $names = DB::getInstance();
        $names->query('SELECT posts.post_title, posts.post_url, posts.post_timestamp, blogs.blog_name, posts.post_image, posts.post_image_height, posts.post_image_width
                    FROM posts INNER JOIN blogs ON posts.blog_id = blogs.blog_id 
                    WHERE MATCH(post_title) AGAINST (\'"'.$term.'"\' IN BOOLEAN MODE) ORDER BY post_timestamp DESC');
        return $names->results();
    }

    public static function searchBlogContents($term){
        $names = DB::getInstance();
        $names->query('SELECT posts.post_title, posts.post_url, posts.post_timestamp, blogs.blog_name, posts.post_image, posts.post_image_height, posts.post_image_width  
                    FROM posts INNER JOIN blogs ON posts.blog_id = blogs.blog_id 
                    WHERE MATCH(post_title, post_content) AGAINST (\'"'.$term.'"\' IN BOOLEAN MODE) ORDER BY post_timestamp DESC');
        return $names->results();
    }








}