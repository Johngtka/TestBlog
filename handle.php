<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {
    $_SESSION['article_added'] = true;

    $newArticle = [
        'ArtTitle' => filter_input(INPUT_POST, 'title'),
        'ArtContent' => filter_input(INPUT_POST, 'text'), 'ArtDateCreate' => filter_input(INPUT_POST, 'date'),
        'ArtAuthor' => filter_input(INPUT_POST, 'author')
    ];
    $_SESSION['NewArticle'] = $newArticle;

    header('Location: api.php');
    exit;
}
