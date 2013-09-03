<?php
$root_is_at = ".."; //second level

  include_once("$root_is_at/includes/config.php");
  include_once("$root_is_at/includes/connection.php"); 
  include_once("$root_is_at/includes/core-functions.php");

if (admin_logged_in()) 
{
  load_exit_links();
} else {
  header("location:login.php");
}

function load_exit_links(){
  date_default_timezone_set('Africa/Accra');
  $page = "exit_links";
  $title = "Exit Link Activity | Lebanese Blogs";
  $description = "";
  $root_is_at = ".."; //second level

  include_once("$root_is_at/includes/top_part.php");
  global $db;

  ?>

  <div class ="paper">
    <div class="container">
      <div class="row">
        <div class="span6">
        <h2>Recent exit-link activity</h2>
        <table class ="table table-striped ">
          <tr>
            <th class ="span2">Time</th>
            <th class ="span10">URL</th>
          </tr>
              <?php 
            $query = "SELECT exit_time, exit_url FROM exit_log ORDER BY exit_time DESC LIMIT 50";
            $stmt = $db->query($query, PDO::FETCH_ASSOC);
            $posts = $stmt->fetchAll();
            foreach ($posts as $post){
              ?>
              <tr>
                <td><?php echo date('H:i:s', $post['exit_time'] ); ?></td>
                <td><?php echo $post['exit_url']; ?></td>
              </tr>
              <?php 
            }

          ?>

        </table>
      </div>
      <div class="span6 last">
        <h2>High ranking posts</h2>
        <table class ="table table-striped ">
          <tr>
            <th class ="span10">URL</th>
            <th class ="span2">Clicks</th>
          </tr>
              <?php 
            $query = "SELECT post_title, post_visits FROM posts ORDER BY post_visits DESC LIMIT 50";
            $stmt = $db->query($query, PDO::FETCH_ASSOC);
            $posts = $stmt->fetchAll();
            foreach ($posts as $post){
              ?>
              <tr>
                <td><?php echo $post['post_title']; ?></td>
                <td><?php echo $post['post_visits']; ?></td>
              </tr>
              <?php 
            }

          ?>

        </table>

      </div>
      </div>
    </div>
  </div>


  <?php
include_once("$root_is_at/includes/bottom_part.php");

}


?>