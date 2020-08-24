

<?php

/**
 * Format d'une URL :
 *
 * protocole :// hote / chemin ? paramètres
 *
 * (Les paramètres sont optionnels, sont délimités par le ?, puis séparés par le & s'il y en a plusieurs
 *
 *
 *
 * $_GET est une variable super-globale (elle existe toujours, mais elle peut être vide),
 * elle est remplie avec les paramètres de l'URL :
 *
 * http://localhost/ma-page?key1=value1&key2=value2
 *
 * $_GET = [
 *      "key1" => "value1",
 *      "key2" => "value2",
 *      ...
 * ]
 */
//
//



//

//


echo "Salut " . $_GET['name'] . ' !';


//if (array_key_exists('name', $_GET)) {
//    $name = $_GET['name'];
//}
//
//if(isset($name)):
//    echo "Salut $name !";
//else:
//   echo 'Salut toi !';
//endif;


hello(42);


function hello($name) {
    if(isset($name) && is_string($name)):
        echo "Salut $name !";
    else:
       echo 'Salut toi !';
    endif;
}

?>
