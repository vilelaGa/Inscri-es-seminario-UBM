<?php
session_start();

include 'connect.php';

$id_aluno = $_SESSION['id_aluno'];

$id_atv = $_POST['curso'];

$sqlCurso = "SELECT * FROM atividades WHERE ID = $id_atv";
$queryCursos = $pdo->prepare($sqlCurso);
$queryCursos->execute();

$linha = $queryCursos->fetch(PDO::FETCH_ASSOC);

$inscritos = is_null($linha['INSCRITOS']) ? 0 : $linha['INSCRITOS'];
$id_curso_query =  $linha['ID'];

// echo '<pre>';
// print_r($linha);

// UPADADE
$sQLincreverPessoa = "UPDATE atividades SET INSCRITOS = $inscritos - 1 WHERE ID = $id_atv AND INSCRITOS > 0";
$queryIncreverPessoa = $pdo->prepare($sQLincreverPessoa);
$queryIncreverPessoa->execute();


// DELETA A RELAÇÃO
$sqlDeleteRelacao = "DELETE FROM relacao WHERE ID_USER = $id_aluno AND ID_CURSO = $id_atv";
$queryDeleteRelacao = $pdo->prepare($sqlDeleteRelacao);
$queryDeleteRelacao->execute();

header("Location: ../aluno/vercurso/$id_curso_query");
