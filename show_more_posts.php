<?php
	/*******************************************************************
	*	This script handles adding items on the page for infinite scrolling effect
	*
	********************************************************************/ 

$start_from = $_POST['start_from'];
require_once("includes/config.php");
require_once("includes/functions.php");
require_once("includes/core.php");

$to = $start_from + 15; // change figure if we want
display_blogs($start_from+1, $to); 

?>