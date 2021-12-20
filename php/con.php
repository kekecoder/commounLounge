<?php

$dsn = 'mysql:host=localhost; dbname=commonLounge';
$user = 'root';
$pass = 'jerusalem1991';

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (Exception $e) {
    print "An error occured " . $e->getMessage();
}
