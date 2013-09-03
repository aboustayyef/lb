<?php
$root_is_at = ".."; //second level
require_once("$root_is_at/includes/config.php");
require_once("$root_is_at/includes/connection.php");
require_once("$root_is_at/includes/core-functions.php");

  if (isset($_COOKIE["logged_in"]))
  {
    if ($_COOKIE["logged_in"] == "yes")
    {
      load_admin();
    } else {
      header("location: $root_is_at/admin/login.php");
    }
  } else {
    header("location: $root_is_at/admin/login.php");
  }

?>

<?php 

function load_admin(){

  $page = "edit";
  $title = "Edit Post";
  $description = "Edit Post. Administration and maintenance";
  $root_is_at = ".."; //second level

  include_once("$root_is_at/includes/top_part.php");
  ;?>
<div id="entries-main-container">
<div class ="page_wrapper">
  <div class="container">
    <br/>
    <div class="span6 offset3 preset3">
      <h3>Administration</h3>
        <?php
        if (isset($_POST['data-submit'])) {
          post_edited_data($_POST['post_id']);
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
include_once("$root_is_at/includes/bottom_part.php");

function load_form(){
global $db;
  if (!isset($_GET['id'])) {
  	die('need to enter id');
  } else {
  	$post_id = $_GET['id'];
  }

$query = 'SELECT `post_id`,`post_title`, `post_image`,`post_excerpt` FROM `posts` WHERE `post_id` = "' . $_GET['id'] . '"';
$stmt = $db->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

  ;?>
<div id ="form_edit">
  <p><a href ='delete_post.php?id=<?php echo $row['post_id']; ?>'>DELETE</a></p>
  <form method ="post" action = "edit.php">
      <legend>Post ID</legend>
      <input type="text" value="<?php echo $row['post_id'] ?>" name ="post_id" readonly>

      <legend>Post Title</legend>
      <input type="text" value="<?php echo $row['post_title'] ?>" name ="post_title">

      <legend>Post Image</legend>
      <input class="long" type="text" value="<?php echo $row['post_image'] ?>" name ="post_image">

      <legend>Post Excerpt</legend>
      <textarea name ="post_excerpt"><?php echo $row['post_excerpt'] ?></textarea>
      <br>
      <button class ="submit" type="submit" name="data-submit">Submit</button>
  </form>
</div>  
  <?php
} // end load_form()


function post_edited_data($post_id){

  $post_title = $_POST['post_title'];
  $post_image = $_POST['post_image'];
  $post_excerpt = $_POST['post_excerpt'];

  global $db;


  // fix below to use modify instead of insert

  // Don't forget to enter image dimensions

  // work on delete.php

$stmt = $db->prepare ('
  UPDATE `posts`
  SET `post_title`=:title, `post_image`=:image , `post_excerpt`=:excerpt
  WHERE `post_id`=:id ');


    $stmt->execute(array(
          ':id'       => $post_id,
          ':title'    => $post_title,
          ':image'    => $post_image,
          ':excerpt'  => $post_excerpt
    ));
  
  if ($stmt->rowCount()) {
    Echo '<div class ="alert alert-success">Post Edited Succesfully !</div>';
  }


}



?>