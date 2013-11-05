<?php 
/*************************************************************
* Facebook
**************************************************************/
require 'config.php';
require ABSPATH.'classes\facebook\src\facebook.php';  // Include facebook SDK file
$facebook = new Facebook(array(
  'appId'  => '1419973148218767',
  'secret' => '16a49abb2d49c364d06b72eae7c79c1a',
  'cookie' => true,    
));

$user = $facebook->getUser();
var_dump($user);
if ($user) {
  try 
{    $user_profile = $facebook->api('/me');
          print_r($user_profile);
          $fbid = $user_profile['id'];           // To Get Facebook ID
         $fbuname = $user_profile['username'];  // To Get Facebook Username
         $fbfullname = $user_profile['name'];    // To Get Facebook full name
  } catch (FacebookApiException $e) {
    error_log($e);
    $result = $e->getResult();
    var_dump($result);
   $user = null;
  }
}
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl(array(
         'next' => WEBPATH.'facebooklogout.php',  // Logout URL full path
        ));
} else {
 $loginUrl = $facebook->getLoginUrl();
}

  if ($user) { ?>
    <div>Hello <?php echo $fbuname, '</div>' ;
  } else { ?>
    <div ><a href="<?php echo $loginUrl ?>">Login with Facebook</a> </div><?php
  }
?>