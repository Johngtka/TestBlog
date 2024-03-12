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

    foreach ($newArt['ArtAuthorPrimal'] as $authorId) {
        $query2 = $db->prepare('INSERT INTO article_authors VALUES(NULL, :ArtId, :AuthorId)');
        $query2->bindValue(':ArtId', $lastInsertId, PDO::PARAM_INT);
        $query2->bindValue(':AuthorId', $authorId, PDO::PARAM_INT);
        $query2->execute();
    }

    // echo "create";
    header('Location: index.php');
    exit;
} else if (isset($_SESSION['articles_filtered']) && $_SESSION['articles_filtered'] !== false) {
    // $articleId = $_SESSION['SearchParameters'];
    // $query = $db->prepare('SELECT * FROM articles WHERE id=:Id');
    // $query->bindValue(':Id', $articleId, PDO::PARAM_STR);
    // $query->execute();
    // $_SESSION['FR'] = $query->fetch();
    var_dump($_SESSION);

    // Pobierz ID ostatnio wstawionego artykułu
    // $lastInsertId = $db->lastInsertId();

    // foreach ($newArt['ArtAuthorPrimal'] as $authorId) {
    //     $query2 = $db->prepare('INSERT INTO article_authors VALUES(NULL, :ArtId, :AuthorId)');
    //     $query2->bindValue(':ArtId', $lastInsertId, PDO::PARAM_INT);
    //     $query2->bindValue(':AuthorId', $authorId, PDO::PARAM_INT);
    //     $query2->execute();
    // }
    // echo $_POST['articleId'];
    header('Location: index.php');
    exit;
}
