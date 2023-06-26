<?php

$dsn_sqlsrv = 'sqlsrv:Server=#;Database=#';
$user_sqlsrv = '';
$pass_sqlsrv = '';

try {
    $pdo_sqlsrv = new PDO($dsn_sqlsrv, $user_sqlsrv, $pass_sqlsrv);
} catch (PDOException $exp) {
    echo 'ERRO DE CONEXÃO DB: ' . $exp->getMessage();
}
