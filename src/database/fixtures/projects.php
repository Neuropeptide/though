<?php

require_once __DIR__ . "/../connection.php";
require_once __DIR__ . "/../../functions.php";


$options = getopt('n:');

//var_dump($options);exit;
$nbProjects = !empty($options['n']) ? intval($options['n']) : 10; // on génère 10 projet par défaut


$serviceResult = $database->query("SELECT id FROM services")->fetchAll(PDO::FETCH_NUM);

$serviceIds = [];
foreach ($serviceResult as $idArray) {
    array_push($serviceIds, $idArray[0]);
}


$projects = [];

for ($i = 0; $i < $nbProjects; $i++) {

    $imageNumber = $i % 9 + 1;
    $path = 'image_' . $imageNumber . '.jpg';

    $isProjectReleased = mt_rand(0, 100) > 30; // 0-30 => pas released, 31-100 => released


    $description = "";
    $paragraphs = mt_rand(3, 5);
    for ($j = 0; $j < $paragraphs; $j++) {
        $description .= createRandomContent(mt_rand(100, 300));
        $description .= "\n\n";
    }
    $description = trim($description);

    $project = [
        'title' => createRandomContent(mt_rand(2, 5)),
        'abstract' => createRandomContent(mt_rand(10, 30)),
        'description' => $description,
        'created_on' => createRandomDateString(),
        'picture' => $path,
        'service_id' => $serviceIds[array_rand($serviceIds)], // on choisit un service aléatoire
    ];

    array_push($projects, $project);
}



// Vider la table projects si besoin
// @see https://www.php.net/manual/fr/reserved.variables.argv.php
if (in_array('--clean', $argv)) {
    echo "Nettoyage de table projects ...\n";
    $database->exec("TRUNCATE TABLE projects");
    echo "Table projects vidée !\n";
}

$sql = "INSERT INTO projects (title, abstract, picture, description, created_on, service_id, released_on) VALUES ";
foreach ($projects as $project) {
    extract($project);

    $sql .= "('$title','$abstract','$picture','$description','$created_on','$service_id',";

    if ($isProjectReleased) {
        $sql .= "'" . createRandomDateString() . "'";
    } else {
        $sql .= "NULL";
    }

    $sql .= "), ";
}
$sql = trim($sql, ", ");


$result = $database->exec($sql);

if ($result === false) {
    echo "Impossible de charger les données : \n ";
    echo implode(" ", $database->errorInfo());
} else {
    echo "$result entrées ont été enregistrées en base de données." . PHP_EOL;
}