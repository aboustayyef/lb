<?php 
/**
* This class serves to route, normalize and validate naming and tagging of channels 
*/

class Channels
{
  public static $currentChannel ;

  private static $tagrouter =  array(
    'all'         => 'all',
    'fashion'     => 'fashion',
    'style'       => 'fashion', 
    'food'        => 'food',
    'health'      => 'food',
    'society'     => 'society',
    'politics'    => 'politics',
    'tech'        => 'tech',
    'business'    => 'tech',
    'media'       => 'media',
    'music'       => 'media',
    'tv'          => 'media',
    'film'        => 'media',
    'advertising' => 'design',
    'design'      => 'design',
    'photography' => 'design',
    'columnists'  => 'columnists',
    );

  private static $ChannelDescriptions = array(
    'columnists'   =>    'Columnists',
    'fashion'      =>    'Fashion & Style',
    'food'         =>    'Food & Health',
    'society'      =>    'Society & Fun News',
    'politics'     =>    'Politics & Current Affairs',
    'tech'         =>    'Tech & Business',
    'media'        =>    'Music, TV & Film',
    'design'       =>    'Advertising & Design'
  );

  public static function registerChannel($tag){

    if (!isset($_SESSION['currentChannel'])) {
      $_SESSION['currentChannel'] = 'all'; // default
    }

    if (array_key_exists($tag, self::$tagrouter)){
      // only change the channel if explicitely asked
      $_SESSION['currentChannel'] = self::$tagrouter[$tag];
    } 
    return $_SESSION['currentChannel'];
  }

  public static function describeTag($tag){
    $cannonical = self::resolveTag($tag);
    return self::$ChannelDescriptions[$cannonical];
  }

  public static function resolveTag($tag){
    if (array_key_exists($tag, self::$tagrouter)){
      // only change the channel if explicitely asked
      return self::$tagrouter[$tag];
    } else {
      return 'TagDoesntExist';
    }
  }


}


 ?>