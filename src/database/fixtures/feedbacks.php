
<?php



require_once __DIR__ . "/../connection.php";

require_once __DIR__ . "/../../functions.php";


$authors = [
    "Emile D'Artagnan",
    'Christopher Thompson',
    'Courtney Rose',
    'Muhammad Thomas',
    'Caroline Roberts',
    'Ben Martin',
    'Ross Clarke',
    'Ray Thompson',
    'Caroline Powell',
    'Isabelle Cox',
    'Ray Green',
    'Christopher Owen',
    'John Owen',
];

$jobs = [
    'Architect',
    'Builder',
    'Work conductor',
    'Advocate',
    'Worker',
    'Designer'
];


// ----------------------------------------------
// Démarage de l'algorithme
// ----------------------------------------------

// Générer une dizaine de personnes aléatoires [nom, job]

$persons = [];
foreach ($authors as $name) {

    $randomIndex = array_rand($jobs);
    $job = $jobs[$randomIndex];

    $person = [$name, $job];

    array_push($persons, $person);
}

// Créer un homonyme (cas particulier)
/*
 * TODO ensure that is job is different from the first "Ray Green"
 */
//$homonym = ['Ray Green'];
//array_push($persons, $homonym);


// Pour chacune de ces personnes, génerer une dizaine de commentaires
$feedbacks = [];
foreach ($persons as $person) {

    $count = mt_rand(8, 12);

    for ($i = 0; $i < $count; $i++) {

        $nbWords = mt_rand(5, 25);
        $feedback = [
            'author' => addslashes($person[0]),
            'job' => addslashes($person[1]),
            'content' => createRandomContent($nbWords),
            'rating' => mt_rand(0, 5),
            'created_on' => createRandomDateString()
        ];

        array_push($feedbacks, $feedback);
    }
}

// Mélanger les feedbacks
shuffle($feedbacks);

// Vider la table feedback si besoin
// $argv contient les arguments passés à la ligne de commande
// @see https://www.php.net/manual/fr/reserved.variables.argv.php
if (in_array('--clean', $argv)) {
    echo "Nettoyage de table feedbacks ...\n";
    $database->exec("TRUNCATE TABLE feedbacks");
    echo "Table feedbacks vidée !\n";
}

// Enregistrer tous ces feedbacks en BDD

$sql = "INSERT INTO feedbacks (author, job, content, rating, created_on) VALUES ";
foreach ($feedbacks as $feedback) {
    extract($feedback);

    // La fonction extract() équivaut à faire :
    // $name = $feedback['name'];
    // $job = $feedback['job'];
    // $content = $feedback['content'];

    $sql .= "('$author', '$job', '$content', $rating, '$created_on'), ";
}
$sql = trim($sql, ", ");

$result = $database->exec($sql);

if ($result === false) {
    echo "Impossible de charger les données : \n ";
    echo implode(" ", $database->errorInfo());
} else {
    echo "$result entrées ont été enregistrées en base de données." . PHP_EOL;
}



