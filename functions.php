<?php 


function get_posts_from_database($from,$to){
/************************************************************************************
*	uses database as source of data. Make sure database is up to date before using
*	Returns an array of associative array with values to be displayed
* 	$posts[0]= array (
		"domain"	=> "name of blog that usually precedes .com or .wordpress ..etc example: beirutspring"
		"url"		=> "http://url-of-the.post",
		"title"		=> "title of the post",
		"timestamp" => "352342345435",
		"image-url"	=> "http://url-of-the-image-if-one-exists-else.null",
		"excerpt"	=> "the short paragraph with a determined maximum letters",
		"content"	=> "the whole post, if published in rss",
		)
*
**************************************************************************************/
	global $db_username, $db_password , $db_host , $db_database;

	$posts = array();
	$amountOfRecords = $to-$from;
	$mysqli = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	
	//make sure everything is in utf8 for arabic
	$mysqli->query("SET NAMES 'utf8'");
    $mysqli->query("SET CHARACTER SET utf8");
    $mysqli->query("ALTER DATABASE lebanese_blogs DEFAULT CHARACTER SET utf8 COLLATE=utf8_general_ci");
	
	$query = "SELECT * FROM `posts` ORDER BY `post_timestamp` DESC LIMIT $to";
	$result = $mysqli->query("$query");
	
	while ($rows = $result->fetch_array(MYSQLI_ASSOC)){

		$url = $rows['post_url'];
		$blogname = get_blog_name($url);
		$thumbimage = get_thumb($url);

		$posts[]	= array (
		"domain"	=> $rows['blog_id'],
		"url"		=> $rows['post_url'],
		"title"		=> $rows['post_title'],
		"timestamp" => $rows['post_timestamp'],
		"image-url"	=> $rows['post_image'],
		"excerpt"	=> $rows['post_excerpt'],
		"content"	=> $rows['post_content'],
		"blogname"	=> $blogname,
		"thumb"		=> $thumbimage
		);
	};
	$newposts = array_slice($posts, -$amountOfRecords, $amountOfRecords, true);
	return $newposts;
}

function get_posts_from_greader($from, $to)

/************************************************************************************
*	uses google reader as source of data
*	Returns an array of associative array with values to be displayed
* 	$posts[0]= array (
		"domain"	=> "name of blog that usually precedes .com or .wordpress ..etc example: beirutspring"
		"url"		=> "http://url-of-the.post",
		"title"		=> "title of the post",
		"timestamp" => "352342345435",
		"image-url"	=> "http://url-of-the-image-if-one-exists-else.null",
		"excerpt"	=> "the short paragraph with a determined maximum letters",
		"content"	=> "the whole post, if published in rss",
		)
*
**************************************************************************************/
{
	$posts = array();
	$howmany = $to-$from;
	$previous_link = ""; // this variable will be used to prevent duplicate posts from showing twice
	$feed = new SimplePie(); // We'll process this feed with all of the default options.
	$feed->set_feed_url("http://www.google.com/reader/public/atom/user%2F06686689690592384436%2Fbundle%2FLebanon%20Blogs%202?n=$to"); // Set which feed to process.
	$feed->set_cache_duration(600); // Set cache to 10 mins
	$feed->strip_htmltags(false);
	$feed->init(); // Run SimplePie. 
	$feed->handle_content_type(); // This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).

	foreach($feed->get_items($from,$to) as $item) 
	{
		$canonical_resource = $item->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10,'link');
		$canonical_url = has_canonical_url($canonical_resource); // will return either 'false' or a canonical url
		$blog_post_timestamp = strtotime($item->get_date());
		$blog_post_link = ($canonical_url)? $canonical_url : $item->get_permalink();
		 // $blog_post_link = preg_replace('/\?.*/', '', $blog_post_link); // removes queries at the end of posts
		$blog_post_thumb = get_thumb($blog_post_link);
		$blog_name = get_blog_name($blog_post_link);
		$blog_post_title = clean_up($item->get_title(), 120);
		$temp_content = $item->get_content();
		$blog_post_content = html_entity_decode($temp_content, ENT_COMPAT, 'utf-8');
		$blog_post_image = @dig_suitable_image($blog_post_content) ;
		$blog_post_excerpt = get_blog_post_excerpt($blog_post_content, 120);
		$domain = get_domain($blog_post_link);
		// (to be used later for harvesting links in post) preg_match_all("/((https?:\/\/)|(www.))([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?/", $blog_post_content, $content_links_all);
		if ($item->get_permalink() !== $previous_link ) { //Only go through if not duplicate
			$posts[]= 	array (
				"blogname"	=> $blog_name,
				"domain"	=> $domain,
				"url"		=> $blog_post_link,
				"title"		=> $blog_post_title,
				"timestamp" => $blog_post_timestamp,
				"image-url"	=> $blog_post_image,
				"excerpt"	=> $blog_post_excerpt,
				"content"	=> $blog_post_content,
				"thumb"		=> $blog_post_thumb
				);
		}
		$previous_link = $blog_post_link; //used to prevent duplication 
	}
	return $posts;
}
	
function get_domain($theurl)
/*****************************************
*
*	Will extract the domain from the url
*	Example input: "http://www.xyz.com"
*	Example output: "xyz" (string)
*
*******************************************/
{
	$parse = parse_url($theurl);
	$host = $parse['host'];
	$explode = explode(".", $host);
	$domain = $explode[0];
	if ($domain == 'www' || $domain == 'blog') {
		$domain = $explode[1];
	} else {
		$domain = $domain ;
	}
	return $domain;
}
	
function whatsnew(){
?>
<div class ="message hidden-phone">
      <p><strong>Welcome to the new version of the Beirut Dashboard!</strong> Now with inline images &amp; excerpts in blogs, responsive layout, better news, facelift &amp; bug fixes || Questions? Get in touch via <a href="http://twitter.com/beirutspring">twitter</a></p>
</div>
<?php
}

function contains_arabic($string){	
/*******************************************************************
*	returns true if string has arabic characters
*
********************************************************************/ 
	if (preg_match("/([ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz]).+/", $string)){
		return false;
	} else {
		return true;
	}
}

function clean_up($original_string, $length)
/*****************************************
*
*	Will clean up and truncate a string
*	mostly used for post excerpts
*
*******************************************/
{
	$original_string = html_entity_decode($original_string, ENT_COMPAT, 'utf-8');
	$original_string = strip_tags($original_string);
	str_replace(array("\r", "\r\n", "\n"), '', $original_string);
	$original_string = trim($original_string);
	if (strlen($original_string) > $length ) {
		$new_string = substr($original_string,0,$length)."...";
	} else {
		$new_string = $original_string;
	}
	
	return $new_string ;
}


function get_blog_name($blog_post_link){
	// find blog's name, or use "random blog"		
$domain = get_domain ($blog_post_link); // output example "beirutspring"
	
$blognames = array (
			'bikaffe'				=> "بكفي",
			'toomextra'				=> "Toom Extra",
			'dirtykitchensecrets'	=> "Dirty Kitchen Secrets",
			'nadinemoawad'			=> "What If I Break Free?",
			'247momonduty'			=> "24/7 Mom on Duty",
			'h20-platform'			=> "The Platform",
			'smileyface80'			=> "بيسان",
			'nasriatallah'			=> "Nasri Atallah",
			'bilamaliyeh'			=> "Bil'amaliyeh",
			'meandbeirut'			=> "Me & Beirut",
			'arabsaga'				=> "Arab Saga",
			'lebaneseexpatriate'	=> "Lebanese Expatriate",
			'alextohme'				=> "Alex Tohme",
			'lebaneseblogs'			=> "Lebanese Blogs Meta Blog",
			'jadaoun'				=> "Beirut: Under Rug Swept",
			'southoak'				=> "سنديانة الجنوب",
			'hishamad'				=> "COLA WA CALSET",
			'lebanesecomics'		=> "Malaak, Angel of Peace",
			'majnouna-blog'			=> "Mirth & Folly",
			'majnouna-khatt'		=> "Majnouna Khatt",
			'speaktheblues'			=> "Speakin' The Blues",
			'nourspot'				=> "Nour Spot",
			'eyeontheeast'			=> "Eye on the east",
			'qaph'					=> "Qaph Blog",
			'code4word'				=> "Code 4 Word",
			'lifeandstyleandco'		=> "Life and Style and Co.",
			'bloggingfairtradelebanon' => "Blogging Fair Trade in Lebanon",
			'racing-thoughts'		=> "Racing Thoughts",
			'tomybeirut'			=> "To My Beirut",
			'thedscoop'				=> "The D Scoop",
			'larmoiredelana'		=> "L'armoire de Lana",
			'ohmyhappiness'			=> "Oh My Happiness",
			'languidlyurged'		=> "Languidly Urged",
			'ritakml'				=> "Rita Kamel",
			'al-bab'				=> "Al Bab",
			'ivysays'				=> "Ivy Says",
			'freethinkinglebanon'	=> "Free Thinking Lebanon",
			'remarkz'				=> "Remarkz",
			'seenbymaya'			=> "Seen By Maya",
			'noteconnection'		=> "Note Connection 3.0",
			'viewoverbeirut'		=> "View Over Beirut",
			'frombeiruttothebeltway'=> "From Beirut To The Beltway",	
			'MindSoup'				=> "Mind Soup",
			'endashemdash'			=> "Nour Has a Tumblog",
			'ethiopiansuicides'		=> "Ethiopian Suicides",
			'snapshotscenes'		=> "Snap Shot Scenes",
			'globalvoicesonline'	=> 'Global Voices Online',
			'whenhopespeaks'		=> "When Hope Speaks",
			'najissa'				=> 'خرّوب و زنزلخت',
			'moulahazat'			=> 'Moulahazat',
			'blogbaladi' 			=> 'Blog Baladi',
			'stateofmind13' 		=> 'A Separate State of Mind',
			'beirutspring'			=> 'Beirut Spring',
			'beirutdriveby'			=> 'Beirut Driveby Shooting',
			'sietske-in-beiroet'	=> 'Sietske In Beiroet',
			'gingerbeirut'			=> 'Ginger Beirut',	
			'ranasalam'				=> 'Rana Salam Design Blog',
			'beirutntsc'			=> 'Beirut/NTSC',
			'tasteofbeirut'			=> 'Taste Of Beirut',
			'arabglot'				=> 'arabglot الناطق بالضاد',
			'greenresistance'		=> 'Green Resistance',
			'ginosblog'				=> 'Gino\'s Blog',
			'plus961'				=> 'Plus 961',
			'armigatus'				=> 'Armigatus',
			'woodenbeirut'			=>'Wood En Beirut', 
			'lamathinks'			=>'Lama\'s Scrapbook',
			'johayna'				=> 'جـهينة...',
			'kathyshalhoub'			=> 'Kathy Shalhoub\'s Blog',
			'shalabieh'				=> "Shalabieh's World",
			'edithandomar'			=> "Edith and Omar",
			'beirutiyat'			=> 'خربشات بيروتية',
			'jadaoun'				=> 'Under Rug Swept',
			'beirutreport'			=> 'The Beirut Report',
			'joesbox'				=> "Joe's Box",
			'seeqnce'				=> "Seeqnce Blog",
			'saghbini'				=> 'Ninar - نينار',
			'brofessionalreview'	=> 'Brofessional Review',
			'rationalrepublic'		=> 'Rational Republic',
			'funkyozzi'				=> 'From Lebanon With a Funk',
			'ritachemaly'			=> 'Rita Chemaly',
			'thecubelb'				=> 'The Cube',
			'inkontheside'			=> 'Ink On the Side',
			'piratebeirut'			=> 'Pirate Beirut',
			'thepresentperfect'		=> 'The Present Perfect',
			'octavianasr'			=> "Octavia Nasr's Blog",
			'karlremarks'			=> "Karl Remarks",
			'cnas'					=> "Abu Muqawama",
			'sleeplessbeirut'		=> "Sleepless in Beirut",
			'backinbeirut'			=> "Back in Beirut",
			'confettiblues'			=> 'Confetti Blues',
			'YHhE89RhVa0'			=> 'The On-the-go Blog',
			'missfarah'				=> 'Miss Farah',
			'chroniquesbeyrouthines'=> 'Chroniques Beyrouthines',
			'ziadmajed'				=> 'Ziad Majed',
			'kabobfest'				=> 'Kabob Fest',
			'MichCafe'				=> 'Mich Café',
			'hummusnation'			=> 'جمهورية الحمص ، وكالة الانباء الرسمية',
			'qifanabki'				=> 'Qifa Nabki',
			'theterroristdonkey'	=> 'Thuraya &amp; the Terrorist Donkey',
			'lynch'					=> 'Marc Lynch',
			'lebanonspring'			=> 'Lebanon Spring',
			'marketinginlebanon'	=> 'Marketing in Lebanon',
			'mideastwire'			=> 'The Mideastwire Blog',
			'lbcblogs'				=> 'Lebanese Blogging Community',
			'blkbtrfli'				=> 'Lebanese Voices',
			'saharghazale'			=> 'Un Peu De Kil Shi',
			'mexicaninbeirut'		=> 'Mexican In Beirut',
			'tajaddod-youth'		=> 'Tajaddod Youth',
			'lefigaro'				=> "L'Orient Indiscret",
			'hahussain'				=> 'Hussain Abdul Hussain',
			'Ho0l89IFEuY'			=> 'Brit in Beirut',
			'abirghattas'			=> 'Abir Ghattas',
			'poshlemon'				=> 'Posh Lemon',
			'LifeWithSubtitles'		=> 'Life With Subtitles' ,
			'michcafe'				=> 'Mich Cafe' ,
			'trella'				=> 'مدونة تريلا',
			'smex'					=> 'Social Media Exchange',
			'thinkmedialabs'		=> 'Think Media Labs',
			);

	if (isset($blognames[$domain])){
		return $blognames[$domain];
	}else{
		return "Random Blog";
	}

}

function dig_suitable_image($content) 
/*******************************************************************
*	this function tries to find an image in a blog
*
********************************************************************/ 
{
	// I got the code below from: http://forums.wittysparks.com/topic/simple-way-to-extract-image-src-from-content-with-php
	$contenttograbimagefrom = $content;
	$firstImage = "";
	// old regex // $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $contenttograbimagefrom, $ContentImages);
	$output = preg_match_all('/<img.+src\s*=\s*[\'"]([^\'"]+)[\'"].*>/i', $contenttograbimagefrom, $ContentImages);
	if (isset($ContentImages[1][0]))
	{
		$firstImage = $ContentImages[1][0]; // To grab the first image
		list($width, $height, $type, $attr) = getimagesize("$firstImage");
		if (300 < $width) 
		{
			return $firstImage;
		}
	} 
	elseif (get_youtube_thumb($content)) 
	{
		return get_youtube_thumb($content);
	} 
	else 
	{
		return NULL;
	}
}

function get_youtube_thumb($content)
/*******************************************************************
*	Tries to get youtube content's preview
*
********************************************************************/ 
{
	preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $content, $matches);
	if(isset($matches[2]) && $matches[2] != '')
	{
 		$YoutubeCode = $matches[2];
 		return 'http://img.youtube.com/vi/'.$YoutubeCode.'/0.jpg';
	} 
	else
	{
		return NULL;
	}
}

function get_blog_post_excerpt($content, $length) 
/*******************************************************************
*	Gets blog post excerpt with a length caracter
*
********************************************************************/ 
{

	$sample_paragraph = clean_up($content, $length);
	return $sample_paragraph ;

}

function has_canonical_url ($resource) { // will either return the canonical url or "false"
	$canonical = "no";
	for ($i=0; $i <4 ; $i++) { 
		if (@$resource[$i]['attribs']['']['rel'] == "canonical") {
			$canonical = "yes";
			return $resource[$i]['attribs']['']['href'];
		}
	}
	if ($canonical ="no") {
		return false;
	}
}

function get_thumb($theurl){
	$domain = get_domain($theurl);
	$site = 'images/'.$domain.'.jpg';
	if (file_exists($site)){ 
		return $site;
	}else{
		return "images/noimage.jpg";
	} 
}

?>