<?php

require_once __DIR__ . "/../connection.php";


$password = "azeaze";
$salt = createRandomString();
$digest = password_hash($password . $salt, PASSWORD_ARGON2ID);

$admin = [
    "full_name" => "Pierre Guillaume",
    "email" => "admin@site.localhost",
    "user_name" => "admin",
    "password" => $digest,
    "salt" => $salt,
];

extract($admin);

$sql = "INSERT INTO users (full_name, email, user_name, password, salt) VALUES (
    '$full_name',
    '$email',
    '$user_name',
    '$password',
    '$salt'
)";

$res = $database->exec($sql);