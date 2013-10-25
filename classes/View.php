<?php 
 /**
 *  This class is reponsible for rendering the web page
 *	It takes initial data of $posts and $meta ($depth, title, description)
 */ 

class View
{
	protected $_page; // internal reference to page ("home", "about"..etc)
	protected $_view; // which view kind
	protected $_title; // title of a website
	protected $_left_column; // "yes" or "no";
	protected $_description; // description of page
	protected $_posts; //initial set of posts to display

	function __construct($pagewanted=null, $view=null, $channel=null) {
		
		// Which page is this? is it a browse page? an about page or a 'top' page?
		if ((isset($pagewanted))) {
			$this->_page = $pagewanted;
		} else {
			$this->_page = "browse"; //default
		}

		// decide if the page has a left column or not;
		switch ($this->_page) {
			case 'browse':
				$this->_left_column = "yes";
				break;		
			case 'top':
				$this->_left_column = "yes";
				break;
			default:
				$this->_left_column = "no";
				break;
		}

		// 	If we are browsing posts, which view type are we using? (cards, timeline or compact?)
		if ($this->_page == "browse") {

			//	Is the view type set in the URL parameters?
			if ((isset($view)) && ($view !== "")) { // url parameter
				$this->_view = $view;
				$_SESSION['viewtype'] = $view;

			// if not, is it set in the Session? 
			} else if (isset($_SESSION['viewtype'])) { // session
				$this->_view = $_SESSION['viewtype'];

			// if not, is it set in a cookie?
			} else if (isset($_COOKIE["lblogs_default_view"])) {//cookie
				$this->_view = $_COOKIE["lblogs_default_view"];
				$_SESSION['viewtype'] = $view;

			// if not, "cards" is the default
			} else{
				$expire=time()+60*60*24*30; 
				setcookie("lblogs_default_view", "cards", $expire); // "cards is the default view"
				$_SESSION['viewtype'] = "cards";
				$this->_view = "cards";
			}

			;?>		
			
			<?php

		// Which channel is being requested? (if any)
			if ((isset($channel)) && ($channel !== "")) {
				$this->_channel = $channel;
				$_SESSION['channel'] = $channel;
			} else {
				$this->_channel = "all"; //default
				$_SESSION['channel'] = NULL;
			}
		}

	}

	function DrawHeader(){
		$this->SetTitleAndDescription();
		// depending on constructor outcomes, get $this->_title and $this->_description
		include_once(ABSPATH.'views/draw_header.php');
	}

	function DrawContent(){

		global $db;
		switch ($this->_page) {
			case 'about':
				include_once(ABSPATH.'views/draw_pages.php');
				break;

			case 'browse':
				// initialize general counter of all posts
				$_SESSION['posts_displayed'] = 0; //number of posts shown
				$_SESSION['items_displayed'] = 0; // number of items shown (including other widgets)
				
				// Get initial posts. Initiate model.
				$posts = new Posts($db);
				// the compact mode gets more initial posts;
				if ($this->_view == "compact") {
					$initial_posts_to_retreive = 50;
				}else{
					$initial_posts_to_retreive = 20;
				}
				$data = $posts->get_latest_posts($initial_posts_to_retreive, $_SESSION['channel']); 
				//envelope the posts;
				echo '<div id="posts">';
					$this->display_posts($data);
				echo '</div> <!-- /posts -->';
				break;

			case 'top':
				include_once(ABSPATH.'views/draw_top.php');
				break;

			default:
				# code...
				break;
		}
		// left column ?
		// Dynamic or static content?
		// Infinite scrolling or not?
	}

	function DrawFooter(){
		include_once(ABSPATH.'views/draw_footer.php')	;
	}


// Assisting Functions
/********************************************************************************************************************************************/

	function SetTitleAndDescription(){ 

		// this method comes up with the title and description of the page depending on the page wanted ()
		// sets the values of $this->_title and $this->_description
		switch ($this->_page) {

			case 'browse':
				if ($this->_channel == "all") {
					$this->_title = "Lebanese Blogs | Latest posts from the best Blogs";
					$this->_description ="The best way to read and discover Lebanon's top blogs";
				} else {
					$this->_title = "Top {$this->_channel} blogs in Lebanon | Lebanese Blogs";
					$this->_description ="The best way to read and discover Lebanon's top {$this->_channel} bloggers";
				}
				break;
			
			case 'about':
				$this->_title = "Lebanese Blogs | About";
				$this->_description = "Get to know why Lebanese Blogs is so awesome";
				break;
			
			case 'top':
				$this->_title = "Lebanese Blogs | Top Posts";
				$this->_description = "Top posts today at Lebanese Blogs";
				break;
			
			default:
				die('pagewanted is not set correctly');
				break;
		}
	}

	function display_posts($data){
		switch ($this->_view) {
			case 'cards':
				include_once(ABSPATH.'views/display_cards.php')	;
				break;
			
			case 'timeline':
				include_once(ABSPATH.'views/display_timeline.php');
				break;
			
			case 'compact':
				include_once(ABSPATH.'views/display_compact.php') ;
				break;
			
			default:
				# code...
				break;
		}
	}

/**
*   Utility functions
*********************************************************************************************************************************************/
 

	// This function allocates "slots" to material other than the blog posts (widgets, tips or ads)
	function map_keys($key){
		echo '<!-- MAP KEYS CALLED -->';
		if ($key == 0) { // show top posts
			global $channel_descriptions;	
			global $db;
			$top5 = new Posts($db);
			$posts = $top5->get_Top_Posts($hours=12, $howmany = 5);
			include_once(ABSPATH.'views/top5.php');
			$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
		} else if ($key % 15 == 0) {
			echo '<!--'.$key.' is a multiple of 15 -->';
			$_SESSION['items_displayed'] = $_SESSION['items_displayed'] + 1;
		}
	}

	function contains_arabic($string){	//returns true if string has arabic characters

		if (preg_match("/([ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz]).+/", $string)){
			return false;
		} else {
			return true;
		}
	}

	function infinitescroll(){ // adds script in the end for inifite scrolling
		;?>	
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script>
			$.post('contr_get_extra_posts.php', { start_from:15, channel: "fashion"}, function (data) {
		  		$('body').append(data);	
		  	});
		</script>
		<?php
	}
}
?>