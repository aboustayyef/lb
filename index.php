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
include_once('classes/Extras.php');
global $channel_descriptions;


$pagewanted = isset($_GET['pagewanted'])? $_GET['pagewanted'] : NULL;
// there are three kinds of pagewanted so far: 
//	"browse" for pages with posts (header + footer + sidebar + infinite loading content)
// 	"about" for pages with info and no sidebar (header + footer + static content)
// 	"top" for statistics (header + footer +sidebar + dynamic content)

$view = isset($_GET['view']) ? $_GET['view'] : NULL;
$channel = isset($_GET['channel']) ? $_GET['channel'] : NULL;
$bloggerid = isset($_GET['bloggerid']) ? $_GET['bloggerid'] : NULL;
$s = isset($_GET['s']) ? $_GET['s'] : NULL;


$webpage = new View($pagewanted, $view, $channel, $bloggerid, $s);
$webpage->DrawHeader();
$webpage->DrawContent();
$webpage->DrawFooter();

