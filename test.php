<?php 

include_once('init.php');

?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8">
 	<title>Title of the page</title>
 	<link rel="stylesheet" href="style.css">
	<script src="script.js"></script>
</head>

<body>
	<?php

	$user = new Users;
	//var_dump($user);

	if ($user->error()){
		echo 'Error';
	} else {
		if (!$user->FacebookSignedIn()) {
			echo 'User is not signed in, please sign in <a href ="' . $user->FacebookLoginURL() . '">here</a>';
		} else {
			echo $user->getFacebookUserDetails()['first_name'];
			echo '<pre>',print_r($_SESSION),'</pre>';
			echo '<a href ="' . $user->FacebookLogoutURL() . '">Sign Out</a>';
		}		
	}


	echo '<hr>';
	$blogs = Posts::get_random_bloggers(20);
	foreach ($blogs as $key => $blog) {
		echo $blog->blog_name.'<br/>';
	}

	?>

</body>

</html>

<?php 
//Code from left sidebar. to be used for future reference.


        if (isset($_SESSION['LebaneseBlogs_Facebook_User_ID'])) { ?>
          <div class = "label level1">Hello <?php echo $_SESSION['LebaneseBlogs_Facebook_FirstName'] ?></div>
          <div class = "label level1"><a class ="btn btn-small btn-red" href="facebooklogout.php">Logout</a> </div> <?php 
        } else { ?>
          <div class = "label level1 noHoverBackground"><a class ="facebook-signin-button" href="<?php echo $loginUrl ?>">&nbsp;</a></div><?php
        }

?>