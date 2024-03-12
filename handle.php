<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_article']) && $_POST['add_article'] === "Dodaj Artykuł") {
        unset($_SESSION['articles_filtered']);
        $_SESSION['article_added'] = true;
        $newArticle = [
            'ArtTitle' => filter_input(INPUT_POST, 'title'),
            'ArtContent' => filter_input(INPUT_POST, 'text'),
            'ArtDateCreate' => filter_input(INPUT_POST, 'date'),
            'ArtAuthorPrimal' => $_POST['author']
        ];
        $_SESSION['NewArticle'] = $newArticle;
        header('Location: api.php');
        exit;
    }

    if (isset($_POST['filter_results']) && $_POST['filter_results'] === "Filtruj") {
        unset($_SESSION['article_added']);
        unset($_POST['filter_results']);
        $_SESSION['articles_filtered'] = true;
        $_SESSION['SearchParameters'] = $_POST['articleId'];
        header('Location: api.php');
        exit;
    }
    if (isset($_POST['filter_authors']) && $_POST['filter_authors'] === "Filtruj") {
        unset($_SESSION['article_added']);
        unset($_SESSION['articles_filtered']);
        $_SESSION['authors_filtered'] = true;
        $_SESSION['SearchParameters'] = $_POST['author'];

        header('Location: api.php');
        exit;
    }
    if (isset($_POST['top_3_authors']) && $_POST['top_3_authors'] === "Pokaż") {
        unset($_SESSION['article_added']);
        unset($_SESSION['articles_filtered']);
        unset($_POST['filter_authors']);
        $_SESSION['show_top_3'] = true;
        header('Location: api.php');
        exit;
    }
}
   

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_article'])) {
//     $_SESSION['article_edited'] = true;
//     $editedArticle = [
//         'ArtTitle' => filter_input(INPUT_POST, 'title'),
//         'ArtContent' => filter_input(INPUT_POST, 'text'), 'ArtDateCreate' => filter_input(INPUT_POST, 'date'),
//         'ArtAuthorPrimal' => filter_input(INPUT_POST, 'author1'),
//         'ArtAuthorSecondary' => filter_input(INPUT_POST, 'author2')
//     ];
//     $_SESSION['EditedArticle'] = $editedArticle;

//     header('Location: api.php');
//     exit;
// }
