<?php 
require_once('init.php');

/*$user_id = '812400331';
$post_url = 'http://ginosblog.com/2013/11/19/amazing-graffiti-series-continues-in-ain-el-remmeneh/';

if (Posts::isSaved($user_id, $post_url)) {
	echo 'This post is saved';
}else{
	echo 'This post is not saved';
}*/

/*$data = Posts::get_saved_bloggers_posts('812400331', 0, 5);
echo "<pre>";
var_dump($data);
echo "</pre>";*/


// Test getIdFromFacebookId
/*
$id = Users::getIdFromFacebookId('2147483647');
echo "Facebook User Id '2147483647' corresponds to Lebanese Blogs ID $id ";
*/

// Test toggleFavorites
/*$user_facebook_id = '812400331';
$blog_id = 'blogbaladi';

Posts::toggleFavorite($user_facebook_id, $blog_id);*/

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