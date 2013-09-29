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
include_once('classes/Image.php');
include_once('classes/Lb_functions.php');
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
$expire=time()+60*60*24*30; // one month

// url overrides Session
if ((isset($_GET['view'])) && (($_GET['view'] == 'cards') || ($_GET['view'] == 'timeline') || ($_GET['view'] == 'compact'))) { 
	setcookie("lblogs_default_view", $_GET['view'], $expire);
	$_SESSION['viewtype'] = $_GET["view"];
// session trumps cookie
} else if (isset($_SESSION['viewtype'])) { 
	# do nothing
// cookie is better than nothing
} else if (isset($_COOKIE["lblogs_default_view"])) {
	$_SESSION['viewtype'] = $_COOKIE["lblogs_default_view"];
// nothing still works
} else {
	setcookie("lblogs_default_view", "cards", $expire); // "cards is the default view"
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
$data = $posts->get_interval_posts(0,20, $_SESSION['channel']); // Usage: get_interval_posts(from, howmany, tag)

// Begin Drawing
$webpage->draw_header();


/**
*	Note on the structure of posts below: 
** 
*   The reason we didn't include begin_posts() and end_posts() in the header is because we want 
*   to use the header for different pages (without posts div). We also didn't include them in the display_posts()
*   because that method is used to append more posts to the posts <div>. 
*	If we included it in the file, we will have recursive posts inside posts divs.
*/ 

$webpage->begin_posts(); 
$webpage->display_posts($data); 
$webpage->end_posts(); 


$webpage->draw_footer();


?>
