<?php

    $path = './img/' . $project['picture'];
    $url = $path; // dans ce cas précis, l'URL est identique au chemin sur le disque dur (configuration Apache)
?>

<?php if (file_exists($path)): ?>
    <img src="<?= $url ?>" alt="">
<?php else: ?>
    <img
        class="placeholder"
        src="https://cdn.discordapp.com/attachments/692404772636065793/711877479207534622/placeholder.png"
        alt="Image <?= $project['id'] ?> manquante !"
    >
<?php endif; ?>