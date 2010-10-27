<?php 

$siteName = empty($_GET['siteName']) ? 'madamajj' : $_GET['siteName'];

// // Prepare array of tutorial sites  
// $siteList = array(  
//    'nettuts',  
//    'flashtuts',  
//    'webdesigntutsplus',  
//    'psdtuts',  
//    'vectortuts',  
//    'phototuts',  
//    'mobiletuts',  
//    'cgtuts',  
//    'audiotuts',  
//    'aetuts'  
// );

// // If the string isn't a site name, just change to nettuts instead.  
// if ( !in_array($siteName, $siteList) ) {  
//    $siteName = 'nettuts';  
// }

$cache = dirname(__FILE__) . "/cache/madama";

// Re-cache every three hours  
if( filemtime($cache) < (time() - 10800) ) {
  if ( !file_exists(dirname(__FILE__) . '/cache') ) {  
    mkdir(dirname(__FILE__) . '/cache', 0777);  
  } 
  // grab the site's RSS feed, via YQL
  // YQL query (SELECT * from feed ... ) // Split for readability  
  $path = "http://query.yahooapis.com/v1/public/yql?q=";  
  $path .= urlencode("SELECT * FROM feed WHERE url='http://www.madamajj.com/feed'");  
  $path .= "&format=json";
  
  $feed_string = file_get_contents($path,true);

  // Decode that shizzle  
  $feed = json_decode($feed_string);

  // If something was returned, cache  
  if ( is_object($feed) && $feed->query->count ) {  
    $cachefile = fopen($cache, 'w');  
    fwrite($cachefile, $feed_string);  
    fclose($cachefile);  
  }  
} else {
  // We already have local cache. Use that instead.  
  $feed_string = file_get_contents($cache);  
  $feed = json_decode($feed_string);
}

include('views/site.tmpl.php');

?>
