<?php 

// query to get the latest posts by blogger $this->_blogger;

	$blog_id = $data[0]->blog_id;

;?>
<div class="blogger">
	

<div class ="bloggerPosts">
<?php
Render::drawFeaturedBlogger($blog_id);
Render::drawCards($data, 'blogger');
?>
</div> <!-- /bloggerPosts -->
</div> <!-- /blogger -->
<div class="bloggerbutton">
	<a class="btn btn-red" href="<?php echo $url;?>">See More at <?php echo $blog_name; ?></a>
</div>