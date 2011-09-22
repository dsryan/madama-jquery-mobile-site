<?php
// ini_set('display_errors', 'On');
// error_reporting(E_ALL);

$category = $_GET['category'];

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

if (empty($category))
  $cache = dirname(__FILE__) . "/cache/news";
else
  $cache = dirname(__FILE__) . "/cache/$category";
  
// Re-cache every three hours  
if( !file_exists($cache) || filemtime($cache) < (time() - 10800) ) {
  //echo "getting feed and recreating cache file: $cache";
  if ( !file_exists(dirname(__FILE__) . '/cache') ) {  
    if (!mkdir(dirname(__FILE__) . '/cache', 0777)) {
      die("unable to create directory ("+dirname(__FILE__) . '/cache'+")");
    }
  }
  // grab the site's RSS feed, via YQL
  // YQL query (SELECT * from feed ... ) // Split for readability    
  $path = "http://query.yahooapis.com/v1/public/yql?q=";
  if (empty($category))
    $path .= urlencode("SELECT * FROM feed WHERE url='http://www.madamajj.com/feed'");
  else
    $path .= urlencode("SELECT * FROM feed WHERE url='http://www.madamajj.com/category/$category/feed'");
  $path .= "&format=json";
  // echo $path;  
  
  $feed_string = file_get_contents($path,true);
  // echo ($feed_string);
  
  // Decode that shizzle  
  $feed = json_decode($feed_string);
  // echo $feed->query->count;

  // If something was returned, cache  
  if ( is_object($feed) && $feed->query->count ) {  
    $cachefile = fopen($cache, 'w')
      or exit("unable to open file ($cache)");
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
