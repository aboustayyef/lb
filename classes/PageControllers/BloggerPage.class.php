<?php 
 /**
  * This page loads, prepares and renders the blogger page
  * @author  Mustapha Hamoui <mustapha.hamoui@gmail.com>
  */

class BloggerPage 
{
  protected $_pageDetails = array();   // Contains metadata for the html page 
  protected $_bloggerDetails = array();  // Contains blogger details and blooger posts
  protected $_footerDetails = array();  // contains footer parameters

  function __construct($bloggerid = NULL)
  {
    $this->_pageDetails['bloggerid']  = $bloggerid;
    $this->_pageDetails['googleFonts']  = GOOGLE_FONTS;
    $this->_pageDetails['title'] = $this->getTitle();
    $this->_pageDetails['description'] = $this->getDescription();
    $this->_pageDetails['leftColumn'] = "no";
    $this->_pageDetails['cssFile'] = "blogger.css";

    $this->_footerDetails['statcounter']  = STATCOUNTER_TRACKER;
    $this->_footerDetails['analytics']  = ANALYTICS_TRACKER;
    $this->_footerDetails['jquery'] = JQUERY_SOURCE ; 

  }

  function render(){
    $_SESSION['pageWanted'] = 'blogger';

    $this->getBloggerDetails(); // will populate $this->_postsData
    
    View::makeHeader($this->_pageDetails);
    View::makeBloggerBody($this->_bloggerDetails);
    View::makeFooter($this->_footerDetails); // think of the parameters of footer

    // Draw the header, pass along the _pageTitle and _pageDescription and 

  }

  function getTitle(){
    if ($this->_pageDetails['channel']=='all') {
      return "Lebanese Blogs | Latest posts from the best Blogs";
    } else {
      return "Top {$this->_pageDetails['channel']} blogs in Lebanon | Lebanese Blogs";
    }
  }

  function getDescription(){
    if ($this->_pageDetails['channel']=='all') {
      return "The best place to discover, read and organize Lebanon's top blogs";
    } else {
      return "The best place to discover, read and organize Lebanon's top {$this->_pageDetails['channel']} bloggers";
    }
  }

  function initializeCounter(){
    // initialize general counter of all posts
    $_SESSION['posts_displayed'] = 0; // initialize number of posts shown
    $_SESSION['items_displayed'] = 0; // initialize number of items shown (including other widgets)
  }

  function getBloggerDetails(){
      // the compact mode gets more initial posts;
      $this->_bloggerDetails = Posts::get_blogger_posts(20, $this->_pageDetails['bloggerid']);
  }

}
?>