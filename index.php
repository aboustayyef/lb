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


// there are three kinds of pagewanted so far: 
//	"browse" for pages with posts (header + footer + sidebar + infinite loading content)
// 	"about" for pages with info and no sidebar (header + footer + static content)
// 	"top" for statistics (header + footer +sidebar + dynamic content)


$webpage = new View($_GET['pagewanted'], $_GET['view'], $_GET['channel']);
$webpage->DrawHeader();
$webpage->DrawContent();
$webpage->DrawFooter();

