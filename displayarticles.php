<?php
include_once('includes/connection.php');
include_once('includes/article.php');
$article = new Article;

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$data = $article->fetch_data($id);
	//print_r($data);
?>
<html>
<head>
<title>CMS</title>
<link rel="stylesheet" href="assets/style.css" />
</head>
<body style="background: url('Material-wallpaper-048-1.jpg') no-repeat; background-size: cover;">
<div class = "container">
<a href="index.php" id="logo">CMS</a><br/>
<a href="edit.php?id=<?php echo $data['article_id'];?>"><small>Edit</small></a><br/>
<h4><?php echo $data['article_title'];?>
<small>
posted <?php echo date('l jS',$data['article_timestamp']);?>
</small>
</h4>

<p>
<?php echo $data['article_content'];?>
</p>

<a href="index.php">&larr; Back</a>
</div>
</body>
</html>
	<?php
} else{
	header('Location: index.php');
	exit();
}
?>