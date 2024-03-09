<?php
require_once('PDOEngine.php');

if (isset($_SESSION['article_added']) && $_SESSION['article_added'] !== false) {
    $newArt = $_SESSION['NewArticle'];
    $query = $db->prepare('INSERT INTO articles VALUES(NULL, :title, :content,:date, :author)');
    $query->bindValue(':title', $newArt['ArtTitle'], PDO::PARAM_STR);
    $query->bindValue(':content', $newArt['ArtContent'], PDO::PARAM_STR);
    $query->bindValue(':date', $newArt['ArtDateCreate'], PDO::PARAM_STR);
    $query->bindValue(':author', $newArt['ArtAuthor'], PDO::PARAM_STR);
    $query->execute();
    header('Location: index.php');
    exit;
}
