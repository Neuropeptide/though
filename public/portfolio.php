<?php


require_once "./../src/config.php";
require_once "./../src/validators/numbers.php";
require_once "./../src/database/connection.php";

// Page 1 => 1 - 10
// Page 2 => 11 - 20
// Page 3 => 21 - 30
// ...
// Page 10 => 91 - 100


define('MAX_PER_PAGE', 100);

$filter = '';
// On vérifie que le paramètre est valide
if (!empty($_GET['s']) && is_array($_GET['s'])) {

    $valid = true;
    // validations des ids
    $query = $database->prepare("SELECT id FROM services WHERE id = ?");

    foreach ($_GET['s'] as $id) {

        if (
            !isPositiveInteger($id) ||
            !$query->execute([$id])
        ) {
            $valid = false;
            break;
        }
    }

    if ($valid) {
        $filter = implode(',', $_GET['s']);
        $_SESSION['s'] = $filter;
    }
}


if ($filter) {
    $r = $database->query("SELECT COUNT(id) as total FROM projects WHERE service_id IN ($filter)");
} else {
    $r = $database->query('SELECT COUNT(id) as total FROM projects');
}

$nbProjects = $r->fetch(PDO::FETCH_ASSOC)['total']; // la clé "total" vient de l'alias SQL du même nom

if (isset($_GET['perPage']) && is_numeric($_GET['perPage'])) {
    $perPage = intval($_GET['perPage']); // force la page a être un nombre entier

    if ($perPage < 10) {
        $perPage = 10;
    } else if ($perPage > MAX_PER_PAGE) {
        $perPage = MAX_PER_PAGE;
    }
} else {
    $perPage = 10;
}

$nbPages = ceil($nbProjects / $perPage);


if (isset($_GET['p']) && is_numeric($_GET['p'])) {
    $page = intval($_GET['p']); // force la page a être un nombre entier

    if ($page < 1) {
        $page = 1;
    }

    if ($page > $nbPages) {
        $page = $nbPages;
    }

} else {
    $page = 1;
}
$offset = ($page - 1) * $perPage;

$sql = "SELECT 
       projects.id, 
       projects.title, 
       projects.picture,
       services.name as serviceName
FROM projects 
JOIN services 
    ON projects.service_id = services.id";
if ($filter) {
    $sql .= " WHERE service_id IN (:ids)";
}
$sql .= " ORDER BY id ASC LIMIT :limit OFFSET :offset";

$query = $database->prepare($sql);
$query->bindValue('offset', $offset, PDO::PARAM_INT);
$query->bindValue('limit', $perPage, PDO::PARAM_INT);
if ($filter) {
    $query->bindValue('ids', $filter, PDO::PARAM_STR);
}
$query->execute();

// et les stocker dans un tableau PHP
$projects = $query->fetchAll(PDO::FETCH_ASSOC);


$services = $database
    ->query('SELECT id, name FROM services ORDER BY id')
    ->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = "Portfolio (page $page)";
$pageDescription= "Check our awesome projects and realizations...";
$pageClassName = "page-portfolio";

?>

<?php require_once "./../src/templates/page-start.php" ?>

    <?php require "../src/templates/header.php" ?>
    <?php require "../src/templates/intro.php" ?>

    <div class="container">


        <?php if (empty($projects)): ?>
            Aucun projet dans ce service.
        <?php else: ?>

            <form action="">

                <label for="s">Filter les projets par service :</label>

                <select name="s[]" id="s" multiple>
                    <!--
                        @hack : imitation de placeholder pour les <select>
                    -->
                    <option disabled selected>Choisir un service</option>

                    <option value="">Voir tout les projets</option>

                    <?php foreach($services as $service): ?>
                        <option
                            value="<?= $service['id'] ?>"
                            <?= !empty($_GET['s']) && in_array($service['id'], $_GET['s']) ? "selected" : "" ?>
                        >
                            <?= $service['name'] ?>
                        </option>
                    <?php endforeach ?>

                </select>

                <button type="submit" class="btn btn-dark">Filtrer</button>
            </form>


            <div class="grid">
                <div>
                    <h1 class="title">Portfolio</h1>

                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Aspernatur soluta dolore aperiam maiores!
                    </p>
                </div>


                <?php
                    require "../src/templates/portfolio-grid.php";
                ?>

            </div>

        <?php endif; ?>

        <div class="pagination-container">
            <?php

                // config de la pagination
                $nextPage = $page + 1;
                $nextPage = "$currentUrl?p=$nextPage&perPage=$perPage";
                $prevPage = $page - 1;
                $prevPage = "$currentUrl?p=$prevPage&perPage=$perPage";

                require_once "./../src/templates/pagination/prev-next.php"
            ?>

            <?php require_once "./../src/templates/pagination/pagination.php" ?>
        </div>

        <?php require_once "./../src/templates/pagination/results-per-page.php" ?>
    </div>

<?php require_once "./../src/templates/page-end.php" ?>