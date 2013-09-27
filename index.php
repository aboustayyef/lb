<?php 
/**
*   This is the main controller file. it takes the url parameters and guides accordingly
*   depending on url parameters, the model gets appropriate data and is 
*   directed to appropriate view (for example, channels, or blogger page)
*/ 

session_start();

//dependencies

include_once("config.php");
include_once("includes_new/connection.php");
include_once("classes/Posts.php");
include_once("classes/View.php"); 
global $channel_descriptions;


// initialize Channel, a session wide variable.
if (isset($_GET['channel'])) {
    $_SESSION['channel'] = $_GET['channel'];
} else {
    $_SESSION['channel'] = NULL;
}

// initialize general counter of all posts
$_SESSION['posts_displayed'] = 0; //number of posts shown
$_SESSION['items_displayed'] = 0; // number of items shown (including other widgets)

// initialze view type
if (isset($_COOKIE["lblogs_default_view"])) {
	$_SESSION['viewtype'] = $_COOKIE["lblogs_default_view"];
} else {
	$expire=time()+60*60*24*30; // one month
	setcookie("lblogs_default_view", "cards", $expire); // "cards is the default"
	$_SESSION['viewtype'] = "cards";
}

// initialize homepage
$webpage = new View();

// page reference (for navigation 'selected')
$webpage->SetPage("home");

// page title (will depend on channel).
$webpage->SetTitle();

// Description of the page (will depend on channel).
$webpage->SetDescription();

// Get initial posts. Initiate model.
$posts = new Posts($db); 
$data = $posts->get_interval_posts(1,20, $_SESSION['channel']); // Usage: get_interval_posts(from, howmany, tag)

// Draw the whole thing
$webpage->draw_header();
$webpage->display_posts($data); 
$webpage->draw_footer();


?>