<?php

$host = 'localhost';
$dbname = 'phpcrud';
$username = 'root';
$password = '';

try {

    $connexion = new PDO(dsn: "mysql:host=$host;dbname=$dbname",username: $username,password: $password);

} catch (Exception $e) {

    die($e->getMessage());

}