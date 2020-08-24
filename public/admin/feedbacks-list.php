<?php

session_start();
require_once __DIR__ . '/../../src/database/connection.php';

// Vérification de l'authentification
checkAuth();


$_SESSION['admin'] = "Pierre";

// un petit compteur de page vues (pour cet utilisateur)
if (empty($_SESSION['pageCount'])) {
    $_SESSION['pageCount'] = 1;
} else {
    $_SESSION['pageCount']++;
}

/**
 * Algorithme général

        // Connection à la BDD
        $database = new PDO('mysql:host=localhost;dbname=fs-2020-tough', 'root', '');

        // Extrait les données de la base de données, et les stocke dans un object PDOStatement
        $result = $database->query("SELECT * FROM feedbacks");

        if ($result === false) {
            exit('Impossible de faire la requête SQL : ' . $database->errorInfo());
        }

        // Implémentation 1 : Extraire tous les résultats de l'objet PDO et les "transformer" en tableau PHP (tableau associatif)
        $feedbacks = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($feedbacks as $feedback) {
            echo $feedback['content'] . " <br><br>";
        }

        // Implémentation 2 : Extaire les résultats un par un et les afficher immédiatement
        while ($feedback = $result->fetch(PDO::FETCH_ASSOC)) {
            echo $feedback['content'] . " <br><br>";
        }
 *
 * */



// On vérifie qu'on a demandé une page dans l'URL, sinon on met page 1 par défaut
$currentPage = empty($_GET['page']) ? 1 : $_GET['page'];

// On valide $currentPage, car la variable vient de l'utilisateur et donc n'est pas sure
if (!is_numeric($currentPage)) {
    $currentPage = 1;
} else {
    // on doit convertir en integer, car la variable vient de l'URL
    $currentPage = (int) $currentPage; // on "cast" le type integer

    if (
        !is_integer($currentPage) ||
        $currentPage <= 0
    ) {
        $currentPage = 1;
    }
}

$limit = 10;
$offset = ($currentPage - 1) * $limit;

$result = $database->query("SELECT * FROM feedbacks LIMIT $limit OFFSET $offset");
$feedbacks = $result->fetchAll(PDO::FETCH_ASSOC);

// On compte le nombre de feedbacks, pour en déduire le nombre de pages
$result = $database->query("SELECT COUNT(id) as total FROM feedbacks");
$feedbacksCount = $result->fetch(PDO::FETCH_NUM)[0];
$pagesCount = ceil($feedbacksCount / $limit);

$prevPage = $currentPage <= 1 ? null : $currentPage - 1;
$nextPage = $currentPage >= $pagesCount ? null : $currentPage + 1;

?>

<!doctype html>
<html lang="en">

    <head>
        <title>Administration : Feedbacks</title>

        <base href="<?= BASE_URL ?>">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>



                <?php if ($_SESSION['currentUser']): ?>
                <div>
                    <p>
                        Bienvenue, <?php echo $_SESSION['currentUser'] ?> ! <small>(<?= $_SESSION['pageCount'] ?> pages vues)</small>
                    </p>


                    <a href="admin/logout.php">Se déconnecter</a>
                </div>
                <?php endif; ?>
        </nav>


        <?php if (!empty($_SESSION['notification'])): ?>
            <div class="alert alert-<?php echo $_SESSION['notification']['level'] ?>">
                <?php
                    echo $_SESSION['notification']['message'];
                    unset($_SESSION['notification']);
                ?>
            </div>
        <?php endif ?>


        <div class="container">

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">

                    <?php if (!empty($prevPage)): ?>
                        <li class="page-item">
                            <a class="page-link" href="admin/feedbacks-list.php?page=<?= $prevPage ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php for($i = 1; $i <= $pagesCount; $i++): ?>
                        <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="admin/feedbacks-list.php?page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor ?>

                    <?php if (!empty($nextPage)): ?>
                        <li class="page-item">
                            <a class="page-link" href="admin/feedbacks-list.php?page=<?= $nextPage ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif ?>


                </ul>
            </nav>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Author</th>
                        <th scope="col">Job</th>
                        <th scope="col">Content</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Created on</th>
                        <th scope="col">Published</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($feedbacks as $feedback): ?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <th scope="row"><?= $feedback['id'] ?></th>
                        <td><?= $feedback['author'] ?></td>
                        <td><?= $feedback['job'] ?></td>
                        <td><?= $feedback['content'] ?></td>
                        <td><?= $feedback['rating'] ?> / 5</td>
                        <td><?= $feedback['created_on'] ?></td>
                        <td>

                            <form action="admin/feedback-update.php" method="post">

                                <!-- On envoie l'id du feedback au serveur, sans que l'utilisateur ne le voie -->
                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= $feedback['id'] ?>"
                                >

                                <div class="custom-control custom-switch">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        name="is_published"
                                        id="toggle-<?= $feedback['id'] ?>"
                                        <?= $feedback['is_published'] ? 'checked' : '' ?>
                                    >
                                    <label class="custom-control-label" for="toggle-<?= $feedback['id'] ?>"></label>
                                </div>

                                <button type="submit" class="btn btn-outline-dark">
                                    Enregistrer
                                </button>
                            </form>

                        </td>
                        <td>
                            <a href="admin/feedback-delete.php?id=<?= $feedback['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach ?>

                </tbody>
            </table>

        </div>


        <script src="public/js/admin.js"></script>
    </body>
</html>
