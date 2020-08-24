<?php
@session_start();

require_once __DIR__ . "/../../src/validators/numbers.php";
require_once __DIR__ . '/../../src/database/connection.php';

checkAuth();

// -----
// validation des données du fomulaires
// -----
if (!isPositiveInteger($_POST['id'])) { /* TODO improve id validation */
    exit('Impossible de mettre à jour, l\'id n\'est pas valide.');
}
$id = $_POST['id'];
// le <input> est une checkbox, donc on se fiche de sa valeur, on veut juste savoir si elle a été cochée ou non
$isPublished = array_key_exists('is_published', $_POST) ? 1 : 0;


// -----
// Mise a jour de la BDD
// -----


$sql = "UPDATE feedbacks SET is_published = $isPublished WHERE id = $id";
$affectedRows = $database->exec($sql);

if ($affectedRows === false) {
    // erreur dans la requete
    $_SESSION['notification'] = [
        'message' => 'Impossible de faire la requete SQL: ' . $database->errorInfo(),
        'level' => 'danger'
    ];
} else if ($affectedRows === 0) {
    $_SESSION['notification'] = [
        'message' => "Impossible de trouver le feedback d'id : $id",
        'level' => 'warning'
    ];
} else if ($affectedRows === 1) {
    $_SESSION['notification'] = [
        'message' => "Le feedback d'id : $id a bien été modifié",
        'level' => 'success'
    ];
} else {
    $_SESSION['notification'] = [
        'message' => "Oulala, on dirait que tu as modifié plein de feedbacks !!!", // dans l'idée, ca ne peut pas se produire
        'level' => 'warning'
    ];
}


// -----
// Création de la réponse du serveur
// -----

// HTTP_REFERER contient généralement l'URL "d'ou on vient"
// @see https://www.php.net/manual/fr/reserved.variables.server.php
$referer = $_SERVER['HTTP_REFERER'];
if (empty($referer)) {
    $referer = "./feedbacks-list.php";
}

header("Location: $referer");

?>
