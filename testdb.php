<?php 
require_once('init.php');

// Test toggleFavorites
$user_facebook_id = '812400331';
$blog_id = 'blogbaladi';

Posts::toggleFavorite($user_facebook_id, $blog_id);

// Test for isFavorite method
/*$user_facebook_id = '812400331';
$blog_id = 'qifanabki';

if (Posts::isFavorite($user_facebook_id, $blog_id)) {
	echo $blog_id.' is a favorite of '.$user_facebook_id;
} else {
	echo 'Not a favorite';
}*/


/*$users = DB::getInstance();
$users->get('users', array('user_first_name','=','Mustapha'));
echo "<pre>";
	print_r($users->results());
echo "</pre>";

echo $users->results()[0]->user_id;*/

//Posts::get_favorite_bloggers_posts(1, 0, 20);




//$users = DB::getInstance();

/* To insert */

/*echo $users->insert('users', array(
	'user_first_name'	=>	'Mustapha',
	'user_last_name'	=>	'Hamoui',
	'user_email'		=>	'mustapha.hamoui@gmail.com'
	));*/

/* To Update:

echo $users->update('users',1, array(
	'user_first_name'	=>	'Mustapha',
	'user_last_name'	=>	'Hamoui',
	'user_email'		=>	'mustapha.hamoui@gmail.com',
	'user_visit_count'	=>	1
	));

*/

?>