<?php

/**
* Configuration file for Lebanese Blogs
* @author Mustapha Hamoui<mustapha.hamoui@gmail.com>
*/

// Absolute directory path to main directory
define('ABSPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

// Home page web address
$url = findWebRoot(); // custom function, at bottom of this document
define('WEBPATH', $url);

// Database Connection
define('DB_USER', 'database username');
define('DB_PASS', 'database password');
define('DB_HOST', 'host address of database');
define('DB_DBASE', 'name of database');
setlocale(LC_MONETARY, "en_US");

// Runtime settings
define('GOOGLE_FONTS','yes');
define('STATCOUNTER_TRACKER', 'yes');
define('ANALYTICS_TRACKER', 'yes');
define('JQUERY_SOURCE', 'cdn'); //options: 'local', 'cdn' or 'none'

// For CDN Purposes
define('THUMBS_BASE', 'http://localhost/lebanese_blogs/img/thumbs'.DIRECTORY_SEPARATOR);
define('IMGCACHE_BASE', 'http://localhost/lebanese_blogs/img/cache'.DIRECTORY_SEPARATOR);



// This utility function extracts the web root of the current document
function findWebRoot(){
  
  $host = 'http://'.$_SERVER['HTTP_HOST']; // example: http://localhost or http://lebaneseblogs.com
  $self = explode('/', $_SERVER['PHP_SELF']);
  array_pop($self); // removes last item from the array, which is config.php in this case

  // allow for a second level in directory hierarchy
  // We're making use of the fact that ABSPATH is related to the root 
  // folder and not to the folder of the file that includes it

  $abs_path = explode(DIRECTORY_SEPARATOR, ABSPATH);
  array_pop($abs_path);
  if (end($abs_path) !== end($self)) {
      array_pop($self); 
  }

  $root_directory = implode('/', $self); 
  $url = $host . $root_directory . DIRECTORY_SEPARATOR;
  return $url;
}

?>