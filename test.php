<?php 
	/* testing */

	require_once('init.php');
//	$stats = LbUser::getUserDetails();
  $test = array(
    '1'     => 'One',
    '2'     =>  'Two',
    '3'     => array('1','3','5'),
    );
  $_SESSION['test'] = $test;
  echo '<pre>';
	print_r($_SESSION['test']);
	echo '</pre>';

  echo $_SESSION['test']['1'];


?>