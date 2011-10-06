<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
	<title> Madama Jiu-Jitsu Academy </title>     
</head>
<body>

<div data-role="page" data-theme="a">  
  
	<header data-role="header" class="header">  
		<h1> <?php echo ucwords($category); ?> </h1>  
	</header>  
  
	<section data-role="content" class="content">
  	<header>
      <h2> <?php echo $article->title; ?> </h2>
    </header>
    <article>
			<?php echo $article->encoded; ?>
		</article>
	</section>  
  
   <footer data-role="footer" class="footer">  
      <h4 style="font-size:small"><a href="<?php echo $article->guid->content;?>"> Read on <?php echo 'Madama JJ'; ?></a></h4>  
   </footer>  
</div>  
  
</body>  
</html>