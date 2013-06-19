<?php
$root_is_at = "..";
include_once("$root_is_at/includes/config.php");
include_once("$root_is_at/includes/connection.php");
include_once("$root_is_at/includes/core-functions.php");

if (admin_logged_in())
{
  header("location:index.php");
} 

$user = "stayyef";
$pass = "mm000741";

  if ((isset($_POST['user']))&&(isset($_POST['password']))) //information entered to both fields
  {
    if (($_POST['user'] == $user) && ($_POST['password']==$pass)) // information is correct
    {
      setcookie("logged_in", "yes", time()+7200, "/");  /* expires in 2 hours */
      header("location:index.php");
    } else {
      log_in_form();
    }
  } else {
    log_in_form();
  }

?>

<?php 

function log_in_form($status=NULL){
  $root_is_at = "..";
  $page = "admin";
  $title = "Lebanese Blogs | admin";
  $description = "Administration and maintenance";

  include_once("$root_is_at/includes/top_part.php");
  ;?>
<div id="entries-main-container">
<div class ="page_wrapper">
  <div class="container">
    <br/>
    <div class="span6 offset3 preset3">
      <h3>Administration</h3>
        <form class="form-inline" method ="post" action ="login.php">
          <input type="text" class="input-small" placeholder="username" name = "user">
          <input type="password" class="input-small" placeholder="Password" name = "password">
          <button type="submit" class="btn">Sign in</button>
        </form>
        <?php if ($status == "ok"){
          echo '<p><a href ="'. $root_is_at .'/admin/exit_links.php">Exit Links</a> - <a href ="'. $root_is_at .'/admin/add_blog.php">Add Blog</a></p>';} ?>
        </div>
      </div>
    </div> <!-- /container -->
</div><!-- /page_wrapper -->
  
  <?php
include_once("$root_is_at/includes/bottom_part.php");
}

?>