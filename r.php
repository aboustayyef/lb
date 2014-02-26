<?php 

require_once("init.php");

if (isset($_GET["r"])){
	$target_url = urldecode($_GET["r"]);
}

if (isset($_GET["debug"])){
    $debug_mode = TRUE;
} else {
    $debug_mode = FALSE;
}

if (isset($target_url)) {
	register_exit($target_url);
	go_to($target_url);
} else {
	go_to("http://lebaneseblogs.com/?bad_redirect_request");
}

function go_to($url){
    global $debug_mode;
    if (!$debug_mode) {
        header("Location: $url");
    }
}

function register_exit($url){
global $debug_mode;

//prepare and connect to database
$connection = DB::getInstance();
$browser = getBrowser();
$ref_ip = getIP();

if ($debug_mode) {
    echo "IP: $ref_ip \n";
    echo "browser: $browser \n";
    echo "exit_time: ".time()."\n";
    echo "USER DETAILS: \n";
    echo '<pre>',print_r($browser),'</pre>';
} else {
    $connection->insert( 'exit_log', array(
        'exit_time' => time(),
        'exit_url'  => $url,
        'user_agent'    => $browser['name'],
        'ip_address'    => $ref_ip,
    ));
}

// update counter for post

if ($debug_mode) {
    $query0 = 'SELECT * FROM exit_log WHERE ip_address ="' . $ref_ip . '" AND exit_url ="' . $url . '"';
    echo "\n\n\n";
    echo "Query: $query0";
    echo '<pre>',print_r($connection->query($query0)->results()),'</pre>';
    echo 'count: '.count($connection->query($query0)->results());

} else {
    if ($browser['name'] !== 'Unknown') { // if this is a human user
        // logic to check if ip not used before
        $query0 = 'SELECT * FROM exit_log WHERE ip_address ="' . $ref_ip . '" AND exit_url ="' . $url . '"';
        if (count($connection->query($query0)->results()) < 1  ) { // if this combination of ip address and exit link does not exist
            // only then update the counter
            $query = 'UPDATE posts SET post_visits = post_visits+1 WHERE post_url = "'.$url.'"';
            $connection->query($query);
        }
    }

}


// enter here code to query post record with specified URL, then add +1 to new post_clicks field.

}

function getBrowser() //source: http://us.php.net/get-browser
{ 
    global $debug_mode;
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 

function getIP() { 
    global $debug_mode;
    $ip; 
    if (getenv("HTTP_CLIENT_IP")) 
    $ip = getenv("HTTP_CLIENT_IP"); 
    else if(getenv("HTTP_X_FORWARDED_FOR")) 
    $ip = getenv("HTTP_X_FORWARDED_FOR"); 
    else if(getenv("REMOTE_ADDR")) 
    $ip = getenv("REMOTE_ADDR"); 
    else 
    $ip = "UNKNOWN";
    return $ip; 
}

?>