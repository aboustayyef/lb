<?php 

/**
*   This page is for testing purposes only
*   it is designed to test the javascript
*   it will contain elements like header and sidebar
*/ 

include_once('config.php');

class drawTestPage
{
	function __construct()
	{
		$this->_page = "top";
		$this->_left_column = "yes";
	}

	function doit(){
		include_once(ABSPATH.'views/draw_header.php');
		;?>
		<script>
			a = "<?php echo $this->_page ?>"; // we will be using a global variable to set view type
		</script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src = "js/lebaneseblogs.js"></script>
		
		<?php
	}
}


$testpage = new drawTestPage;
$testpage->doit();


?>