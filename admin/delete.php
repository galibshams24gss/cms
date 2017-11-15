<?php
session_start();
include_once('../includes/connection.php');
include_once('../includes/article.php');
$article = new Article;

if(isset($_SESSION['logged_in'])) {
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
		$query->bindValue(1,$id);
		$query->execute();
		
		header('Location: delete.php');
	}
	//display Deleted
	$articles = $article->fetch_all();
?>

<html>
<head>
<title>CMS</title>
<link rel="stylesheet" href="../assets/style.css" />
</head>
<body style="background: url('Material-wallpaper-048-1.jpg') no-repeat; background-size: cover;">
<div class = "container">
<a href="index.php" id="logo">CMS</a>
<br/>
<h4>Select an Article to Delete</h4>
<form action="delete.php" method="get" >
<select onchange="this.form.submit();" name="id" size=15>
<?php foreach($articles as $article) { ?>
<option onclick="return confirm('Are you sure to Delete?')" 
value="<?php echo $article['article_id'];?>"><?php echo $article['article_title'];?></option>
<?php } ?>
</select>
</form>
<br/><br/>
<a href="index.php">&larr; Back</a>
</div>
</body>
</html>
	
<?php	
}else{
	header('Location: index.php');
}
?>