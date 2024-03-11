<?php
require_once './PDOEngine.php';
$query = $db->prepare('SELECT articles.*, 
authors.name AS PrimaryAuthorName, 
secondary_authors.name AS SecondaryAuthorName
FROM articles
LEFT JOIN authors ON articles.PrimalAuthor_id = authors.id
LEFT JOIN authors AS secondary_authors ON articles.SecondaryAuthor_id = secondary_authors.id;');
$query->execute();
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
            let backButton = document.querySelector('#backButton')
            editNews.style.display = 'none'
            backButton.style.display = 'none'
            // Funkcja do przełączania widoczności formularzy
            window.editFormShowing = function(clickedButton) {
                var articleId = clickedButton.getAttribute('data-id'); // Pobierz ID artykułu
                document.querySelector('#editNews input[name="article_id"]').value = articleId;

                newNews.style.display = 'none'; // Ukryj formularz tworzenia
                editNews.style.display = 'block'; // Pokaż formularz edycji
                backButton.style.display = 'block'
            };
            window.goBack = function() {
                newNews.style.display = 'block'; // Ukryj formularz tworzenia
                editNews.style.display = 'none'; // Pokaż formularz edycji
                backButton.style.display = 'none'
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

            <div class="tilesLayers">
                <?php
                while ($row = $query->fetch()) {
                ?>
                    <div class="newTile">
                        <h3><?php echo $row['title']; ?></h3>
                        <p><?php echo $row['text']; ?></p>
                        <p><?php echo $row['creation_date']; ?></p>
                        <?php
                        if (!empty($row['SecondaryAuthorName'])) {
                        ?>
                            <p><?php echo $row['PrimaryAuthorName'] . ', ' . $row['SecondaryAuthorName']; ?></p>
                        <?php
                        } else {
                        ?>
                            <p><?php echo $row['PrimaryAuthorName']; ?></p>
                        <?php
                        }
                        ?>

                        <button onclick="editFormShowing(this)" data-id="<?php echo $row['id'] ?>">Edytuj</button>
                    </div>
                <?php
                }
                ?>
            </div>
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
                    <select name="author1" required>
                        <option value="1">Jan Kowalski</option>
                        <option value="2">Anna Nowak</option>
                        <option value="3">Katarzyna Dąbrowska</option>
                        <option value="4">Marek Wójcik</option>
                        <option value="5">Agnieszka Kozłowska</option>
                        <option value="6">Tomasz Zając</option>
                        <option value="7">Małgorzata Mazur</option>
                        <option value="8">Marcin Krawczyk</option>
                        <option value="9">Joanna Pawlak</option>
                        <option value="10">Test Author</option>
                    </select><br>

                    <label>Autor 2 (optional):</label><br>
                    <select name="author2">
                        <option value=""></option>
                        <option value="1">Jan Kowalski</option>
                        <option value="2">Anna Nowak</option>
                        <option value="3">Katarzyna Dąbrowska</option>
                        <option value="4">Marek Wójcik</option>
                        <option value="5">Agnieszka Kozłowska</option>
                        <option value="6">Tomasz Zając</option>
                        <option value="7">Małgorzata Mazur</option>
                        <option value="8">Marcin Krawczyk</option>
                        <option value="9">Joanna Pawlak</option>
                        <option value="10">Test Author</option>
                    </select><br>


                    <input type="submit" name="add_article" value="Dodaj artykuł">
                </form>
            </div>
            <div id="editNews">
                <h2>Edytuj Newsa</h2>
                <form method="post" action="handle.php">

                    <label for="title">Tytuł:</label><input type="text" name="title" required><br>

                    <label for="date">Data Utworzenia:</label>
                    <input type="date" name="date" required><br>

                    <label for="text">Tekst:</label><br>
                    <textarea name="text"></textarea><br>

                    <label>Autor 1:</label><br>
                    <select name="author1" required>
                        <option value="1">Jan Kowalski</option>
                        <option value="2">Anna Nowak</option>
                        <option value="3">Katarzyna Dąbrowska</option>
                        <option value="4">Marek Wójcik</option>
                        <option value="5">Agnieszka Kozłowska</option>
                        <option value="6">Tomasz Zając</option>
                        <option value="7">Małgorzata Mazur</option>
                        <option value="8">Marcin Krawczyk</option>
                        <option value="9">Joanna Pawlak</option>
                        <option value="10">Test Author</option>
                    </select><br>

                    <label>Autor 2 (optional):</label><br>
                    <select name="author2">
                        <option value="1">Jan Kowalski</option>
                        <option value="2">Anna Nowak</option>
                        <option value="3">Katarzyna Dąbrowska</option>
                        <option value="4">Marek Wójcik</option>
                        <option value="5">Agnieszka Kozłowska</option>
                        <option value="6">Tomasz Zając</option>
                        <option value="7">Małgorzata Mazur</option>
                        <option value="8">Marcin Krawczyk</option>
                        <option value="9">Joanna Pawlak</option>
                        <option value="10">Test Author</option>
                    </select><br>
                    <input type="submit" name="edit_article" value="Edytuj artykuł">

                    <input type="hidden" name="article_id" id="articleIdInput" value="">
                </form>
                <input type="reset" value="Powrót" onclick="goBack()" id="backButton" style="margin-left: auto; margin-right:auto; margin-top:5px" />
            </div>

        </section>
    </main>


</body>

</html>