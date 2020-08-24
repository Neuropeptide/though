<?php


function containsDigit($string) {

    $result = preg_match('/^[^\d]+$/', $string);

    if ($result === false) {
        // TODO throw a real Exception
        return "Une erreur inconnue est survenue"; // a priori, ca ne doit jamais arriver (en production)
    } else if ($result === 0) {
        return true;
    }

    return false;
}

function containsOnlyNameChars($string) {

}


function isEmailValid($email) {}


function isPhoneNumberValid($phone) {}

function isCreditCardValid($phone) {}