<?php

/* ---------------------------------------------------------------------------------------------------------------------
 * Fichier de configuration du site
 *
 * Il ne doit contenir que du PHP, pas une seule ligne de HTML, ni de echo, ni de var_dump, ...
 *
 *
 */

/**
 * Root folder on the webserver
 */
define('BASE_FOLDER', "/fs-2020-intro-php");

/**
 * Website's base URL
 */
define('BASE_URL', "http://localhost" . BASE_FOLDER . "/");

/**
 * Database server host
 */
define('DB_HOST', "localhost:3306");

/**
 * Database name
 */
define('DB_NAME', "fs-2020-tough");

/**
 * Database server user
 */
define('DB_USER', "root");

/**
 * Database server password
 */
define('DB_PASSWORD', "");




// On démarre les sessions une fois pour toutes
@session_start();

include_once __DIR__ . "/functions.php";