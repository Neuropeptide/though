<?php


/**
 * @param $name string the name of the author
 */
function validateAuthor($name) {

    if (
        empty($name) || // n'existe pas, oou existe mais est "falsy"
        empty(trim($name)) // existe mais ne contient que des espaces
    ) {
        return "Merci d'indiquer votre nom complet.";
    }
    else {
        $result = preg_match('/^[A-zÀ-ÖØ-öø-ÿ \'-]{2,}$/', $name);

        if ($result === false) {
            return "Une erreur inconnue est survenue"; // a priori, ca ne doit jamais arriver (en production)
        } else if ($result === 0) {
            return "Votre nom est un peu étrange. Il ne doit contenir que des lettres, des espaces, des apostrophes et des tirets";
        }
    }

    return null;
}


function validateJob($job) {
    if (!empty($job)) {

        require_once __DIR__ . '/string.php';

        if (containsDigit($job)) {
            return "Le métier ne peut pas contenir de nombres";
        }
    }

    return null;
}



function validateContent($content) {

    if (
        empty($content) || // n'existe pas, ou existe mais est "falsy"
        empty(trim($content)) // existe mais ne contient que des espaces
    ) {
        return "Merci de laisser un vrai message.";
    }

    else if (str_word_count($content) < 5) {
        return "Votre message est un peu court, pouvez-vous développer ?";
    }

    return null;
}


function validateRating($rating) {
    if (isset($rating)) {

        // @see https://www.php.net/manual/en/function.filter-var.php
        if (!filter_var($rating, FILTER_VALIDATE_INT)) {
            return "La note doit être un nomber entier";
        }

        if ($rating < 0 || $rating > 5) {
            return "La note doit être comprise entre 0 et 5.";
        }
    }

    return null;
}