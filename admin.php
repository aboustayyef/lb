<?php
  if (isset($_COOKIE["logged_in"]))
  {
    if ($_COOKIE["logged_in"] == "yes")
    {
      load_admin();
    } else {
      header("location: login.php");
    }
  } else {
    header("location: login.php");
  }

?>

<?php 

function load_admin(){

  $page = "admin";
  $title = "Lebanese Blogs | admin";
  $description = "Administration and maintenance";

  include_once("includes/top_part.php");
  ;?>
<div id="entries-main-container">
<div class ="page_wrapper">
  <div class="container">
    <br/>
    <div class="span6 offset3 preset3">
      <h3>Administration</h3>
        <?php
        if (isset($_POST['data-submit'])) {
          post_data_to_blog();
        } else {
          if (isset($_POST['url'])) {
            prepare_data();
          } else {
            load_form();
          }
        }
        
          
          
        ?>
        </div>
      </div>
    </div> <!-- /container -->
</div><!-- /page_wrapper -->
  
<?php
include_once("includes/bottom_part.php");
} // end load_admin()

function load_form(){
  ;?>
  
  <form method ="post" action = "admin.php">
    <fieldset>
      <legend>Enter URL</legend>
      <input type="text" placeholder="http://blogaddress.com" name ="url">
      <span class="help-block">Example block-level help text here.</span>
      <button type="submit" class="btn">Submit</button>
    </fieldset>
  </form>
  
  <?php
} // end load_form()

function prepare_data(){
  $url = $_POST['url'];
  require_once("includes/config.php");
  require_once("includes/core.php");

  //domain (blog id)
  $domain = get_domain($url);

  //title 

  $title = getTitle($url);

  //description
  $tags = get_meta_tags($url);
  if (isset($tags['description'])) {
    $description = $tags['description'];
  } else {
    $description = "No Description";
  }

  //feed

  $feeds = feedSearch($url);
  $feed = @$feeds[0]['href'];

prepare_form($url, $domain, $title, $description, $feed);

}

function prepare_form($url, $domain, $title, $description, $feed){
  ;?>

<form method = "post" action ="admin.php">
  <fieldset>
    <legend>Blog Data</legend>
    <label>Blog ID (domain)</label>
    <input name = "blog_id" type="text" value="<?php echo $domain; ?>">
    <label>Blog Name</label>
    <input name = "blog_name" type="text" value="<?php echo $title; ?>">
    <label>Blog Description</label>
    <input name = "blog_description" type="text" value="<?php echo $description; ?>">
    <label>Blog url</label>
    <input name = "blog_url" type="text" value="<?php echo $url; ?>">
    <label>Blog RSS Feeds</label>
    <input name = "blog_rss_feed" type="text" value="<?php echo $feed; ?>">
    <label>Blog author</label>
    <input name = "blog_author" type="text" value="">
    <label>Blog author Twitter</label>
    <input name = "blog_author_twitter_username" type="text" placeholder="Without the @" value="">
    <button type="submit" class="btn" name ="data-submit">Submit</button>
  </fieldset>
</form>  
  
  <?php
}

function getTitle($Url){
    $str = file_get_contents($Url);
    if(strlen($str)>0){
        preg_match("/\<title\>(.*)\<\/title\>/",$str,$title);
        return $title[1];
    }
}

function feedSearch($url) { 
// source: http://www.sitepoint.com/forums/showthread.php?728255-Detect-RSS-feeds-in-a-web-page
 
    if($html = @DOMDocument::loadHTML(file_get_contents($url))) {
 
        $xpath = new DOMXPath($html);
        $feeds = $xpath->query("//head/link[@href][@type='application/rss+xml']");
 
        $results = array();
 
        foreach($feeds as $feed) {
            $results[] = array(
                'title' => $feed->getAttribute('title'),
                'href' => $feed->getAttribute('href'),
            );
        }
 
        return $results;
 
    }
 
    return false;
 
}

function post_data_to_blog(){
  $blog_name = $_POST['blog_name'];
  $blog_description = $_POST['blog_description'];
  $blog_url = $_POST['blog_url'];
  $blog_rss_feed = $_POST['blog_rss_feed'];
  $blog_author = $_POST['blog_author'];
  $blog_author_twitter_username = $_POST['blog_author_twitter_username'];
  $blog_id = $_POST['blog_id'];

  global $db_username, $db_password , $db_host , $db_database;
  $db = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host . '', $db_username, $db_password);

  //make sure everything is in utf8 for arabic
  $db->query("SET NAMES 'utf8'");
  $db->query("SET CHARACTER SET utf8");
  $db->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");

  $stmt = $db->prepare ('INSERT INTO blogs 
    (
      blog_id,
      blog_name,
      blog_description,
      blog_url,
      blog_author,
      blog_author_twitter_username,
      blog_rss_feed
      ) 
    VALUES
    (
    :id,
    :name,
    :description,
    :url,
    :author,
    :twitter,
    :rss

    )');

    $stmt->execute(array(
          ':id'        => $blog_id,
          ':name'      => $blog_name,
          ':description'      => $blog_description,
          ':url'      => $blog_url,
          ':author'       => $blog_author,
          ':twitter' => $blog_author_twitter_username,
          ':rss'      => $blog_rss_feed
    ));
  
  if ($stmt->rowCount()) {
    Echo '<div class ="alert alert-success">Blog Added Succesfully !</div>';
  }


}



?>