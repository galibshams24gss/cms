<?php
include_once('includes/connection.php');
$search=$_POST['search'];
$sql = "SELECT * FROM articles WHERE article_title LIKE '%$search%'";
$srch = $pdo->query($sql);
$count = $srch->rowCount();
?>
<table class="table table-striped">
<tr>
<th>Title</th>
</tr>
<?php
if($count > 0)
{
	while($data = $srch->fetch(PDO::FETCH_ASSOC))
	{
		echo "<tr>";
		echo "<td>".$data['article_title'],"</td>";
	}	
}
else{
	echo "Article Not Found!";
}
?>
</table>