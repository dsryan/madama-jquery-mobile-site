<?php  
  
$siteName = $_GET['siteName'];  
$origLink = $_GET['origLink'];  
  
// YQL query (SELECT * from feed ... ) // Split for readability  
$path = "http://query.yahooapis.com/v1/public/yql?q=";  
$path .= urlencode("SELECT * FROM feed WHERE url='http://www.madamajj.com/feed' AND guid='$origLink'");  
$path .= "&format=json";  
  
$feed = json_decode(file_get_contents($path));  
$feed = $feed->query->results->item;  
  
include('views/article.tmpl.php');
          
?>