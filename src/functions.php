<?php


/**
 * @return string The current URL
 */
function getCurrentURL() {


    // $_SERVER est une variable superglobale, "remplie" par Apache, au moment ou il a démarré PHP
    // Le "problème" c'est que $_SERVER['REQUEST_URI'] contient le dossier dans lequel on a rangé le site sur WAMP / MAMP.
    // Ce qui n'est pas très utile pour nous ici, donc on l'enlève avec la fonction str_replace

    $currentUrl = str_replace(BASE_FOLDER, "", $_SERVER['REQUEST_URI']);
    $currentUrl = str_replace("/public", "", $currentUrl);

    // Supprime les paramètres de l'URL
    $currentUrl = str_replace($_SERVER['QUERY_STRING'], "", $currentUrl);

    $currentUrl = trim($currentUrl, "/?"); // on vire le slash en début de chaine, et le point d'intérogation eventuel

    return $currentUrl;
}


/**
 * Ensure the the client is authenticated
 * And redirect the client one homepage if not
 */
function checkAuth() {

    // On enregistre pour plus tard l'endroit ou veut aller l'utilisateur
    $_SESSION['redirectUrl'] = getCurrentURL(); // TODO: includes GET parameters !!

    // Pas connecté ?
    if (empty($_SESSION['currentUser'])) {
        // On redirige vers le formulaire de connexion
        header('Location: ' . BASE_URL . 'login.php');
        exit();
    }

    // Si on est déja connecté, on n'a rien a faire
}


function login($username, $password) {

    $errors = [];

    // Vérification des credentials
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    if (empty($errors)) {

        // On va chercher un utilisateur qui correspond aux credentials en Base de données
        require __DIR__ . '/database/connection.php';

        /** @var PDO $database */
        $query = $database->prepare('SELECT * FROM users WHERE user_name = :username');
        $query->bindValue('username', $username, PDO::PARAM_STR);
        $query->execute();

        $currentUser = $query->fetch(PDO::FETCH_ASSOC);
        if (
            empty($currentUser) ||
            !password_verify($password . $currentUser['salt'], $currentUser['password'])
        ) {
            $errors['global'] = "Your credentials are invalids.";
        } else {
            // Credentials OK => on enregistre en SESSION
            $_SESSION['currentUser'] = $username;

            // par défaut, on va sur la liste des feedbacks ...
            $redirectUrl = BASE_URL . "admin/feedbacks-list.php";

            // ... mais s'il y a une URL en session, on va dessus
            if (!empty($_SESSION['redirectUrl'])) {
                $redirectUrl = $_SESSION['redirectUrl'];
            }

            header("Location: $redirectUrl");
            exit;
        }
    }

    return $errors;
}

function logout() {

    // On oublie "tout" (currentUser, nbPages)
    session_destroy();

    // OU sinon, si on veut conserver les autres infos en Session
    unset($_SESSION['currentUser']);

    // On redirige vers le homepage
    header("Location: " . BASE_URL);
    exit;

}




$lorem = explode(" ", "Aujourd'hui lorem ipsum dolor sit amet consectetur adipisicing elit accusamus asperiores blanditiis debitis odio optio praesentium recusandae voluptas aliquid atque cumque delectus incidunt officia qui sapiente tenetur adipisci animi aspernatur assumenda at consequuntur deleniti distinctio ducimus ea est eum eveniet excepturi exercitationem ipsa iste itaque iusto magnam minus molestias mollitia nam nihil nostrum officiis porro provident quaerat quam quasi quibusdam rem rerum suscipit vero consectetur esse et expedita facilis fuga necessitatibus ratione reprehenderit sed soluta ut ad aliquid commodi cum dolores harum illum inventore labore laudantium minima molestiae nemo obcaecati pariatur placeat possimus tempora veniam alias eius eligendi error laborum maxime neque nesciunt non nulla quo repellat saepe velit voluptate voluptates voluptatibus earum in quas unde aliquam aperiam deserunt earum eos explicabo facere fugit ipsam odit omnis perferendis perspiciatis quis sequi sunt vel voluptatem aut autem consequatur fugiat quos similique totam culpa doloremque quidem veritatis architecto doloribus libero maiores natus nobis numquam quod ullam a aut eaque enim repellendus architecto cupiditate dicta");

$LCletters = range("a", "z");
$UCletters = range("A", "Z");
$digits = range(0, 9);

function createRandomString(int $length = 32, array $chars = []) {

    global $LCletters, $UCletters, $digits;

    $chars = array_merge($LCletters, $UCletters, $digits, $chars);

    $random = "";
    for ($i = 0; $i < $length; $i++) {
        $char = $chars[array_rand($chars)];
        $random .= $char;
    }

    return $random;
}

function createRandomContent($nbWords) {

    global $lorem; // Utilisation d'une variable globale à l'intérieur d'une fonction

    $content = "";

    while (str_word_count($content) < $nbWords) {
        $word = $lorem[array_rand($lorem)];
        $content .= " $word";
    }

    $punctuation = ['.', ' !', ' !!', ' :)'];
    $dot = $punctuation[array_rand($punctuation)];

    return addslashes(ucfirst(trim($content)) . $dot);
}

/**
 * Create a random date between now and six month ago
 */
function createRandomDateString() {

    $duration = 60 * 60 * 24 * 30.5 * 6; // 6 mois

    $now = time();
    $past = $now - $duration;

    $timestamp = mt_rand($past, $now);
    $dateString = date('Y-m-d H:i:s', $timestamp);

    return $dateString;
}