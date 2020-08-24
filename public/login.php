<?php

require_once "./../src/config.php";


// Réception de données ?
if (!empty($_POST)) {
    $errors = login($_POST['username'], $_POST['password']);
}

// Affichage des données
$pageTitle = "Connexion";
$pageDescription= "pag ed connexion a l'admin";
$pageClassName = "login-page";

?>

<?php include_once './../src/templates/page-start.php' ?>

<?php include_once './../src/templates/header.php' ?>

    <div class="container">


        <h1 class="title">Connexion</h1>

        <?php if (!empty($errors['global'])): ?>
            <div class="error">
                <strong>Impossible de se connecter:</strong>
                <br>
                <?= $errors['global'] ?>
            </div>
        <?php endif ?>


        <form action="" method="post" id="form-contact" class="form">

            <div class="form-group">
                <label for="name">Identifiant :</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-input"
                    value="<?= !empty($_POST['username']) ? $_POST['username'] : '' ?>"
                >

                <?php if (!empty($errors['username'])): ?>
                    <div class="error">
                        <?= $errors['username'] ?>
                    </div>
                <?php endif ?>

            </div>

            <div class="form-group">
                <label for="name">Mot de passe :</label>
                <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                >

                <?php if (!empty($errors['password'])): ?>
                    <div class="error">
                        <?= $errors['password'] ?>
                    </div>
                <?php endif ?>

            </div>

            <button class="btn btn-secondary" type="submit">
                Connexion
            </button>
        </form>
    </div>

<?php include_once './../src/templates/page-end.php' ?>