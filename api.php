<?php
require_once('PDOEngine.php');

if (isset($_SESSION['article_added']) && $_SESSION['article_added'] !== false) {
    $newArt = $_SESSION['NewArticle'];

    $query = $db->prepare('INSERT INTO articles VALUES(NULL, :title, :content, :date)');
    $query->bindValue(':title', $newArt['ArtTitle'], PDO::PARAM_STR);
    $query->bindValue(':content', $newArt['ArtContent'], PDO::PARAM_STR);
    $query->bindValue(':date', $newArt['ArtDateCreate'], PDO::PARAM_STR);
    $query->execute();

    // Pobierz ID ostatnio wstawionego artykułu
    $lastInsertId = $db->lastInsertId();

    // Dodaj informacje o autorach do tabeli article_authors
    $query2 = $db->prepare('INSERT INTO article_authors VALUES(NULL, :ArtId, :AuthorId)');
    $query2->bindValue(':ArtId', $lastInsertId, PDO::PARAM_INT);
    $query2->bindValue(':AuthorId', $newArt['ArtAuthorPrimal'], PDO::PARAM_INT);
    $query2->execute();


    header('Location: index.php');
    exit;
}
