<?php

require_once __DIR__ . '/../../src/database/connection.php';
checkAuth();

$id = $_GET['id'];

if (empty($id)) {
    exit('Impossible de supprimer, l\'id n\'est pas valide.');
}


$affectedRows = $database->exec("DELETE FROM feedbacks WHERE id = $id");

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
        'message' => "Le feedback d'id : $id a bien été supprimé",
        'level' => 'success'
    ];
} else {
    $_SESSION['notification'] = [
        'message' => "Oulala, on dirait que tu as supprimé plein de feedbacks !!!", // dans l'idée, ca ne peut pas se produire
        'level' => 'warning'
    ];
}


// HTTP_REFERER contient généralement l'URL "d'ou on vient"
// @see https://www.php.net/manual/fr/reserved.variables.server.php
$referer = $_SERVER['HTTP_REFERER'];
if (empty($referer)) {
    $referer = "./feedbacks-list.php";
}

header("Location: $referer");

?>
