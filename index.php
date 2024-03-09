<?php
require_once './PDOEngine.php';
$query = $db->prepare('SELECT * FROM articles JOIN authors ON articles.author_id = authors.id');
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
            editNews.style.display = 'none'
            // Funkcja do przełączania widoczności formularzy
            window.editFormShowing = function() {
                newNews.style.display = 'none'; // Ukryj formularz tworzenia
                editNews.style.display = 'block'; // Pokaż formularz edycji
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
                        <p><?php echo $row['name']; ?></p>
                        <button onclick="editFormShowing()">Edytuj</button>
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

                    <label for="author">Autor 1:</label><br>
                    <select name="author" required multiple>
                        <option value="1">Jan Kowalski</option>
                        <option value="2">Anna Nowak</option>
                        <option value="3">Piotr Wiśniewski</option>
                        <option value="4">Katarzyna Dąbrowska</option>
                        <option value="5">Marek Wójcik</option>
                        <option value="6">Agnieszka Kozłowska</option>
                        <option value="7">Tomasz Zając</option>
                        <option value="8">Małgorzata Mazur</option>
                        <option value="9">Marcin Krawczyk</option>
                        <option value="10">Joanna Pawlak</option>
                    </select><br>

                    <!-- <label for="author">Autor 2 (optional):</label><br>
                    <select name="author" multiple>
                        <option value="1">Jan Kowalski</option>
                        <option value="2">Anna Nowak</option>
                        <option value="3">Piotr Wiśniewski</option>
                        <option value="4">Katarzyna Dąbrowska</option>
                        <option value="5">Marek Wójcik</option>
                        <option value="6">Agnieszka Kozłowska</option>
                        <option value="7">Tomasz Zając</option>
                        <option value="8">Małgorzata Mazur</option>
                        <option value="9">Marcin Krawczyk</option>
                        <option value="10">Joanna Pawlak</option>
                    </select><br> -->

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

                    <label for="author">Autor 1:</label><br>
                    <select name="author" required multiple>
                        <option value="1">Jan Kowalski</option>
                        <option value="2">Anna Nowak</option>
                        <option value="3">Piotr Wiśniewski</option>
                        <option value="4">Katarzyna Dąbrowska</option>
                        <option value="5">Marek Wójcik</option>
                        <option value="6">Agnieszka Kozłowska</option>
                        <option value="7">Tomasz Zając</option>
                        <option value="8">Małgorzata Mazur</option>
                        <option value="9">Marcin Krawczyk</option>
                        <option value="10">Joanna Pawlak</option>
                    </select><br>

                    <!-- <label for="author">Autor 2 (optional):</label><br>
                    <select name="author" multiple>
                        <option value="1">Jan Kowalski</option>
                        <option value="2">Anna Nowak</option>
                        <option value="3">Piotr Wiśniewski</option>
                        <option value="4">Katarzyna Dąbrowska</option>
                        <option value="5">Marek Wójcik</option>
                        <option value="6">Agnieszka Kozłowska</option>
                        <option value="7">Tomasz Zając</option>
                        <option value="8">Małgorzata Mazur</option>
                        <option value="9">Marcin Krawczyk</option>
                        <option value="10">Joanna Pawlak</option>
                    </select><br> -->

                    <input type="submit" name="add_article" value="Dodaj artykuł">
                </form>
            </div>

        </section>
    </main>


</body>

</html>