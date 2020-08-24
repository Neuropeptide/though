<?php

require_once __DIR__ . "/../config.php";

// execution du code "dangereux" dans le bloc try
try {
    // Pour se connecter au serveur de base(s) de données, on construit une nouvelle instance de PDO
    $database = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);

    // Uncomment this line to throw on query error
    // $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (\Exception $e) {

    // Gestion de l'erreur:
    switch ($e->getCode()) {
        case 1044:
            $message = "Identifiants de la base de données invalides.";
        break;

        case 1049:
            $message = "Nom de la base de données invalide.";
        break;

        // TODO gérer tous les cas possibles (ex: server not found, ...)

        default:
            $message = "Erreur inconnue";

    }

    exit('Impossible de se connecter à la base de données : ' . $message);
}