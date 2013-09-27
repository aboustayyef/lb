<?php 
 /**
 *  This class is reponsible for rendering the web page
 *	It takes initial data of $posts and $meta ($depth, title, description)
 */ 

class View
{
	protected $_page; // internal reference to page ("home", "about"..etc)
	protected $_title; // title of a website
	protected $_description; // description of page
	protected $_posts; //initial set of posts to display

	function __construct() {}

	function SetPage($page){ // for navigation
		$this->_page = $page;
	}

	function SetTitle(){
		if (isset($_SESSION['channel']) && $_SESSION['channel'] !== NULL) {
			$this->_title = "Top {$_SESSION['channel']} blogs in Lebanon | Lebanese Blogs";
		}else{
			$this->_title = "Lebanese Blogs | Latest posts from the best Blogs";
		}
	}

	function SetDescription(){
		if (isset($_SESSION['channel']) && $_SESSION['channel'] !== NULL) {
			$this->_description = "Browse the latest posts of the top Lebanese {$_SESSION['channel']} Bloggers";
		}else{
			$this->_description = "Browse the latest posts of the top Lebanese Bloggers";
		}
	}

	function display_posts($data){
		switch ($_SESSION['viewtype']) {
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
	function draw_header(){ // draws the head part of the website
		include_once(ABSPATH.'views/draw_header.php')	;
	}

	function draw_footer() { //footer of web page
		include_once(ABSPATH.'views/draw_footer.php')	;
	}

	function begin_posts(){
		echo '<div id="posts">';
	}
	function end_posts(){
		echo '</div> <!-- /posts -->';
	}
/**
*   Utility functions
*/ 

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