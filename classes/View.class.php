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
    if ($_SESSION['currentView'] == 'cards') {
      echo '<div id="posts">';
        Render::drawCards($data, 'normal');
      echo '</div> <!-- /posts -->';
    } else if ($_SESSION['currentView'] == 'timeline') {
      echo '<div id="posts">';
        Render::drawTimeline($data);
      echo '</div> <!-- /posts -->';
    }else{
      die('only cards and timeline so far');
    }
    
  }

  public static function makeBloggerBody($data){
    include_once(ABSPATH.'/views/blogger.part.php');
  }

  public static function makeFooter($pageFooter){
    include_once(ABSPATH.'/views/footer.part.php');
  }
}

?>