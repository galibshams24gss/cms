<?php
include_once('includes/connection.php');
include_once('includes/article.php');
$article = new Article;
$articles = $article->fetch_all();    //access article variable with method
?>

<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CMS</title>
<link rel="stylesheet" href="assets/style.css" />
<script src="js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background: url('Material-wallpaper-048-1.jpg') no-repeat; background-size: cover;">
<div class = "container">
<div class = "row">
<div class = "col-md-3"></div>
<div class = "col-md-6 well" style="margin-top:5%;">
<form action="search.php" method="post">
  <div class="form-group">
    <label class="sr-only" for="exampleInput"></label>
    <div class="input-group">
      <div class="input-group-addon">Search</div>
      <input type="text" class="form-control search" name="search" placeholder="Search By Article Title">
      <div class="input-group-addon glyphicon glyphicon-search"></div>
    </div>
  </div>
</form>
<div class="success"></div>
</div>
</div>
<a href="index.php" id="logo">CMS</a><br/>
<small><img src="gears.gif" style="width:4%;height:4%;"/><a href="admin"><b> ADMIN PANEL</b></a></small>
<ol>
<?php foreach ($articles as $article) { ?>
<li><a href="displayarticles.php?id=<?php echo $article['article_id'];?>">
<?php echo $article['article_title'];?></a> - posted<small>
<?php echo date('l jS',$article['article_timestamp']);?>
</small></li>
<?php } ?></ol>

<br/>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$('document').ready(function(){
	$('.search').keyup(function(){
		var search = $(this).val();
		//alert(search);
		$.post($('form').attr('action'),
		{'search':search},
		function(data){
			$('.success').html(data);
		}
		)
	})
})
</script>
</body>
</html>