<?php  
  
$siteName = $_GET['siteName'];
$category = $_GET['category'];
$origLink = $_GET['origLink'];

if (empty($category))
  $cache = dirname(__FILE__) . "/cache/news";
else
  $cache = dirname(__FILE__) . "/cache/$category";

if ( !file_exists($cache) || filemtime($cache) < (time() - 10800) ) {
  $path = "http://query.yahooapis.com/v1/public/yql?q=";
  if (empty($category))
    $path .= urlencode("SELECT * FROM feed WHERE url='http://www.madamajj.com/feed'");
  else
    $path .= urlencode("SELECT * FROM feed WHERE url='http://www.madamajj.com/category/$category/feed'");
  //$path .= urlencode("SELECT * FROM feed WHERE url='http://www.madamajj.com/feed' AND guid='$origLink'");  
  $path .= "&format=json";  
  
  $feed = json_decode(file_get_contents($path));  
  $feed = $feed->query->results->item;
} else {
  //echo "retrieving from the cache: $cache";
  
  // We already have local cache. Use that instead.  
  $feed_string = file_get_contents($cache);
  $feed = json_decode($feed_string);
  //echo "$feed_string";
  $articles = $feed->query->results->item;
  //when the feed comes back with only one item its not an array so we need to turn it into an array
  if (!is_array($articles)) { $articles = array($articles); }
  foreach ($articles as $article) {
    if ($article->guid->content == $origLink) {
      break;
    }
  }

}
  
include('views/article.tmpl.php');
          
?>