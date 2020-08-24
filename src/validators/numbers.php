<?php

function isPositiveInteger($value) {

    if (is_string($value)) {
        $intLike = ctype_digit($value);
    } else {
        $intLike = is_integer($value);
    }

    return $intLike && (int) $value > 0;
}

/*
// Tests
var_dump( isPositiveInteger(1) );
var_dump( isPositiveInteger("1") );
var_dump( isPositiveInteger("-1") );
var_dump( isPositiveInteger(-1) );
var_dump( isPositiveInteger("1.4") );
var_dump( isPositiveInteger(1.4) );
var_dump( isPositiveInteger('toto') );
var_dump( isPositiveInteger([]) );
var_dump( isPositiveInteger(false) );
var_dump( isPositiveInteger(true) );
*/