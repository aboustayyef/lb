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
    if (isset($_SESSION['currentChannel'])) {
      self::categoryHead($_SESSION['currentChannel']);
    }
    Render::drawData($data, 'normal');
  }

  public static function makeSearchBody($data){
    // Data here is an array of three different kinds of search results
    // $data['blogsResults'] , $data['titlesResults'] & $data['bodyResults']
    if ((count($data['blogsResults']) == 0 ) && (count($data['titlesResults']) == 0 ) && (count($data['bodyResults']) == 0 )) {
      // No results At all /
      //include_once(ABSPATH.'/views/no-search-results.part.php');
      return;
    } else {
      echo '<div id="posts">';
        if (count($data['blogsResults']) > 0 ) { // No Blog Results
          foreach ($data['blogsResults'] as $key => $blog) {
            Render::drawFeaturedBlogger($blog->blog_id);
          }
        }
        if (count($data['titlesResults'])>0)
        {
          Render::drawCards($data['titlesResults']);
        }
        if (count($data['bodyResults'])>0)
        {
          ?>

          <div class ="card-container" data-size="3">
            <div style ="background:white;width:100%">
              <p>This is a test separator</p>
            </div>
          </div>

          <?php
          Render::drawCards($data['bodyResults']);
        }
      echo '</div> <!-- /posts -->';
    }
   }


  public static function makeSavedBody($data){
    if (count($data) == 0) { // No favorites yet
      include_once(ABSPATH.'/views/saved-starter.part.php');
    }else{
      self::makeMessage('Hello '.$_SESSION['facebook']['first_name'].'! Here are the posts you marked for reading later');
      Render::drawData($data, 'normal');
    }
  }

  public static function makeFavoritesBody($data){
    if (count($data) == 0) { // No favorites yet
      include_once(ABSPATH.'/views/favorites-starter.part.php');
    }else{
      self::makeMessage('Hello '.$_SESSION['facebook']['first_name'].'! Here are the posts by your favorite bloggers.');
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

  public static function makeMessage($theMessage){
    /*The div below comes after the View Area div*/
    echo '<div class ="bodyMessage">'.$theMessage.'</div>';
  }

  public static function categoryHead($theCategory){
    //echo '<div class ="categoryHeader"><i class ="fa fa-coffee"></i>'.$theCategory.'</div>';
  }

}

?>