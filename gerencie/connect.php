<?php

$dsn = 'mysql:host=#;dbname=#';
$user = '';
$pass = '';

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $ex) {
    echo 'ERRO DE CONEXÃO DB: ' . $ex->getMessage();
}
