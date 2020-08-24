<?php

require_once "./../src/config.php";


// L'url de cette page est de la forme "/work-:workId"
// Apache extrait la partie ":workId" de l'URL et l'injecte dans le script PHP en tant que variable GET
// (voir le fichier /public/.htaccess)


function redirectOnPortfolio() {
    // On écrit dans les en-têtes de la réponse HTTP
    header("Location: " . BASE_URL . "portfolio", true, 303); // l'en-tête Location sert à rediriger le navigateur à cette adresse
    exit; // si on redirige, ca ne sert plus a rien de faire travailler PHP
}

$projectId = (int) $_GET['work']; // on "cast" la valeur de type string en type integer

// Si l'id du projet demandé n'est pas valide, on redirige vers la page portfolio
if (
    !is_int($projectId) ||
    $projectId <= 0
) {
    redirectOnPortfolio();
}

// L'ID est valide, on peut donc essayer d'aller le chercher en BDD :
require_once __DIR__ . "/../src/database/connection.php";

$sql = "SELECT * FROM projects WHERE id = $projectId";
$result = $database->query($sql);

$project = $result->fetch(PDO::FETCH_ASSOC);

if (empty($project)) {
    // Aucun project ne corespond à cet identifiant en BDD, on redirige :
    redirectOnPortfolio();

    // ... on pourrait aussi afficher une page 404 au lieu de rediriger
}

// On compte le nombre de projets dans la BDD directemnt en SQL !
// https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql/915107-les-fonctions-sql
$r = $database->query('SELECT COUNT(id) as total FROM projects');
$projectsCount = $r->fetch(PDO::FETCH_ASSOC)['total']; // la clé "total" vient de l'alias SQL du même nom


$pageTitle = $project['title'];
$pageDescription= $project['abstract'];
$pageClassName = "work-page";

?>

<?php include_once './../src/templates/page-start.php' ?>

<?php include_once './../src/templates/header.php' ?>

<div class="container">


    <header class="work-header">
        <h1 class="title">
            <?= $project['title'] ?>
        </h1>

        <?php include_once './../src/templates/work-picture.php' ?>
    </header>


    <p class="intro">
        <?= $project['abstract'] ?>
    </p>

    <p>
        <?= nl2br($project['description']); //convertit les \n en <br> ?>
    </p>

    <div>

        <div class="pagination-container">
            <?php

            // config du module pagination
            $page = $projectId;
            $perPage = 1;
            $prevPage = "work-" . ($projectId - 1);
            $nextPage = "work-" . ($projectId + 1);
            $nbPages = $projectsCount;

            require_once "./../src/templates/pagination/prev-next.php"

            ?>
        </div>
    </div>
</div>


<?php include_once './../src/templates/page-end.php' ?>