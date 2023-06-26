<?php

session_start();
include 'connect.php';
include('Funcoes.php');

$cpf = filter_var($_POST['cpf'], FILTER_SANITIZE_EMAIL);

$replace = str_replace(array('.', '-'), '', $cpf);

$sql = "SELECT ID FROM users WHERE CPF = '$replace'";
$query = $pdo->prepare($sql);
$query->execute();


if ($query->rowCount() != 0) {
    $dados = $query->fetch(PDO::FETCH_ASSOC, PDO::FETCH_OBJ);
    $_SESSION['id_aluno'] = $dados['ID'];
    header("Location: ../aluno/dash-aluno/1");
} else {

    // $dadosCPF = selectValidaCpf($replace);

    // if ($dadosCPF['CPF'] == $replace) {

    //     $nome = $dadosCPF['NOME'];
    //     $cpf_user = $dadosCPF['CPF'];
    //     $data = date('Y-m-d H:i:s');

    //     $sqlInset = "INSERT INTO users (NOME, CPF, DATAHORA, PLATAFORMA) VALUES('$nome', '$cpf_user', '$data', 'seminario');";
    //     $queryInsert = $pdo->prepare($sqlInset);
    //     $queryInsert->execute();

    //     $id = $pdo->lastInsertId();

    //     // LOGAR
    //     $_SESSION['id_aluno'] = $id;
    //     header("Location: ../aluno/dash-aluno/1");
    // } else {
    //     $_SESSION['user_invalido'] = true;
    //     header("Location: ../login");
    // }

    $_SESSION['user_invalido'] = true;
    header("Location: ../login");
}
