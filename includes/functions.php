<?php 
function center_item($to_be_centered){

	echo '<table style="width: 100%;"><tr>';
	echo '<td style="text-align: center; vertical-align: middle;">';
	echo $to_be_centered;
	echo "</td> </tr> </table>";

}

function draw_blog_entry_with_image(
	$blog_thumb,
	$blog_name,
	$post_title,
	$post_url,
	$post_image,
	$post_image_width,
	$post_image_height,
	$post_twitter )
{
	$module_code = <<<BLOGENTRY
<div class="blogentry" style ="opacity:0">
	<div class="post_info">
		<img class ="blog_thumb" src="$blog_thumb" width ="50" height ="50">
		<div class="post_details">
			<div class="blog_name">$blog_name</div>
			<div class="post_title"><a href="$post_url">$post_title</a></div>
		</div>
	</div>
	<a href="$post_url"><img class="lazy" data-original="$post_image" src="img/interface/grey.gif" width="$post_image_width" height="$post_image_height"></a>
BLOGENTRY;

echo $module_code;
sharing_tools($post_title,$post_twitter,$post_url);
echo "</div>";
}

function draw_blog_entry_with_excerpt(
	$blog_thumb,
	$blog_name,
	$post_title,
	$post_url,
	$post_excerpt,
	$post_twitter )
{
	$module_code = <<<BLOGENTRY
<div class="blogentry" style ="opacity:0">
	<div class="post_info">
		<img class ="blog_thumb" src="$blog_thumb" width ="50" height ="50">
		<div class="post_details">
			<div class="blog_name">$blog_name</div>
			<div class="post_title"><a href="$post_url">$post_title</a></div>
		</div>
	</div>
	<div class ="excerpt">
		<blockquote>$post_excerpt</blockquote>
	</div>
BLOGENTRY;

echo $module_code;
sharing_tools($post_title,$post_twitter,$post_url);
echo "</div>";

}

function sharing_tools($post_title,$post_twitter,$post_url){
	$tweetcredit = ($post_twitter)?" by @$post_twitter":"";
	$url_to_incode = "$post_title $post_url".$tweetcredit." via lebaneseblogs.com";
	$twitterUrl = urlencode($url_to_incode);
	echo '
<div class ="sharing_tools">
		<ul>
			<li> <a href="https://twitter.com/intent/tweet?text='.$twitterUrl.'" title="Click to send this post to Twitter!" target="_blank"><img src ="img/interface/share-icon-twitter.png" style ="border:none" width ="16"></a></li>
			<li> <a href="http://www.facebook.com/sharer.php?u='.$post_url.'"><img src ="img/interface/share-icon-facebook.png" width ="16"></a> </li>
	</ul>
</div>
';

}

?>