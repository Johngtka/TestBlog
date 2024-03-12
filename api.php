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
    unset($_SESSION['article_added']);
    unset($_SESSION['NewArticle']);
    header('Location: index.php');
    exit;
} else if (isset($_SESSION['articles_filtered']) && $_SESSION['articles_filtered'] !== false) {
    $articleId = $_SESSION['SearchParameters'];
    $query = $db->prepare('SELECT * FROM articles WHERE id=:Id');
    $query->bindValue(':Id', $articleId, PDO::PARAM_STR);
    $query->execute();
    $_SESSION['FR'] = $query->fetch();
    unset($_SESSION['articles_filtered']);
    header('Location: index.php');
    exit;
} else if (isset($_SESSION['authors_filtered']) && $_SESSION['authors_filtered'] !== false) {

    $authorId = $_SESSION['SearchParameters'];
    $query = $db->prepare(
        'SELECT a.*, c.name AS AuthorName 
        FROM articles AS a 
        JOIN article_authors AS b ON b.article_id = a.id 
        JOIN authors AS c ON c.id = b.author_id 
        WHERE b.author_id = :Id'
    );
    $query->bindValue(':Id', $authorId, PDO::PARAM_STR);
    $query->execute();
    $_SESSION['AR'] = $query->fetchAll();
    unset($_SESSION['authors_filtered']);
    header('Location: index.php');
    exit;
} else if (isset($_SESSION['show_top_3']) && $_SESSION['show_top_3'] !== false) {
    $query = $db->prepare(
        'SELECT
        author.name AS Author_Name,
        COUNT(*) AS Num_Articles_Submitted
        FROM
            Articles article
        JOIN article_authors aa ON
            article.id = aa.article_id
        JOIN Authors author ON
            aa.author_id = author.id
        WHERE
            article.submission_date >= CURDATE() - INTERVAL 1 WEEK
        GROUP BY
            author.id
        ORDER BY
            Num_Articles_Submitted
        DESC
        LIMIT 3'
    );
    $query->execute();
    $_SESSION['ST'] = $query->fetchAll();
    unset($_SESSION['show_top_3']);
    header('Location: index.php');
    exit;
} else if (isset($_SESSION['edited_article']) && $_SESSION['edited_article'] !== false) {
    $editArticle = $_SESSION['edit_data'];
    $query = $db->prepare('UPDATE articles SET title = :title, text= :content, submission_date = :date WHERE id=:Id');
    $query->bindValue(':title', $editArticle['ArtTitle'], PDO::PARAM_STR);
    $query->bindValue(':content', $editArticle['ArtContent'], PDO::PARAM_STR);
    $query->bindValue(':date', $editArticle['ArtDateCreate'], PDO::PARAM_STR);
    $query->bindValue(':Id', $editArticle['ArtId'], PDO::PARAM_INT);
    $query->execute();
    unset($_SESSION['edited_article']);
    header('Location: index.php');
    exit;
}
