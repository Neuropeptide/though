<?php

require_once "./../src/config.php";


$errors = [];

// Vérification de l'envoi des données
$dataSent = $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST);
if ($dataSent) {
    /* Validation des données */
    require_once './../src/validators/feedback.php';

    $errors['name'] = validateAuthor($_POST['name']);
    $errors['job'] = validateJob($_POST["job"]);
    $errors['content'] = validateContent($_POST['content']);
    $errors['rating'] = validateRating($_POST['rating']);
}

// TODO: refactor this into a dedicated function
$success = $dataSent && empty($errors['name']) && empty($errors['job']) && empty($errors['content']);

// Enregistrement de données (si valides uniquement)
if ($success) {

    // Connection ...
    require_once "./../src/database/connection.php";

    // ... création de la requête SQL ... ($sql est un string PHP, ce qui permet de debbuger la requete SQL facilement avec exit($sql); )
    $name = $_POST['name'];
    $job = $_POST['job'];
    $content = strip_tags($_POST['content']);
    $rating = $_POST['rating'];

    $sql = "INSERT INTO feedbacks (author, job, content, rating) VALUES ('$name', '$job', '$content', $rating)";

    // OU bien sur une seule ligne
    // $sql = 'INSERT INTO feedbacks (author, job, content) VALUES ("' . $_POST['name'] . '", "' . $_POST['job'] . '", "' . $_POST['content'] . '")';

    // ... exécution de la requête SQL ...
    $result = $database->exec($sql);

    // ... gestion du résultat de la de la requête SQL
    if ($result === false) {
        $success = false;
        $errors['global'] = "Une erreur est survenue lors de l'enregistrement du message. Merci de ré-essayer plus tard.";
    }
}

// Affichage des données
$pageTitle = "Contactez nous !";
$pageDescription= "Laissez un témoignage et on l'affichera sur la page d'accueil s'il est cool !";
$pageClassName = "contact-page";

?>

<?php include_once './../src/templates/page-start.php' ?>

<?php include_once './../src/templates/header.php' ?>

    <div class="container">


        <h1 class="title">Leave a feedback</h1>

        <p class="intro">
            Drop us a line, and we will display it on the homepage !
        </p>


        <p>
            Cette page a été chargée en <strong><?= $_SERVER['REQUEST_METHOD'] ?></strong>.
        </p>

        <?php if ($success === true): ?>
            <div class="success">
                <strong>Votre message a bien été enregistré, merci :)</strong>
            </div>
        <?php elseif (!empty($errors['global'])): ?>
            <div class="error">
                <strong>Impossible d'envoyer le message :</strong>
                <br>
                <?= $errors['global'] ?>
            </div>
        <?php endif ?>


        <form action="" method="post" id="form-contact" class="form">

            <div class="form-group">
                <label for="name">Votre nom :</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="ex: Jean Dupond"
                    class="form-input"
                >

                <?php if (!empty($errors['name'])): ?>
                    <div class="error">
                        <?= $errors['name'] ?>
                    </div>
                <?php endif ?>

            </div>

            <div class="form-group">
                <label for="job">Votre métier :</label>
                <input
                    type="text"
                    id="job"
                    name="job"
                    class="form-input"
                    placeholder="ex: Architecte"
                >

                <?php if (!empty($errors['job'])): ?>
                    <div class="error">
                        <?= $errors['job'] ?>
                    </div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="content">Votre message :</label>
                <textarea
                    id="content"
                    name="content"
                    class="form-input"
                ></textarea>

                <?php if (!empty($errors['content'])): ?>
                    <div class="error">
                        <?= $errors['content'] ?>
                    </div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="job">Quelle note nous donnez-vous ?</label>
                <input
                        type="range"
                        id="rating"
                        name="rating"
                        step="1"
                        max="5"
                        min="0"
                >

                <?php if (!empty($errors['rating'])): ?>
                    <div class="error">
                        <?= $errors['rating'] ?>
                    </div>
                <?php endif ?>
            </div>

            <button class="btn btn-secondary" type="submit">
                Envoyer
            </button>


        </form>
    </div>

<?php include_once './../src/templates/page-end.php' ?>