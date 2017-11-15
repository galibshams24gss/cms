<?php
session_start();
include_once('../includes/connection.php');
include_once('../includes/article.php');
$article = new Article;
$articles = $article->fetch_all();

if(isset($_SESSION['logged_in'])) {
	//display index page	
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
<ol>

<li><a href="add.php">Add Article</a></li>
<li><a href="update.php">Update Article</a></li>
<li><a href="delete.php">Delete Article</a></li>
<li><a href="logout.php">Logout</a></li>

</ol>
</div>
</body>
</html>
	
	
<?php	
}else{
	//display login page if not logged in
	if(isset($_POST['username'],$_POST['password'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		//empty
		if(empty($username) or empty($password)){
			$error = 'All fields are required !';
		}else{ 
			//correct or not
			$query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");
			$query->bindValue(1, $username);
			$query->bindValue(2, $password);
			$query->execute();
			
			$num = $query->rowCount();
			if($num == 1){
				//correct details
				$_SESSION['logged_in'] = true;
				header('Location: index.php');
				exit();
			}else{
				//incorrect details
				$error = 'Incorrect Details!';
			}
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
<br/><br/>

<?php if(isset($error)) { ?>
	<small style="color: red;"><?php echo $error; ?></small>
<?php } ?>

<br/><br/>
<h3>Please Log in to the System</h3>
<form action="index.php" method="post" autocomplete="off">
<input type="text" name="username" placeholder="Username"/>
<input type="password" name="password" placeholder="Password"/>
<input type="submit" value="Login"/>
</form>

<br/><br/>
<a href="http://localhost/cms/index.php">&larr; Back</a>

</div>
</body>
</html>
<?php
}
?>