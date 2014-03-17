<?php 

/**
*   Index.php is the main routing file. It uses url parameters to know which class to load.
*   The main parameter is 'pagewanted', which takes us to different kinds of pages.
*
*   The valid 'pagewanted' parameters so far are: 
*   "browse" for home page that browses all the posts (optional requirements: 'view' & 'channel') 
*   "blogger" for pages of particular blogs (requirement: 'bloggerid')
*   "about" for the about page.
*   "search" for search page
*   "favorites" for favorite pages
*   "saved" for saved pages
*
*   @author Mustapha Hamoui <mustapha.hamoui@gmail.com>
*/ 


// initialize settings, session, database and load classes
include_once('init.php'); 

// User entry registration (cookie)
Lb_functions::registerEntry();

// get the main pagewanted parameter
$pagewanted = isset($_GET['pagewanted'])? $_GET['pagewanted'] : NULL;

// the default (null) is "browse"
if (($pagewanted == "browse") || ($pagewanted == NULL)) {

  // get the "browse"-specific parameters, view and channel
  $view = isset($_GET['view']) ? $_GET['view'] : NULL;
  $channel = isset($_GET['channel']) ? $_GET['channel'] : NULL;

  // Initialize the browse controller, BrowsePage
  $browsePage = new BrowsePage($view, $channel);
  // .. then load it
  $browsePage->render();
  return;
}


// If the page is blogger
  if ($pagewanted == 'blogger') {
    $bloggerid = isset($_GET['bloggerid']) ? $_GET['bloggerid'] : NULL;
    $bloggerPage = new BloggerPage($bloggerid);
    $bloggerPage->render();
  return;
  }
die();

// If the page is search
  $s = isset($_GET['s']) ? $_GET['s'] : NULL;
  $searchPage = new SearchPage($s);
  $searchPage->render();
  return;

// If the page is favorites
  $favoritesPage = new FavoritesPage($s);
  $favoritesPage->render();
  return;

// If the page is saved
  $savedPage = new SavedPage($s);
  $savedPage->render();
  return;

  die('Parameter not properly set: pagewanted');
?>