<?php 
function display_blogs($from, $howmany)
{
	$feed = new SimplePie(); // We'll process this feed with all of the default options.
	$feed->set_feed_url("http://www.google.com/reader/public/atom/user%2F06686689690592384436%2Fbundle%2FLebanon%20Blogs%202?n=20"); // Set which feed to process.
	$feed->set_cache_duration(600); // Set cache to 10 mins
	$feed->strip_htmltags(false);
	$feed->init(); // Run SimplePie. 
	$feed->handle_content_type(); // This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).

	//begin loop
	$previous_link = ""; // this variable will be used to prevent duplicate posts from showing twice
	foreach($feed->get_items($from,$howmany) as $item) {
		$canonical_resource = $item->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10,'link');
		$canonical_url = has_canonical_url($canonical_resource); // will return either 'false' or a canonical url
		$blog_post_link = ($canonical_url)? $canonical_url : $item->get_permalink();
		$blog_post_thumb = get_thumb($blog_post_link);
		$blog_name = get_blog_name($blog_post_link);
		$blog_post_title = clean_up($item->get_title(), 120);
		$blog_post_content = $item->get_content();
		$blog_post_image = @dig_suitable_image($blog_post_content) ;
		$blog_post_excerpt = get_blog_post_excerpt($blog_post_content);
		$domain = get_domain($blog_post_link);
		if ($item->get_permalink() !== $previous_link ) { //Only go through if not duplicate ?>
			<div class="blogentry <?php if ($domain =="lebaneseblogs") {echo "metablog";} ?>" style ="opacity:0">
			<div class ="thumb_and_title">
				<div class ="blog_thumb"> 			
					<img src ="<?php echo $blog_post_thumb ?>" width ="50">
				</div>				
				<?php echo "\n<!--\n\n$blog_post_content\n\n-->\n"; ?>
				<div class ="blog_info">
					<div class ="blog_name">
						<?php echo $blog_name ; ?>
					</div>
					<div class ="post_title">
						<a href ="<?php echo $blog_post_link ;?>"><?php echo $blog_post_title ?></a>
					</div>
				</div> <!-- /blog_info -->
			</div>
			<div class ="dash_thumbnail">
				<?php 
				if ($blog_post_image) { ?>
					<a href ="<?php echo $blog_post_link ?>"><img width ="318" src ="<?php echo $blog_post_image ?>"></a>
				<?php
				} else {?>
					<a href ="<?php echo $blog_post_link ; ?>"><p><?php echo $blog_post_excerpt ; ?></p></a>
				<?php 
				} ; ?>
			</div><!-- /dash_thumbnail -->
			<div class ="sharing_tools">
				<ul>
					<li>Share: </li>
					<li> <a href="https://twitter.com/share?url=<?php echo $blog_post_link ; ?>" target="_blank">Tweet</a> </li>
					<li> <a href="http://www.facebook.com/sharer.php?u=<?php echo $blog_post_link ; ?>">Facebook</a> </li>
				</ul>
			</div>

			<?php 
				$previous_link = $blog_post_link; 
			?>
		</div> <!-- /blogentry -->
		<?php }}} ?>

	<?php
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

function clean_up($original_string, $length){
	$original_string = html_entity_decode($original_string, ENT_COMPAT, 'utf-8');
	$original_string = strip_tags($original_string);
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
			'YA9FVx1oEYo'			=> "The Platform",
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
			'BPqar'					=> "Joe's Box",
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
			'UnPeuDeKilShi'			=> 'Un Peu De Kil Shi',
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
{
	// I got the code below from: http://forums.wittysparks.com/topic/simple-way-to-extract-image-src-from-content-with-php
	$contenttograbimagefrom = $content;
	$firstImage = "";
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $contenttograbimagefrom, $ContentImages);
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

function get_blog_post_excerpt($content) {

	$sample_paragraph = clean_up($content, 120);
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