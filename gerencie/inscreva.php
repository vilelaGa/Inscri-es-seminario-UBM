<?php
session_start();

include 'connect.php';

$id_aluno = $_SESSION['id_aluno'];

$id_atv = $_POST['curso'];

$sqlCurso = "SELECT * FROM atividades WHERE ID = $id_atv";
$queryCursos = $pdo->prepare($sqlCurso);
$queryCursos->execute();

$linha = $queryCursos->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
// print_r($linha);

$dataAtv = $linha['DATA'];

$inscritos = is_null($linha['INSCRITOS']) ? 0 : $linha['INSCRITOS'];

if ($inscritos >= $linha['VAGAS']) {
    die('CURSO ESTÁ LOTADO');
} else if ($inscritos < $linha['VAGAS']) {

    $sql = "SELECT COUNT(*) numero_de_relacionamentos FROM relacao WHERE ID_USER = $id_aluno";
    $query = $pdo->prepare($sql);
    $query->execute();

    $dados = $query->fetch(PDO::FETCH_ASSOC);

    $numero_de_relacionamentos = $dados['numero_de_relacionamentos'];

    if ($numero_de_relacionamentos >= 4) {
        die("VOCÊ EXCEDEU O LIMINTE DE INSCRIÇÕES");
    } else {

        $id_curso_query =  $linha['ID'];

        $selectVerificaRelacao = "SELECT COUNT(*) numVerificaRelacao FROM relacao WHERE ID_USER = $id_aluno AND ID_CURSO = $id_curso_query";
        $queryVerificaRelacao = $pdo->prepare($selectVerificaRelacao);
        $queryVerificaRelacao->execute();
        $dadosVerificaRelacao = $queryVerificaRelacao->fetch(PDO::FETCH_ASSOC);

        // LANÇO INSCRIÇÃO DIA
        $sqlVerificaData = "SELECT COUNT(*) numVerificaData FROM relacao WHERE ID_USER = $id_aluno AND DATA_ATV = '$dataAtv'";
        $queryVerificaData = $pdo->prepare($sqlVerificaData);
        $queryVerificaData->execute();
        $dadosVerificaData = $queryVerificaData->fetch(PDO::FETCH_ASSOC);

        // var_dump($dadosVerificaData['numVerificaData']);



        if ($dadosVerificaRelacao['numVerificaRelacao'] >= 1) {
            die("VOCÊ JA SE INSCREVEU");
        } else {

            if ($dadosVerificaData['numVerificaData'] >= 1) {
                die("VOCÊ JÁ ESTÁ ESCRITO EM UM CURSO DO DIA $dataAtv");
            } else {

                $vagas = $linha['VAGAS'];

                $sQLincreverPessoa = "UPDATE atividades SET INSCRITOS = $inscritos + 1 WHERE ID = $id_atv AND INSCRITOS < $vagas";
                $queryIncreverPessoa = $pdo->prepare($sQLincreverPessoa);
                $queryIncreverPessoa->execute();

                $data = date('Y-m-d H:i:s');

                $sqlRelacionamento = "INSERT INTO relacao(ID_USER, ID_CURSO, DATA_ATV, DATARELACAO) VALUES ($id_aluno , $id_curso_query,'$dataAtv', '$data')";
                // var_dump($sqlRelacionamento);
                // die();
                $queryRelacionamento = $pdo->prepare($sqlRelacionamento);
                $queryRelacionamento->execute();

                header("Location: ../aluno/vercurso/$id_curso_query");
            }
        }
        // LANÇO INSCRIÇÃO DIA

    }
}
