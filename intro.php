<h2>Ecrire du texte</h2>

Voila du texte "normal", écrit tel quel dans le fichier...

<br>

<p>On peut également écrire du <code>html</code></p>

<?php
// On passe dans un "contexte" php, à l'intérieur des balises

$name = "Pierre";

// Pour afficher quelque chose dans la réponse renvoyée par le serveur, il faut utiliser "echo":
echo 'Salut <strong>' . $name . '</strong> , j\'aime le "PHP" !';

// Comme d'habitude, on peut utiliser les deux types de guillemets, en échappant ceux qu'on veut afficher si besoin
echo "Salut <strong>" . $name . "</strong> , j'aime le \"PHP\" !";

// interpolation automatique des variables, avec les guillemets doubles, pas besoin de concaténation !
echo "Salut <strong>$name</strong>, j'aime le \"PHP\" ! ";

?>

<br>
On peut repasser en contexte "texte normal" à tout moment ...
<br>

<?php
// ... et de même, repasser dans un contexte php à volonté

echo "Je suis de nouveau écrit par PHP !!!";


// Suivant la situation, les différentes façons d'écrire le code peuvent être plus ou moins pratiques et/ou lisibles

$lastName = "G.";
$profilePicture = "profile.jpg";
$description = "Le php c'est cool :)";

for ($i = 0; $i < 3; $i++) {

    // Ici, on doit concaténer toutes les variables ce qui n'est pas très agréable
    echo '
    <article>
        <h2><strong>' . $name . '</strong> <span class="test">'. $lastName . '</span></h2>
        <img src="'. $profilePicture .'" alt="">
        <p>' . $description .'
            <br>
            <a href="link">En savoir plus</a>
        </p>     
    </article>
    ';

    // Si on utilise les guillemets doubles, on doit alors échapper les attributs html !
    echo "<article>       
        <h2><strong>$name</strong> <span class=\"test\">$lastName</span></h2>
        <img src=\"$profilePicture\" alt=\"\">
        <p>$description

            <br>
            <a href=\"link\">En savoir plus</a>
        </p>
    </article>";
}
?>


<?php
    // On peut plutot utliser une succession d'ouverture/fermeture de balises php ...
    // Le changement de contexte permet d'afficher le HTML très simplement, en conservant l'autocomplétion des balises ppar exemple,
    // mais attention il faut bien penser à "echo" les variables PHP dans ce cas
    if (true === true) {
        for ($i = 0; $i < 3; $i++) {
?>
            <article>
                <h2>
                    <strong>
                        <?php echo $name ?>
                    </strong>
                    <span class="test">
                        <?php echo $lastName ?>
                    </span>
                </h2>
                <img src="" alt="">
                <p>lorem
                    <br>
                    <a href="link">En savoir plus</a>
                </p>
            </article>
<?php
    // ... mais on se retrouve avec plein d'accolades de "fermeture" sans vraiment savoir ce qu'elles ferment.
        }
    }

?>


<?php
// On peut également utiliser la notation "alternative" sans les accolades, on utlise alors les mots clés commençant
// par "end" pour fermer les structures de controles (if, for, foreach, ... )

// (Personellement, j'utilise une balise PHP par ligne de structure de controle, mais ce n'est pas obligatoire)

// On peut noter la balise raccourcie avec le <?= qui permet d'écrire dans la réponse sans utiliser "echo"
?>

<?php if (true === true): ?>
    <?php for ($i = 0; $i < 3; $i++): ?>
        <article>
            <h2>
                <strong>
                    <?= $name ?>
                </strong>
                <span class="test">
                    <?= $lastName ?>
                </span>
            </h2>
            <img src="" alt="">
            <p>lorem
                <br>
                <a href="link">En savoir plus</a>
            </p>
        </article>
    <?php endfor; ?>
<?php endif; ?>

<?php
// Les tableaux en PHP

// historiquement, on utilisait le mot clé array ...
$simpleArrayOldSchool = array('riri', 'fifi', 'loulou');

// ... mais maintenant, on utilisera plutot la notation [], comme en javascript
$simpleArray = ['riri', 'fifi', 'loulou'];




// tableau associatif (couples clé/valeur), c'est le même principe que les objets en Javascript
$feedback = [
    'name' => 'John Doe',
    'job' => 'architect',
    'picture' => 'person_1.jpg',
    'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat sit sunt voluptatum. Consequatur eos impedit sit? At, autem ducimus expedita facere facilis.'
];

// Pour accéder au propriétés, on utilise la notation "crochet" (la notation "point" n'existe pas en PHP)
$simpleArray[1]; // "fifi"
$feedback['name']; // 'John Doe'


// On peut parcourir un tableau avec la boucle foreach
foreach ($simpleArray as $duck) {
    echo "Ce canard s'appelle : $duck";
}

// ... et ca marche aussi avec les tableaux associatifs
foreach ($feedback as $value) {
    echo "<p>$value</p>";
}

// ... on peut également obtenir les clés lors de l'itéation :
foreach ($feedback as $key => $value) {
    echo "<p>la propriété <strong>$key</strong> vaut : <strong>$value</strong></p>";
}

















