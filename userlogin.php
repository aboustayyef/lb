<?php 
require_once('init.php');

/*
For Debugging:
echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/

if (isset($_SESSION['LebaneseBlogs_Facebook_User_ID'])){ // if user is signed in
	goback(); // redirect to page. Will be using details from existing session

} else {
	$user = new Users;

	if ($user->error()){
		echo 'Error';
	} else {
		if (!$user->FacebookSignedIn()) {

			// save state parameter from Facebook login url
			$loginURL = $user->FacebookLoginURL();
			preg_match("/&state=(\\w+)/u", $loginURL, $matches);
			$_SESSION['fb_state'] = $matches[1];

// Below is the website we see before the user signs in
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Login</title>
	<link rel="stylesheet" href="css/login.css">
</head>

<body>
	<div class="login-box">
		<!-- <img src="img/interface/lb-apple-icon-114x114.png" width = "57px" alt="lebaneseblogs logo" class="logo"> -->
	<?php if ($_GET['from'] == 'favorites') {
		?>
		<img src="img/interface/favorites-featured.jpg" alt="Favorites">
		<p>Favorite Blogs is a great way to keep track of the blogs you care about most. Only see posts by bloggers you have designated as favorites</p>
		<h2>Log in to Access your Favorite Bloggers </h2>

		<?php
	} else {
		?>
		<h1>Headline for Saved </h1>
		<p>Paragraph for Saved. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, tempora corporis fugiat nihil dolorem omnis sunt similique quibusdam! Ratione vel sit sed culpa in quo ipsam. Placeat odio unde magnam.</p>
	<?php } ?>
	
	<a class = "facebook_button" href ="<?php echo  $user->FacebookLoginURL();?>"></a>
	<p class="privacy">
		Privacy: We only need your email address so we can communicated with you if anything goes wrong with your account. We will not share it with anyone.
	</p>

	</div>
</body>
</html>



<?php
			

		} else {
			
			//User has now signed in to facebook. We now store the information from Facebook then redirect

		    // See if user exists in LB database
		    DB::getInstance()->get('users', array('user_facebook_id', '=', $user->getFacebookUserDetails('id')));
		    
		    if (DB::getInstance()->count() > 0) { // user exists
		    	// if user exists, increase database count
		    	
		    } else {
		    	// user is not in database. create user
		    	DB::getInstance()->insert('users', array(
		    		'user_facebook_id'	=>	$user->getFacebookUserDetails('id'),
		    		'user_first_name'	=> 	$user->getFacebookUserDetails('first_name'),
		    		'user_last_name'	=> 	$user->getFacebookUserDetails('last_name'),
		    		'user_email'		=> 	$user->getFacebookUserDetails('email'),
		    		'user_visit_count'	=> 1
	    		));
		    }
		
			// Add Session Details
		    $_SESSION['LebaneseBlogs_Facebook_User_ID']= $user->getFacebookUserDetails('id');
	    	$_SESSION['LebaneseBlogs_user_id'] = Users::getIdFromFacebookId($user->getFacebookUserDetails('id'));
	    	$_SESSION['LebaneseBlogs_Facebook_FirstName'] = $user->getFacebookUserDetails('first_name');

	    	// redirect using parameters from facebook login
	    	$params = "&code={$_GET['code']}&state={$_SESSION['fb_state']}";
	    	goback($params);	

		}		
	}
}

// redirect function

function goback($params=null){

	/* DEBUG 
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";*/

	if (!isset($_GET['from'])) {
		die('you need to use a from parameter for this page');
	} else {
		switch ($_GET['from']) {
			case 'favorites':
				header("location: ".WEBPATH."?pagewanted=favorites");
				break;
			
			case 'saved':
				header("location: ".WEBPATH."?pagewanted=saved");
				break;

			default:
				die('from parameter has to be either saved or favorites');
				break;
		}

	}
}

?>