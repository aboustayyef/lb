<?php 
/*************************************************************
* Facebook
**************************************************************/

require ABSPATH.'classes/facebook/src/facebook.php';  // Include facebook SDK file
$facebook = new Facebook(array(
  'appId'  => '1419973148218767',
  'secret' => '16a49abb2d49c364d06b72eae7c79c1a',
//  'cookie' => true,    
));

$user = $facebook->getUser();
if ($user) {
  try {
    $user_profile = $facebook->api('/me');
         $fbid = $user_profile['id'];           // To Get Facebook ID
         $fbuname = $user_profile['username'];  // To Get Facebook Username
         $fbfullname = $user_profile['name'];    // To Get Facebook full name
         $fbFirstName = $user_profile['first_name'];
  } catch (FacebookApiException $e) {
    error_log($e);
    $result = $e->getResult();
    var_dump($result);
   $user = null;
  }
}
if ($user) {
  $logoutUrl = WEBPATH.'facebooklogout.php';
} else {
 $loginUrl = $facebook->getLoginUrl();
}
?>