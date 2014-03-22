<?php 
 /**
  * This class serves to includes various parts of the Lebanese Blogs Web page
  *
  * @author  Mustapha Hamoui <mustapha.hamoui@gmail.com>
  */

class View
{
  public static function makeHeader($pageDetails){
    include_once(ABSPATH.'/views/header.part.php');
  }

  public static function makeBrowseBody($data){
    Render::drawData($data, 'normal');
  }

  public static function makeSavedBody($data){
    if (count($data) == 0) { // No favorites yet
      include_once(ABSPATH.'/views/saved-starter.part.php');
    }else{
      Render::drawData($data, 'normal');
    }
  }

  public static function makeFavoritesBody($data){
    if (count($data) == 0) { // No favorites yet
      include_once(ABSPATH.'/views/favorites-starter.part.php');
    }else{
      Render::drawData($data, 'normal');
    }
  }

  public static function makeBloggerBody($data){
    include_once(ABSPATH.'/views/blogger.part.php');
  }

  public static function makeStaticBody($pageDetails){
    include_once(ABSPATH.'/views/'.$pageDetails['whichPage']);
  }

  public static function makeFooter($pageFooter){
    include_once(ABSPATH.'/views/footer.part.php');
  }

  public static function makeLoginBody($parameters){
    include_once(ABSPATH.'/views/login.part.php');
  }
}

?>