<?php
session_start();
include_once('../includes/connection.php');

if(isset($_SESSION['logged_in'])) {
	//Added page
	if(isset($_POST['title'],$_POST['content'])){
		$title = $_POST['title'];
		$content = nl2br($_POST['content']);
		
		if(empty($title) or empty($content)){
			$error = 'Required to Add!';
		}else{
			$query = $pdo->prepare('INSERT INTO articles (article_title, article_content, article_timestamp) VALUES (?,?,?)');
			$query->bindValue(1,$title);
			$query->bindValue(2,$content);
			$query->bindValue(3,time());
			
			$query->execute();
			header('Location: index.php');
		}
	}
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

<h4>Add an Article</h4>

<?php if(isset($error)) { ?>
	<small style="color: red;"><?php echo $error; ?></small>
<?php } ?>

<br/>

<form action="add.php" method="post" autocomplete="off" >
<input type="text" name="title" placeholder="Title"/><br/><br/>
<textarea rows="15" cols="50" name="content" placeholder="Content"></textarea><br/><br/>
<input type="submit" value="Add an Article" onclick="alert('Article has been added')"/>
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