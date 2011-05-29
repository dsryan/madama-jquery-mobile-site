<!DOCTYPE html>  
<html>  
   <head>  
   <meta charset="utf-8">  
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
  
   <title> Madama Jiu-Jitsu Academy </title>   
  
   <script src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
   <script src="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.js"></script>
   <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.css" />
</head>
<body>   
<style>
  .ui-li-heading { font-size: 12px; }
</style>  
<div data-role="page">  
   <header data-role="header" class="<?php echo $siteName; ?>">  
      <h1><?php echo ucwords($category); ?></h1>  
   </header>  
    
   <div data-role="content">
     <?php if ($feed->query->count > 0) { ?>
       <ul data-role="listview">
         <?php foreach($feed->query->results->item as $item) { ?>  
              <li>  
                 <a href="article.php?siteName=<?php echo $siteName;?>&origLink=<?php echo urlencode($item->guid->content); ?>">  
                   <?php echo $item->title; ?>  
                 </a>  
                <!--span class="ui-li-count"><?php echo $item->comments[1]; ?> </span-->  
             </li>  
         <?php } ?>
       </ul>
     <?php } else { ?>
     	<span>No articles could be found at this time. Check back soon.</span>
	<? } ?>
   </div>  
  
   <footer data-role="footer" class="<?php echo $siteName; ?>">  
      <h4 style="font-size:smaller">www.madamajj.com</h4>  
   </footer>  
</div>  
  
</body>  
</html>