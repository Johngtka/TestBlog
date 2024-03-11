<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {
    $_SESSION['article_added'] = true;
    $newArticle = [
        'ArtTitle' => filter_input(INPUT_POST, 'title'),
        'ArtContent' => filter_input(INPUT_POST, 'text'), 'ArtDateCreate' => filter_input(INPUT_POST, 'date'),
        'ArtAuthorPrimal' => filter_input(INPUT_POST, 'author1'),
        'ArtAuthorSecondary' => filter_input(INPUT_POST, 'author2')
    ];
    $_SESSION['NewArticle'] = $newArticle;

    header('Location: api.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_article'])) {
    $_SESSION['article_edited'] = true;
    $editedArticle = [
        'ArtTitle' => filter_input(INPUT_POST, 'title'),
        'ArtContent' => filter_input(INPUT_POST, 'text'), 'ArtDateCreate' => filter_input(INPUT_POST, 'date'),
        'ArtAuthorPrimal' => filter_input(INPUT_POST, 'author1'),
        'ArtAuthorSecondary' => filter_input(INPUT_POST, 'author2')
    ];
    $_SESSION['EditedArticle'] = $editedArticle;

    header('Location: api.php');
    exit;
}
