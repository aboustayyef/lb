<?php
/**
*   This script displays an amount of posts in the timeline form as per the $this->_posts data given
*/

	// loops through the posts
		foreach ($data as $key => $post) {
;?>

<article>
	<h2><?php echo $post['post_title'] ;?></h2>
	<p><?php echo $post['post_excerpt'] ;?></p>
</article>

<?php
		}
?>