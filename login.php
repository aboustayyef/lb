<?php
  if (isset($_COOKIE["logged_in"]))
  {
    if ($_COOKIE["logged_in"] == "yes")
    {
      header("location:admin.php");
    }
  }

  $user = "stayyef";
  $pass = "mm000741";

  if ((isset($_POST['user']))&&(isset($_POST['password']))) 
  {
    if (($_POST['user'] == $user) && ($_POST['password']==$pass)) 
    {
      setcookie("logged_in", "yes", time()+3600);  /* expires in 1 hour */
      header("location:admin.php");
    } else {
      log_in_form();
    }
  } else {
    log_in_form();
  }

?>

<?php 

function log_in_form(){

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
        <form class="form-inline" method ="post" action ="login.php">
          <input type="text" class="input-small" placeholder="username" name = "user">
          <input type="password" class="input-small" placeholder="Password" name = "password">
          <button type="submit" class="btn">Sign in</button>
        </form>
        </div>
      </div>
    </div> <!-- /container -->
</div><!-- /page_wrapper -->
  
  <?php
include_once("includes/bottom_part.php");
}

?>