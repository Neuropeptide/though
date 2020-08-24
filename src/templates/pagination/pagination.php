<?php

/*
 * Exercice : Module de pagination :
 * - afficher toujours les trois pages du début et les trois pages de fin
 * - afficher les pages adjacentes a la page en cours
 * - les autres pages sont "avalées" par un ...
 * - un numéro de page ne doit apparaitre qu'une seule fois
 *
 * Si on a 24 pages au total, et que la page active est la 14, on veut quelque chose comme ca :
 *
 * 1 2 3 ... 13 14 15 ... 22 23 24
 *
 *
 * Mais si la page 1 est active alors on a :
 *
 * 1 2 3 ... 22 23 24
 *
 * si la page 3 est active alors on a :
 *
 * 1 2 3 4 ... 22 23 24
 *
 * si la page 4 est active alors on a :
 *
 * 1 2 3 4 5 ... 22 23 24
 *
 * si la page 5 est active alors on a :
 *
 * 1 2 3 4 5 6 ... 22 23 24
 *
 * si la page 6 est active alors on a :
 *
 * 1 2 3 ... 5 6 7... 22 23 24
 */

?>


<div class="pagination">
    <?php
        for ($i = 1; $i <= $nbPages; $i++):
            if ($i === $page) {
                echo '<span class="active">' . $i . '</span>';
            } else {

                if (!empty($_SESSION['s'])) {

                    echo '<a href="' . $currentUrl . '?p=' . $i . '&perPage=' . $perPage . '&s[]=' . $_SESSION['s'] .'">' . $i . '</a>';
                } else {

                    echo '<a href="' . $currentUrl . '?p=' . $i . '&perPage=' . $perPage . '">' . $i . '</a>';
                }

            }
        endfor;
    ?>
</div>



