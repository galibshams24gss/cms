<?php
session_start();
include_once('includes/connection.php');
include_once('includes/article.php');
$article = new Article;

if(isset($_SESSION['logged_in'])) {
 if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $article->fetch_data($id);

    if(isset($_POST['title'],$_POST['content'])) {
    $title = $_POST['title'];
    $content = nl2br($_POST['content']);

        $sql = "UPDATE articles SET article_title = :title, article_content = :content, article_timestamp = :timestamp WHERE article_id = :id";
        $query = $pdo->prepare($sql);

        $query->bindValue(":title", $title);
        $query->bindValue(":content", $content);
        $query->bindValue(":timestamp", time());
        $query->bindValue(":id", $id);

        try {
          $result = $query->execute();
        } catch(PDOException $e) {
          echo $e->getCode() . " - " . $e->getMessage();
        }

        if($result) {
          header("Location: index.php");;
        }
    }
 }
}
?>