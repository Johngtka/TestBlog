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
if ($_SERVER['REQUEST_METHOD'] === 'post' && isset($_POST['edit_article'])) {
    $_SESSION['article_edited'] = true;
    $editedArticle = [
        'ArtTitle' => filter_input(INPUT_POST, 'title'),
        'ArtContent' => filter_input(INPUT_POST, 'text'), 'ArtDateCreate' => filter_input(INPUT_POST, 'date'),
        'ArtAuthor' => filter_input(INPUT_POST, 'author')
    ];
    $_SESSION['EditedArticle'] = $editedArticle;

    header('Location: api.php');
    exit;
}
