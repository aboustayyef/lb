<?php 
// input text is in the file input.txt
$handle = fopen("input.txt", "r");
$input = fread($handle, filesize("input.txt"));

// create an array with all the words used
$all_one_words = array();
//$all_one_words = explode(" ", $input);
$all_one_words = preg_split("/( \.*|\.* | |\.)/", $input);

//echo "<h2>All one Words</h2>";
//echo "<pre>", print_r($all_one_words, true), "</pre>";

// sanitize all_one_words

foreach ($all_one_words as $key=>$one_word) {
	//$all_one_words[$key]= preg_replace("/'s|’s/i", "", $one_word);
	$all_one_words[$key]= preg_replace("/[^a-zA-Z0-9_]/i", "",$all_one_words[$key]);
	if ($all_one_words[$key] =="" || $all_one_words[$key] ==" ") {
		unset($all_one_words[$key]);
	}
}

//echo "<h2>All one Words (sanitized)</h2>";
//echo "<pre>", print_r($all_one_words, true), "</pre>";

// remove common words to create $all_uncommon_wordsd
$stopwords = array("a", "about", "above", "above", "across", "after", "afterwards", "again", "against", "all", "almost", "alone", "along", "already", "also","although","always","am","among", "amongst", "amoungst", "amount",  "an", "and", "another", "any","anyhow","anyone","anything","anyway", "anywhere", "are", "around", "as",  "at", "back","be","became", "because","become","becomes", "becoming", "been", "before", "beforehand", "behind", "being", "below", "beside", "besides", "between", "beyond", "bill", "both", "bottom","but", "by", "call", "can", "cannot", "cant", "co", "con", "could", "couldnt", "cry", "de", "describe", "detail", "do", "done", "down", "due", "during", "each", "eg", "eight", "either", "eleven","else", "elsewhere", "empty", "enough", "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "few", "fifteen", "fify", "fill", "find", "fire", "first", "five", "for", "former", "formerly", "forty", "found", "four", "from", "front", "full", "further", "get", "give", "go", "had", "has", "hasnt", "have", "he", "hence", "her", "here", "hereafter", "hereby", "herein", "hereupon", "hers", "herself", "him", "himself", "his", "how", "however", "hundred", "i", "ie", "if", "in", "inc", "indeed", "interest", "into", "is", "it", "its", "itself", "keep", "last", "latter", "latterly", "least", "less", "ltd", "made", "many", "may", "me", "meanwhile", "might", "mill", "mine", "more", "moreover", "most", "mostly", "move", "much", "must", "my", "myself", "name", "namely", "neither", "never", "nevertheless", "next", "nine", "no", "nobody", "none", "noone", "nor", "not", "nothing", "now", "nowhere", "of", "off", "often", "on", "once", "one", "only", "onto", "or", "other", "others", "otherwise", "our", "ours", "ourselves", "out", "over", "own","part", "per", "perhaps", "please", "put", "rather", "re", "same", "see", "seem", "seemed", "seeming", "seems", "serious", "several", "she", "should", "show", "side", "since", "sincere", "six", "sixty", "so", "some", "somehow", "someone", "something", "sometime", "sometimes", "somewhere", "still", "such", "system", "take", "ten", "than", "that", "the", "their", "them", "themselves", "then", "thence", "there", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "they", "thickv", "thin", "third", "this", "those", "though", "three", "through", "throughout", "thru", "thus", "to", "together", "too", "top", "toward", "towards", "twelve", "twenty", "two", "un", "under", "until", "up", "upon", "us", "very", "via", "was", "we", "well", "were", "what", "whatever", "when", "whence", "whenever", "where", "whereafter", "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", "which", "while", "whither", "who", "whoever", "whole", "whom", "whose", "why", "will", "with", "within", "without", "would", "yet", "you", "your", "yours", "yourself", "yourselves", "the"); // there are more but let's assume these for now
$stop_phrase_words = array("and", "the", "a", "an", "or", "is", "to");
$all_uncommon_words =array();

foreach ($all_one_words as $key=>$word) {
	if (!in_array(strtolower($word),$stopwords)) {
		$all_uncommon_words[$key] = strtolower($word);
		$all_uncommon_words[$key] = preg_replace("/[^a-zA-Z0-9]/i", "", $all_uncommon_words[$key]); //remove other caracters;
	}
	if (($all_uncommon_words[$key] == "") || ($all_uncommon_words[$key] == " ")) { 
		unset($all_uncommon_words[$key]);
	}
}

// Unquote below for debugging 

//echo "<h2>All Uncommon Words</h2>";
//echo "<pre>", print_r($all_uncommon_words, true), "</pre>";


$counting = array(); // serves for counting all words
$keywords = array(); // will add all words that are repeated more than twice

foreach ($all_uncommon_words as $word) {
	$counting[$word] +=1;
	if ($counting[$word] >1 ) { //is a keyword
		if (!in_array($word, $keywords)) {
			$keywords[$word] = $counting[$word];
		}
	}
}
arsort($keywords);
echo "<h2>Repeated Keywords</h2>";
echo "<pre>", print_r($keywords, true), "</pre>";

/*******************************************************************
*	Let's now work on 2-word terms
*
********************************************************************/ 

$all_two_words = array();
$counter=0;
$counter_limit = count($all_one_words)-1;

foreach ($all_one_words as $one_word) {
	if ($counter < $counter_limit) {
			$all_two_words[$counter]= $all_one_words[$counter]." ".$all_one_words[$counter+1]; 
		}
	$counter++ ;
}

//echo "<h2>All Two Words</h2>";
//echo "<pre>", print_r($all_two_words, true), "</pre>";

// clean up Two-words of stop words
foreach ($all_two_words as $key=>$two_word) {
	$individual_word = explode(" ", $two_word);
	if (in_array($individual_word[0], $stopwords) && in_array($individual_word[1], $stopwords)) {
		// Remove when both words are stop words
		unset($all_two_words[$key]);
	} else if ((in_array(strtolower($individual_word[0]), $stop_phrase_words)) || (in_array(strtolower($individual_word[1]), $stop_phrase_words))){
		// Remove when one of the words is "the" or "and" or "a" ..etc
		unset($all_two_words[$key]);
	}
}


$counting = array(); // serves for counting all words
$key_two_words = array(); // will add all words that are repeated more than twice

foreach ($all_two_words as $two_word) {
	$counting[$two_word] +=1;
	if ($counting[$two_word] >1 ) { //is a keyword
		if (!in_array($two_word, $key_two_words)) {
			$key_two_words[$two_word] = $counting[$two_word];
		}
	}
}
arsort($key_two_words);
echo "<h2>Key Two-Words</h2>";
echo "<pre>", print_r($key_two_words, true), "</pre>";

/*******************************************************************
*	Finally Let's now work on 3-word terms
*
********************************************************************/ 
$all_three_words = array();
$counter=0;
$counter_limit = count($all_one_words)-1;

foreach ($all_one_words as $one_word) {
	if ($counter < $counter_limit) {
			$all_three_words[$counter]= $all_one_words[$counter]." ".$all_one_words[$counter+1]." ".$all_one_words[$counter+2]; 
		}
	$counter++ ;
}

//echo "<h2>All Three Words</h2>";
//echo "<pre>",print_r($all_three_words),"</pre>";


// clean up Two-words of stop words
foreach ($all_three_words as $key=>$three_word) {
	$individual_word = explode(" ", $three_word);
	if (in_array($individual_word[0], $stopwords) && in_array($individual_word[2], $stopwords)) {
		// Remove when extremity words are both stop words
		unset($all_three_words[$key]);
	} else if ((in_array(strtolower($individual_word[0]), $stop_phrase_words)) || (in_array(strtolower($individual_word[2]), $stop_phrase_words))){
		// Remove when one of the  extremity words is "the" or "and" or "a" ..etc
		unset($all_three_words[$key]);
	}
}

//echo "<h2>All Sanitized Three Words</h2>";
//echo "<pre>",print_r($all_three_words),"</pre>";

$counting = array(); // serves for counting all words
$key_three_words = array(); // will add all words that are repeated more than twice

foreach ($all_three_words as $three_word) {
	$counting[$three_word] +=1;
	if ($counting[$three_word] >1 ) { //is a keyword
		if (!in_array($three_word, $key_three_words)) {
			$key_three_words[$three_word] = $counting[$three_word];
		}
	}
}
echo "<h2>Key Three Words</h2>";
echo "<pre>",print_r($key_three_words),"</pre>";

?>