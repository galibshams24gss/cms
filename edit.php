<?php
session_start();
include_once('includes/connection.php');
include_once('includes/article.php');
$article = new Article;

if(isset($_SESSION['logged_in'])) {
 if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$data = $article->fetch_data($id);
	$query = $pdo->prepare("SELECT * FROM articles WHERE article_id = ?");
	$query->bindValue(1, $id);
	$query->execute();
?>

<html>
<head>
<title>CMS</title>
<link rel="stylesheet" href="assets/style.css" />
</head>
<body style="background: url('Material-wallpaper-048-1.jpg') no-repeat; background-size: cover;">
<div class = "container">
<a href="index.php" id="logo">CMS</a>
<br/>

<h4>Edit Article</h4>
<br/>

<form action="updated.php?id=<?php echo $data['article_id'];?>" method="post">
<input type="text" name="title" value="<?php echo $data['article_title'];?>"/><br/><br/>
<textarea rows="15" cols="100" name="content"><?php echo $data['article_content'];?></textarea><br/><br/>
<input type="submit" name="btn" value="UPDATE" onclick="alert('Article has been updated')"/>
</form>

</div>
</body>
</html>

<?php
 }
}else{
	header("Location: http://localhost/cms/admin/index.php");
}
?>