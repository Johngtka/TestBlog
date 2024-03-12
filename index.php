<?php
require_once './PDOEngine.php';
$query = $db->prepare('SELECT articles.id, articles.title, articles.text, articles.submission_date, GROUP_CONCAT(authors.name SEPARATOR \', \') AS author_names FROM articles
INNER JOIN article_authors ON articles.id = article_authors.article_id
INNER JOIN authors ON article_authors.author_id = authors.id
GROUP BY articles.id, articles.title, articles.text, articles.submission_date;');
$query->execute();
$query1 = $db->query('SELECT * FROM authors');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Main Doc</title>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', (event) => {
            let newNews = document.querySelector('#createNews');
            let editNews = document.querySelector('#editNews');
            let backButton = document.querySelector('#backButton');

            editNews.style.display = 'none';
            backButton.style.display = 'none';


            window.editFormShowing = function(clickedButton) {
                var articleId = clickedButton.getAttribute('data-id');
                document.querySelector('#editNews input[name="article_id"]').value = articleId;

                newNews.style.display = 'none';
                editNews.style.display = 'block';

                backButton.style.display = 'block';
            };


            window.goBack = function() {
                newNews.style.display = 'block';
                editNews.style.display = 'none';
                backButton.style.display = 'none';
            };
        });
    </script>
</head>

<body>
    <header>
        <h1>Test News Blog</h1>
    </header>
    <main>
        <section class="newsPanel">
            <h2>Lista Newsów w Serwisie</h2>

            <div class="tilesLayers" id="listOfAllArticles">
                <?php
                while ($row = $query->fetch()) {
                ?>
                    <div class="newTile">
                        <h3><?php echo $row['title']; ?></h3>
                        <p><?php echo $row['text']; ?></p>
                        <p><?php echo $row['submission_date']; ?></p>
                        <p><?php echo $row['author_names']; ?></p>


                        <button onclick="editFormShowing(this)" data-id="<?php echo $row['id'] ?>">Edytuj</button>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- <div>
              
            </div> -->

        </section>
        <section>
            <div id="createNews">
                <h2>Stwórz Newsa</h2>
                <form method="post" action="handle.php">

                    <label for="title">Tytuł:</label><input type="text" name="title" required><br>

                    <label for="date">Data Utworzenia:</label>
                    <input type="date" name="date" required><br>

                    <label for="text">Tekst:</label><br>
                    <textarea name="text"></textarea><br>

                    <label>Autor 1:</label><br>
                    <select name="author[]" required multiple>

                        <?php
                        $query1->execute();

                        while ($row = $query1->fetch()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select><br>


                    <input type="submit" name="add_article" value="Dodaj Artykuł">
                </form>
            </div>
            <div id="editNews">
                <h2>Edytuj Newsa</h2>
                <form method="post" action="handle.php">

                    <label for="title">Tytuł:</label><input type="text" name="title" required><br>

                    <label for="date">Data Utworzenia:</label>
                    <input type="date" name="date" required><br>

                    <label for="text">Tekst:</label><br>
                    <textarea name="text" required></textarea><br>

                    The author's edition is under preparation
                    <!-- <label>Autor 1:</label><br>
                    <select name="author[]" required multiple>

                        <?php
                        $query1->execute();

                        while ($row = $query1->fetch()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select><br> -->

                    <input type="submit" name="edit_article" value="Edytuj Artykuł">

                    <input type="hidden" name="article_id" id="articleIdInput" value="">
                </form>
                <input type="reset" value="Powrót" onclick="goBack()" id="backButton" style="margin-left: auto; margin-right:auto; margin-top:5px" />
            </div>


            <div>
                <h2>Filtruj Artykuły</h2>
                <form method="post" action="handle.php">

                    <input type="number" name="articleId"><br>

                    <input type="submit" name="filter_results" value="Filtruj" />
                </form>
                <?php
                if (isset($_SESSION['FR'])) {
                    $row = $_SESSION['FR'];
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>" . $row['text'] . "</p>";
                    echo "<p>" . $row['submission_date'] . "</p>";
                    unset($_SESSION['FR']);
                }
                ?>
            </div>
            <div>
                <h2>Filtruj po Autorze</h2>
                <form method="post" action="handle.php">
                    <label>Autorzy:</label><br>
                    <select name="author" required>

                        <?php
                        $query1->execute();

                        while ($row = $query1->fetch()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select><br>

                    <input type="submit" name="filter_authors" value="Filtruj_Autorów" />
                </form>
                <?php
                if (isset($_SESSION['AR']) && is_array($_SESSION['AR'])) {
                    foreach ($_SESSION['AR'] as $row) {
                ?>
                        <h3><?php echo $row['title'] ?></h3>
                        <p><?php echo $row['text'] ?></p>
                        <p><?php echo $row['submission_date'] ?></p>
                <?php
                    }

                    unset($_SESSION['AR']);
                }
                ?>
            </div>
            <div>
                <h2>Top 3:</h2>
                <form method="post" action="handle.php">
                    <input type="submit" name="top_3_authors" value="Pokaż" />
                </form>
                <?php


                if (isset($_SESSION['ST']) && is_array($_SESSION['ST'])) {
                    foreach ($_SESSION['ST'] as $row) {
                ?>
                        <p><?php echo $row['Author_Name'] ?></p>
                        <p><?php echo $row['Num_Articles_Submitted'] ?></p>
                <?php
                    }
                    unset($_SESSION['ST']);
                }

                ?>
            </div>

        </section>
    </main>


</body>

</html>